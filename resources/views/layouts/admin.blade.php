<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
     
    <script src="https://kit.fontawesome.com/3f8ce600e5.js" crossorigin="anonymous"></script>

  @livewireStyles
</head>

<body class="font-sans antialiased bg-gray-50">
   @include('layouts.includes.admin.navigation')

    @include('layouts.includes.admin.sidebar')

    <div class="p-4 sm:ml-64 mt-14">
      <div class="mt-14">
        <div class="mb-4 flex flex-wrap items-center justify-between gap-4">
          @include('layouts.includes.admin.breadcrumb')
          @if (isset($actions) && ! $actions->isEmpty())
            <div class="flex shrink-0 items-center gap-2">
              {{ $actions }}
            </div>
          @endif
        </div>
      </div>
      {{ $slot }}

   </div>
       

        @stack('modals')
        @wireUiScripts
        @livewireScripts
        @stack('scripts')
        <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
    </body>
</html>