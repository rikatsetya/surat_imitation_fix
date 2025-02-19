<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mailmaker</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Untuk mengirimkan token Laravel CSRF pada setiap request ajax -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    {{-- Sweet Alert2 --}}
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <script src="https://kit.fontawesome.com/632b2cdc3f.js" crossorigin="anonymous"></script>

    @stack('css')
    <!-- Digunakan untuk memanggil custom css dari perintah push('css') pada masing-masing view -->
</head>

<style>
    .nav-link.active {
        font-weight: bold;
        color: rgb(33, 37, 41) !important;
        background-color: rgb(244, 246, 249);
        /* Optional */
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        height: 115%;
        text-align: center;
    }

    .second-content-wrapper {
        padding: 15px;
    }

    .content-wrapper {
        background-color: lightgrey;
        background-image: url('asset/background.png');
        background-repeat: repeat;
    }
</style>


<body class="hold-transition layout-top-nav">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        @include('layouts.header')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="second-content-wrapper">

                <!-- Content Header (Page header) -->
                @include('layouts.breadcrumb')

                <!-- Main content -->
                <section class="content">
                    @yield('content')
                </section>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('layouts.footer')
        <!-- ./wrapper -->

        <!-- jQuery -->
        <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- DataTables & Plugins -->
        <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.colvis.min.js') }}"></script>
        <!-- jquery-validation-->
        <script src="{{ asset('adminlte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/jquery-validation/additional-methods.min.js') }}"></script>
        <!-- SweetAlert2 -->
        <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
        <script>
            // Untuk mengirimkan token Laravel CSRF pada setiap request ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        @stack('js')
        <!-- Digunakan untuk memanggil custom js dari perintah push('js') pada masing-masing view-->
    </div>
</body>

</html>
