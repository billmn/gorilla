<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<title>@lang('gorilla.app_name')</title>

	{{ HTML::style('static/css/normalize.css') }}
	{{ HTML::style('static/css/foundation.min.css') }}
	{{ HTML::style('static/css/admin.css') }}

	{{ HTML::script('static/js/modernizr.min.js') }}
</head>
<body id="auth">
	<div id="sidebar">
		<h1 class="gorilla text-center">@lang('gorilla.app_name')</h1>
		<h6 class="gorilla-sub subheader text-center">@lang('gorilla.app_slogan')</h6>

		<ul class="side-nav">
			<li><a href="#">Link 1</a></li>
			<li><a href="#">Link 2</a></li>
			<li><a href="#">Link 3</a></li>
			<li class="divider"></li>
			<li><a href="{{ URL::route('logout') }}">Logout</a></li>
		</ul>
	</div>

	<div id="contents">
		<div class="row">
			<div class="large-12 columns">
				@yield('content')
			</div>
		</div>
	</div>

	<!-- scripts -->
	{{ HTML::script('static/js/jquery.min.js') }}
	{{ HTML::script('static/js/plugins/foundation/foundation.min.js') }}
	{{ HTML::script('static/js/plugins/placeholder/jquery.placeholder.min.js') }}
	{{ HTML::script('static/js/admin.js') }}

	@yield('bottom_scripts')
</body>
</html>