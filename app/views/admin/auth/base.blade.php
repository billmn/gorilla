<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<title>@lang('gorilla.app_name')</title>

	{{ style('http://fonts.googleapis.com/css?family=Titillium+Web:400,600') }}

	{{ style('css/normalize.css') }}
	{{ style('css/plugins/foundation/foundation.min.css') }}
	{{ style('css/admin.css') }}

	{{ script('js/modernizr.min.js') }}
</head>
<body id="auth">
	<div class="row">
		<div class="large-4 large-centered columns">
			<h1 class="gorilla text-center">@lang('gorilla.app_name')</h1>
			@yield('content')
		</div>
	</div>

	<!-- scripts -->
	{{ script('js/jquery.min.js') }}
	{{ script('js/plugins/foundation/foundation.min.js') }}
	{{ script('js/plugins/placeholder/jquery.placeholder.min.js') }}
	{{ script('js/admin.js') }}

	@yield('bottom_scripts')
</body>
</html>