<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>PT. Global Lintas Iramada</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('admin/assets/img/logo/logo.png') }}" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('admin/assets/css/tabler.css?1744816591') }}" rel="stylesheet" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PLUGINS STYLES -->
    <link href="{{ asset('admin/assets/css/tabler-flags.css?1744816591') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/tabler-socials.css?1744816591') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/tabler-payments.css?17448)16591') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/tabler-vendors.css?1744816591') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/tabler-marketing.css?1744816591') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/tabler-themes.css?1744816591') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- END PLUGINS STYLES -->
    <!-- BEGIN DEMO STYLES -->
    <link href="{{ asset('admin/assets/preview/css/demo.css?1744816591') }}" rel="stylesheet" />
    <!-- END DEMO STYLES -->
    <!-- BEGIN CUSTOM FONT -->
    <style>
        @import url("https://rsms.me/inter/inter.css");
    </style>
    <!-- END CUSTOM FONT -->
</head>

<body>
    <!-- BEGIN GLOBAL THEME SCRIPT -->
    <script src="{{ asset('admin/assets/js/tabler-theme.min.js?1744816591') }}"></script>
    <!-- END GLOBAL THEME SCRIPT -->

    <div class="page page-center">
        @yield('content')
    </div>

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('admin/assets/js/tabler.min.js?1744816591') }}" defer></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <!-- BEGIN DEMO SCRIPTS -->
    <script src="{{ asset('admin/assets/preview/js/demo.min.js?1744816591') }}" defer></script>
    <!-- END DEMO SCRIPTS -->

    <!-- SWEET ALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                html: `{!! implode('<br>', $errors->all()) !!}`,
            });
        </script>
    @endif

    @if (session('status'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Success",
                text: "{{ session('status') }}",
            });
        </script>
    @endif
</body>

</html>
