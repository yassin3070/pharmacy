<!DOCTYPE html>
<html  lang="{{ app()->getLocale() }}" direction="{{app()->getLocale() == "ar" ? "rtl" : "ltr" }}" dir="{{app()->getLocale() == "ar" ? "rtl" : "ltr" }}" style="direction: {{app()->getLocale() == "ar" ? "rtl" : "ltr" }}">
	<!--begin::Head-->
	<head>
		<title>{{env('APP_NAME')}}</title>
		<meta charset="utf-8" />
		<meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="@lang('dashboard.app_desc')" />
		<meta property="og:url" content="https://hwzn.sa" />
		<meta property="og:site_name" content="HWZN" />
		<link rel="canonical" href="https://hwzn.sa" />
		<link rel="shortcut icon" href="{{asset('dashboard/assets/media/logos/favicon.ico')}}" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<link href="https://fonts.googleapis.com/css2?family=Changa:wght@200;400&display=swap" rel="stylesheet">

		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{asset('dashboard/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('dashboard/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
	</head>

<body id="kt_body" class="bg-body">

    @yield('content')

   

    <script src="{{asset('dashboard/assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/scripts.bundle.js')}}"></script>

    @yield('scripts')
    <!--begin::Page Custom Javascript(used by this page)-->

</body>
<!--end::Body-->
</html>

      