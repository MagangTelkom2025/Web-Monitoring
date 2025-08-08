<?php

namespace App\Controllers;

use App\Models\TicketModel;
use CodeIgniter\Controller;

class Tickets extends Controller
{

public function index()
{
    $model = new TicketModel();
    $data['tickets'] = $model
        ->select('date_start_interaction, mainCategory, category, witel')
        ->findAll();

    // kirim data ke ticket.php
    return view('ticket', $data);
}



    public function uploadForm()
    {
        return view('tickets/upload');
    }

    public function upload()
    {
        $file = $this->request->getFile('file');

        if (!$file->isValid() || $file->hasMoved()) {
            return redirect()->back()->with('error', 'Upload gagal!');
        }

        if ($file->getExtension() !== 'csv') {
            return redirect()->back()->with('error', 'File harus CSV!');
        }

        $path   = $file->getTempName();
        $handle = fopen($path, 'r');

        if ($handle === false) {
            return redirect()->back()->with('error', 'Gagal membaca file CSV!');
        }

        $model  = new TicketModel();
        $header = fgetcsv($handle);

        // Daftar kolom BIGINT yang nilainya 0 akan diubah jadi '-'
        $bigIntColumns = ['priority_id']; // sesuaikan dengan DB

        while (($row = fgetcsv($handle)) !== false) {
            $cleanRow = [];

            foreach ($row as $i => $value) {
                if ($value === null) {
                    $value = '';
                }

                // Hilangkan kutip tunggal/dobel di awal & akhir
                $value = trim($value, "'\"");

                // Hilangkan koma ribuan
                $value = str_replace(',', '', $value);

                // Hilangkan spasi di awal & akhir
                $value = trim($value);

                // Hilangkan .0 di akhir angka
                if (preg_match('/^\d+\.0$/', $value)) {
                    $value = preg_replace('/\.0$/', '', $value);
                }

                // Jika kolom ini BIGINT dan nilainya 0 → ubah jadi '-'
                if (isset($header[$i]) && in_array($header[$i], $bigIntColumns)) {
                    if ($value === '0') {
                        $value = '-';
                    }
                }

                // Konversi datetime (tanggal + jam) ke format MySQL
                if (preg_match('/^\d{1,2}[\/\.\-]\d{1,2}[\/\.\-]\d{2,4}\s+\d{1,2}[\.\:]\d{1,2}[\.\:]\d{1,2}$/', $value)) {
                    // Ganti . di waktu jadi :
                    $cleanValue = preg_replace('/(\d{1,2})\.(\d{1,2})\.(\d{1,2})$/', '$1:$2:$3', $value);
                    // Ganti . atau - di tanggal jadi /
                    $cleanValue = preg_replace('/[\.\-]/', '/', $cleanValue);

                    $dateTime = date_create_from_format('d/m/Y H:i:s', $cleanValue)
                             ?: date_create_from_format('m/d/Y H:i:s', $cleanValue)
                             ?: date_create_from_format('d/m/y H:i:s', $cleanValue)
                             ?: date_create_from_format('m/d/y H:i:s', $cleanValue);

                    if ($dateTime) {
                        $value = $dateTime->format('Y-m-d H:i:s');
                    }
                }
                // Konversi tanggal tanpa jam
                elseif (preg_match('/^\d{1,2}[\/\.\-]\d{1,2}[\/\.\-]\d{2,4}$/', $value)) {
                    $cleanDate = str_replace(['.', '-'], '/', $value);
                    $date = date_create_from_format('d/m/Y', $cleanDate)
                         ?: date_create_from_format('m/d/Y', $cleanDate)
                         ?: date_create_from_format('d/m/y', $cleanDate)
                         ?: date_create_from_format('m/d/y', $cleanDate);

                    if ($date) {
                        $value = $date->format('Y-m-d');
                    }
                }

                $cleanRow[$header[$i]] = $value;
            }

            // Simpan ke DB
            if (!empty($cleanRow['ticket_id'])) {
                $existing = $model->where('ticket_id', $cleanRow['ticket_id'])->first();

                if ($existing) {
                    $model->update($existing[$model->primaryKey], $cleanRow);
                } else {
                    $model->insert($cleanRow);
                }
            }
        }

        fclose($handle);

        return redirect()->to('/ticket')->with('success', 'Data berhasil diupload');
    }
}
