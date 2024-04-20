<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    {{-- <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" /> --}}
    <link rel="stylesheet" href="{{ asset('admin_dashbroad/assets/css/styles.min.css') }}" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .circle {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            align-items: center;
        }

        .backGround {
            background-color: #f9f9f9
        }

        .border1 {
            border-bottom: 5px solid #FFAE1F;
        }

        .border2 {
            border-bottom: 5px solid #5D87FF;
        }

        .border3 {
            border-bottom: 5px solid #13DEB9;
        }

        .border4 {
            border-bottom: 5px solid #539BFF;
        }
    </style>
</head>

<body>

    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <aside class="left-sidebar">
            @include('layout.app.sidebar')
        </aside>
        <div class="body-wrapper">
            <header class="app-header">
                @include('layout.app.navbar')
            </header>
            <div class="container backGround">
                {{ $slot }}
                <div class="py-6 px-6 text-center">
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin_dashbroad/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_dashbroad/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_dashbroad/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('admin_dashbroad/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('admin_dashbroad/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin_dashbroad/assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('admin_dashbroad/assets/js/dashboard.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @stack('js')
</body>

</html>
