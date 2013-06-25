<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<title>@lang('gorilla.app_name')</title>

	{{ HTML::style('g-assets/css/normalize.css') }}
	{{ HTML::style('g-assets/css/plugins/foundation/foundation.min.css') }}
	{{ HTML::style('g-assets/css/admin.css') }}

	{{ HTML::script('g-assets/js/modernizr.min.js') }}
</head>
<body id="auth">
	<div class="row">
		<div class="large-4 large-centered columns">
			<h1 class="gorilla text-center">@lang('gorilla.app_name')</h1>
			@yield('content')
		</div>
	</div>

	<!-- scripts -->
	{{ HTML::script('g-assets/js/jquery.min.js') }}
	{{ HTML::script('g-assets/js/plugins/foundation/foundation.min.js') }}
	{{ HTML::script('g-assets/js/plugins/placeholder/jquery.placeholder.min.js') }}
	{{ HTML::script('g-assets/js/admin.js') }}

	@yield('bottom_scripts')
</body>
</html>