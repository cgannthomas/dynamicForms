<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
		<title>DynamicForms | @yield('pageTitle')</title>
		<meta name="description" content="DynamicForms" />
		<meta name="keywords" content="DynamicForms" />
        <meta name="csrf" content="{{ csrf_token() }}" id="csrf-token">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="shortcut icon" href="{{ asset('admin-panel/images/favicon.ico') }}" />

		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		@include('admin.auth.layouts.login-css')
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="bg-body">
        @yield('content')
        @include('admin.auth.layouts.login-js')
    </body>

</html>
