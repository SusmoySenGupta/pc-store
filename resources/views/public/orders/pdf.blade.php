<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" >
    <title>{{ __(env('APP_NAME', 'Laravel')) }}</title>
    </style>
</head>

<body class="antialiased">
   <div class="w-full h-20 flex items-center justify-center border8">
        Pc store
   </div> 
   {{-- <div style="display: flex; justify-content: center; align-items: center; width: 100%;">
        Pc store
   </div> --}}
</body>

</html>
