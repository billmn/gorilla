<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<title>@lang('gorilla.app_name')</title>

	{{ g_style('http://fonts.googleapis.com/css?family=Titillium+Web:400,600') }}

	{{ g_style('css/normalize.min.css') }}
	{{ g_style('css/plugins/foundation/almost-flat-ui.min.css') }}
	{{ g_style('css/admin.css') }}
	{{ g_style('css/admin-responsive.css') }}

	{{ g_script('js/modernizr.min.js') }}
</head>
<body id="auth">
	<div class="row">
		<div class="large-4 large-centered columns">
			<h1 class="gorilla text-center">@lang('gorilla.app_name')</h1>
			@yield('content')
		</div>
	</div>

	<!-- scripts -->
	{{ g_script('js/jquery.min.js') }}
	{{ g_script('js/plugins/foundation/foundation.min.js') }}
	{{ g_script('js/plugins/placeholder/jquery.placeholder.min.js') }}
	{{ g_script('js/admin.js') }}

	@yield('bottom_scripts')
</body>
</html>