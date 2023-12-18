<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

            
            @if(session('updated'))
            
            <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=> show = false, 3000)"class="flex items-center p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert">
                <div class="mx-auto max-w-7xl">{{ session('updated') }}</div>
              </div>
              
            @endif
        
            @if(session('success'))
            
            <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=> show = false, 3000)" class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                <div class="mx-auto max-w-7xl">{{ session('success') }}</div>
            </div>  
            @endif
            
            @if(session('sale'))
            
            <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=> show = false, 3000)" class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                <div class="mx-auto max-w-7xl">{{ session('sale') }}</div>
            </div>  
            @endif
            
            @if(session('danger'))
            
            <div x-data="{show:true}" x-show="show" x-init="setTimeout(()=> show = false, 3000)" class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                <div class="mx-auto max-w-7xl">{{ session('danger') }}</div>
            </div>  
            @endif
            

            @include('layouts.navigation')

        

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow dark:bg-gray-800">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

           

            <!-- Page Content -->
            <main>
               
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
