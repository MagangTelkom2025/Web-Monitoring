<h3 class="text-[#1b0e0e] text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">Interactive Charts</h3>
<div class="flex flex-wrap gap-4 px-4 py-6">
    <div class="flex min-w-72 flex-1 flex-col gap-2 rounded-lg border border-[#e7d0d1] p-6">
        <p class="text-[#1b0e0e] text-base font-medium leading-normal">Ticket Volume Over Time</p>
        <p class="text-[#1b0e0e] tracking-light text-[32px] font-bold leading-tight truncate"><?= $ticketVolumeData ?? '1,247' ?></p>
        <div class="flex gap-1">
            <p class="text-[#994d51] text-base font-normal leading-normal">Last 30 Days</p>
            <p class="text-[#07885d] text-base font-medium leading-normal"><?= $ticketVolumeChange ?? '+12%' ?></p>
        </div>
        <div class="flex min-h-[180px] flex-1 flex-col gap-8 py-4">
            <!-- Pastikan canvas memiliki width dan height yang cukup -->
            <canvas id="ticketVolumeChart" width="400" height="300" style="width:100%; height:300px;"></canvas>
        </div>
    </div>
    <div class="flex min-w-72 flex-1 flex-col gap-2 rounded-lg border border-[#e7d0d1] p-6">
        <p class="text-[#1b0e0e] text-base font-medium leading-normal">Ticket Resolution Rate</p>
        <p class="text-[#1b0e0e] tracking-light text-[32px] font-bold leading-tight truncate"><?= $resolutionRate ?? '84%' ?></p>
        <div class="flex gap-1">
            <p class="text-[#994d51] text-base font-normal leading-normal">Last 30 Days</p>
            <p class="text-[#e75a08] text-base font-medium leading-normal"><?= $resolutionChange ?? '-2%' ?></p>
        </div>
        <div class="flex min-h-[180px] flex-1 flex-col gap-8 py-4">
            <canvas id="resolutionRateChart" width="400" height="300" style="width:100%; height:300px;"></canvas>
        </div>
    </div>
</div>
<div class="flex flex-wrap gap-4 px-4 py-2 mb-4">
    <div class="flex min-w-72 flex-1 flex-col gap-2 rounded-lg border border-[#e7d0d1] p-6">
        <p class="text-[#1b0e0e] text-base font-medium leading-normal">Tickets by Category</p>
        <div class="flex min-h-[200px] flex-1 items-center justify-center">
            <canvas id="categoryPieChart" width="400" height="300" style="width:100%; height:300px;"></canvas>
        </div>
    </div>
    <div class="flex min-w-72 flex-1 flex-col gap-2 rounded-lg border border-[#e7d0d1] p-6">
        <p class="text-[#1b0e0e] text-base font-medium leading-normal">Tickets by Status</p>
        <div class="flex min-h-[200px] flex-1 items-center justify-center">
            <canvas id="statusDoughnutChart" width="400" height="300" style="width:100%; height:300px;"></canvas>
        </div>
    </div>
</div>