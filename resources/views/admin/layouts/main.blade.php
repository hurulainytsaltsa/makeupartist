<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('title')</title>

    <link rel="icon" href="/images/logo4.jpg" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/admin/bootstrap1.min.css" />

    <!-- style CSS -->
    <link rel="stylesheet" href="/css/admin/style1.css" />

    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- date picker -->
    <link rel="stylesheet" href="/css/admin/date-picker.css" />
</head>

<body class="crm_body_bg">
    <!-- main content part here -->

    @include('admin.layouts.sidebar')

    <section class="main_content dashboard_part large_header_bg">
        <!-- menu  -->
        @include('admin.layouts.menu')
        <!--/ menu  -->


        <div class="main_content_iner overly_inner ">
            @yield('content')
        </div>

        @include('admin.layouts.footer')

    </section>
    <!-- main content part end -->

    @include('admin.layouts.message_box')

    <!-- footer  -->
    <script src="/js/admin/jquery1-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="/js/admin/popper1.min.js"></script>
    <!-- bootstarp js -->
    <script src="/js/admin/bootstrap1.min.js"></script>
    <!-- sidebar menu  -->
    <script src="/js/admin/metisMenu.js"></script>
    <!-- waypoints js -->
    <script src="/js/admin/jquery.waypoints.min.js"></script>
    <!-- waypoints js -->
    <script src="/js/admin/Chart.min.js"></script>
    <!-- counterup js -->
    <script src="/js/admin/jquery.counterup.min.js"></script>

    <!-- tag input -->
    <script src="/js/admin/tagsinput.js"></script>
    <!-- text editor js -->
    <script src="/js/admin/summernote-bs4.js"></script>
    <script src="/js/admin/amcharts.js"></script>

    <!-- custom js -->
    <script src="/js/admin/dashboard_init.js"></script>
    <script src="/js/admin/custom.js"></script>

    <!-- SweetAlert2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.all.min.js"></script>

    <!-- datepicker  -->
    <script src="/js/admin/datepicker.js"></script>
    <script src="/js/admin/datepicker.en.js"></script>
    <script src="/js/admin/datepicker.custom.js"></script>
</body>

</html>
