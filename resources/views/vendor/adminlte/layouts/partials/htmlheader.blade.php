<head>
    <meta charset="UTF-8">
    <title> NC Mueblería - @yield('htmlheader_title', 'Your title here') </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{ asset('/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>

    <link href="{{ asset('/css/all.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/plus.css?version=2') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/bootstrap.min.css?version=3') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"> --}}

    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="{{ asset('plugins/datatables/jquery.dataTables.css') }}">

    <link href="{{ asset('/css/multi-select-nc.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ asset('/plugins/iCheck/square/blue.css') }}" rel="stylesheet"> --}}

    <script src="{{ asset('/plugins/sweetalert-master/dist/sweetalert.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('/plugins/sweetalert-master/dist/sweetalert.css') }}">

    <script src="/js/jquery.multi-select.js"></script>
    <script src="/plugins/pace/pace.js"></script>

    <link href="/plugins/icheck-nc/skins/all.css" rel="stylesheet">
    <script src="/plugins/icheck-nc/icheck.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('styles')

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
