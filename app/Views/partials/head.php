<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Website Monitoring</title>
    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->
    <!--begin::Primary Meta Tags-->
    <meta name="title" content="AdminLTE 4 | Sidebar Mini" />
    <meta name="author" content="ColorlibHQ" />
    <meta
        name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance." />
    <meta
        name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant" />
    <!--end::Primary Meta Tags-->
    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="../css/adminlte.css" as="style" />
    <!--end::Accessibility Features-->
    <!--begin::Fonts-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
        crossorigin="anonymous"
        media="print"
        onload="this.media='all'" />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="<?= base_url('css/adminlte.css') ?>" />
    <!--end::Required Plugin(AdminLTE)-->

    <!--begin::SweetAlert2 CSS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">
    <!--end::SweetAlert2 CSS-->

    <!--begin::Custom Simple Elegant Styling-->
    <style>
        /* Simple elegant table styling */
        .table {
            border: none;
            font-size: 0.95rem;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.5;
        }

        .table thead th {
            border: none;
            background: #ffffff !important;
            padding: 1rem 0.75rem;
            font-weight: 600;
            color: #212529;
            border-bottom: 2px solid #dee2e6;
            font-size: 0.9rem;
        }

        .table tbody td {
            border: none;
            padding: 1rem 0.75rem;
            vertical-align: top;
            border-bottom: 1px solid #e9ecef;
            color: #212529;
            font-size: 0.9rem;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f8f9fa;
        }

        .table-hover tbody tr:hover {
            background-color: #e9ecef;
            transition: background-color 0.15s ease-in-out;
        }

        /* Improve text readability */
        .table .fw-medium {
            font-weight: 500;
            color: #212529;
        }

        .table .text-muted {
            color: #6c757d !important;
            font-size: 0.85rem;
        }

        /* Better spacing for data cells */
        .table tbody td>div {
            min-height: 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Simple card styling */
        .card {
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
        }

        .card-header {
            background: #ffffff;
            border-bottom: 1px solid #dee2e6;
        }

        /* Simple button styling */
        .btn {
            border-radius: 0.25rem;
            font-weight: 500;
            transition: all 0.2s ease-in-out;
        }

        .btn-dark {
            background-color: #212529;
            border-color: #212529;
            color: #ffffff;
        }

        .btn-outline-dark {
            color: #212529;
            border-color: #212529;
        }

        .btn-outline-dark:hover {
            background-color: #212529;
            border-color: #212529;
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn.disabled,
        .btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* Smooth refresh animations */
        .fa-spin {
            animation: fa-spin 1s infinite linear;
        }

        @keyframes fa-spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Loading indicator improvements */
        #loadingIndicator {
            transition: opacity 0.3s ease-in-out;
            position: relative;
            z-index: 10;
        }

        /* Smooth table transitions */
        .table {
            transition: opacity 0.2s ease-in-out;
        }

        /* DataTable processing styling */
        .dataTables_processing {
            position: absolute !important;
            top: 50% !important;
            left: 50% !important;
            transform: translate(-50%, -50%) !important;
            background: rgba(255, 255, 255, 0.9) !important;
            border: 1px solid #dee2e6 !important;
            border-radius: 0.375rem !important;
            padding: 1rem 1.5rem !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
            color: #212529 !important;
            font-weight: 500 !important;
        }

        /* Consistent spinner styling */
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
            border-width: 0.15em;
        }

        /* Header sorting visual feedback */
        .table thead th.sorting:hover,
        .table thead th.sorting_asc:hover,
        .table thead th.sorting_desc:hover {
            background-color: #f8f9fa !important;
            transition: background-color 0.2s ease-in-out;
            cursor: pointer;
        }

        /* Toast notification styling */
        .alert.position-fixed {
            animation: slideInRight 0.3s ease-out;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* DataTables styling - clean without export buttons */
        .dataTables_wrapper {
            padding: 0;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            margin: 1rem 0;
            color: #212529;
        }

        .dataTables_wrapper .dataTables_length {
            float: left;
        }

        .dataTables_wrapper .dataTables_filter {
            float: right;
            margin-bottom: 1rem;
        }

        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            padding: 0.5rem 0.75rem;
            color: #212529;
            margin-left: 0.5rem;
            width: 250px;
        }

        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            padding: 0.375rem 0.5rem;
            color: #212529;
            margin: 0 0.5rem;
        }

        .dataTables_wrapper .dataTables_info {
            clear: both;
            float: left;
            padding-top: 0.75rem;
            font-size: 0.9rem;
        }

        .dataTables_wrapper .dataTables_paginate {
            float: right;
            padding-top: 0.5rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.375rem 0.75rem;
            margin: 0 0.125rem;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            background: #ffffff;
            color: #212529;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #f8f9fa;
            border-color: #adb5bd;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #212529;
            color: #ffffff;
            border-color: #212529;
        }

        /* Simple alert styling */
        .alert {
            border-radius: 0.25rem;
            font-weight: 500;
        }

        /* Text colors */
        .text-dark {
            color: #212529 !important;
        }

        .fw-medium {
            font-weight: 500;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .table {
                font-size: 0.8rem;
            }

            .card-tools .btn {
                font-size: 0.8rem;
                padding: 0.25rem 0.5rem;
            }
        }
    </style>
    <!--end::Custom Simple Elegant Styling-->

</head>
<!--end::Head-->