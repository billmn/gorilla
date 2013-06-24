<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<title>Foundation 4</title>

	{{ HTML::style('static/css/normalize.css') }}
	{{ HTML::style('static/css/foundation.min.css') }}
	{{ HTML::style('static/css/admin.css') }}

	<script src="{{ asset('static/js/modernizr.min.js') }}"></script>

</head>
<body>
	<div class="row">
		<div class="large-6 large-offset-3 columns">
			<div class="panel">
				@yield('content')
			</div>
		</div>
	</div>

	<!-- scripts -->
	{{ HTML::script('static/js/jquery.min.js') }}
	{{ HTML:: script('static/js/foundation.min.js') }}

	<script type="text/javascript">
		$(document).foundation();
	</script>

</body>
</html>