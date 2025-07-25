<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-gray-50">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/x-icon" href="{{ asset('img/logorst.png') }}">
        <title inertia>E-Office</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ env('ALT_CSS_URL') }}">

        <!-- Scripts -->
        @routes
        
        <script src="{{ env('ALT_SCRIPT_URL') }}" defer></script>
        <script>window.baseUrl = "{{ env('APP_URL', url('/')) }}";</script>
        <script>window.parafpw = "{{ env('PARAF_PASS') }}";</script>
        <script>window.jabatanId = {{ auth()->check() ? auth()->user()->jabatan_id : 0 }};</script>
    </head>
    <body class="font-sans antialiased overflow-x-hidden font-roboto text-sm bg-no-repeat bg-fixed">
        @inertia
        @env ('local')
            {{-- <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script> --}}
        @endenv
    </body>
</html>
