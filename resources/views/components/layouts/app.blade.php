<!DOCTYPE html>
<html lang="{{ str_replace( '_', '-', app()->getLocale() ) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <title>{{ $title ?? 'Page Title' }}</title>
    @vite( 'resources/css/app.css' )
    @livewireStyles
</head>

<body class="min-h-screen flex flex-col bg-[#F4F7FF]">
<!-- Main Content -->
<main class="flex-grow">
    <div class=" max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        {{ $slot }}
    </div>
</main>

@livewireScripts
@vite( 'resources/js/app.js' )
</body>

</html>
