<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<title>@lang('gorilla.app_name')</title>

	{{ HTML::style('g-assets/css/normalize.css') }}
	{{ HTML::style('g-assets/css/plugins/foundation/foundation.min.css') }}
	{{ HTML::style('g-assets/css/plugins/foundation/general_foundicons.css') }}
	{{ HTML::style('g-assets/css/plugins/foundation/general_foundicons_ie7.css') }}
	{{ HTML::style('g-assets/css/plugins/select2/select2.css') }}
	{{ HTML::style('g-assets/css/admin.css') }}

	{{ HTML::script('g-assets/js/modernizr.min.js') }}
</head>
<body id="auth">
	<div id="sidebar">
		<a href="{{ URL::route('admin_home') }}">
			<h1 class="gorilla text-center">@lang('gorilla.app_name')</h1>
			<h6 class="gorilla-sub subheader text-center">@lang('gorilla.app_slogan')</h6>
		</a>

		<ul class="side-nav">
			<li class="{{ starts_with(Request::url(), URL::route('admin_posts')) ? 'menu-link active' : 'menu-link' }}">
				<a href="{{ URL::route('admin_posts') }}"><i class="foundicon-page"></i> @lang('gorilla.posts.title')</a>
			</li>
			<li class="{{ starts_with(Request::url(), URL::route('admin_users')) ? 'menu-link active' : 'menu-link' }}">
				<a href="{{ URL::route('admin_users') }}"><i class="foundicon-lock"></i> @lang('gorilla.users.title')</a>
			</li>
			<li class="{{ starts_with(Request::url(), URL::route('admin_settings')) ? 'menu-link active' : 'menu-link' }}">
				<a href="{{ URL::route('admin_settings') }}"><i class="foundicon-settings"></i> @lang('gorilla.settings.title')</a>
			</li>
			<li>
				<a href="/" target="_blank"><i class="foundicon-globe"></i> @lang('gorilla.website_preview')</a>
			</li>
		</ul>

		<div id="profile" class="text-center">
			<div class="profile-image"><img class="circle" src="{{ gravatar($logged->email) }}"></div>
			<div class="profile-username">{{ $logged->username }}</div>
			<div class="profile-links">
				<a href="{{ URL::route('admin_user_update', array('id' => $logged->id)) }}">@lang('gorilla.actions.update')</a> &middot;
				<a href="{{ URL::route('logout') }}">@lang('gorilla.actions.logout')</a>
			</div>
		</div>

		<div id="copyright">
			Created by <a href="https://github.com/billmn" target="_blank">Davide Bellini</a>
		</div>
	</div>

	<div id="contents">
		<div class="row">
			<div class="large-12 columns">
				@yield('content')
			</div>
		</div>
	</div>

	<!-- scripts -->
	<script type="text/javascript">
		var confirm_question = "@lang('gorilla.questions.confirm')";
	</script>

	{{ HTML::script('g-assets/js/jquery.min.js') }}
	{{ HTML::script('g-assets/js/plugins/foundation/foundation.min.js') }}
	{{ HTML::script('g-assets/js/plugins/placeholder/jquery.placeholder.min.js') }}
	{{ HTML::script('g-assets/js/plugins/select2/select2.min.js') }}
	{{ HTML::script('g-assets/js/plugins/select2/select2_locale_it.js') }}
	{{ HTML::script('g-assets/js/plugins/tinymce/tinymce.min.js') }}
	{{ HTML::script('g-assets/js/admin.js') }}

	@yield('bottom_scripts')
</body>
</html>