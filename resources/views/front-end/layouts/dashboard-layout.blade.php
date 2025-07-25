<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">
		<meta name="csrf" content="{{ csrf_token() }}" id="csrf-token">
       	
		<title>DynamicForms | @yield('pageTitle')</title>

        <!-- CSS FILES -->        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap" rel="stylesheet">
                        
        @include('front-end.layouts.dashboard-css')
		@stack('css')
     

    </head>
    
    <body id="top">

        <main>
            @yield('content')

        </main>
		@include('front-end.layouts.dashboard-js')
		@stack('js')
</html>
