<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	<title>@lang('gorilla.app_name')</title>

	{{ g_style('http://fonts.googleapis.com/css?family=Titillium+Web:400,600') }}

	{{ g_style('css/normalize.css') }}
	{{ g_style('css/plugins/foundation/foundation.min.css') }}
	{{ g_style('css/plugins/foundation/general_foundicons.css') }}
	{{ g_style('css/plugins/foundation/general_foundicons_ie7.css') }}
	{{ g_style('css/plugins/select2/select2.css') }}
	{{ g_style('css/plugins/dropzone/dropzone.css') }}

	{{ g_style('js/plugins/pickadate/themes/default.css') }}
	{{ g_style('js/plugins/pickadate/themes/default.date.css') }}
	{{ g_style('js/plugins/pickadate/themes/default.time.css') }}

	{{ g_style('css/admin.css') }}
	{{ g_style('css/admin-responsive.css') }}

	{{ g_script('js/modernizr.min.js') }}
</head>
<body class="{{ Input::has('no-sidebar') ? 'without-sidebar' : 'with-sidebar' }}">

	@section('sidebar')
	<div id="sidebar">
		<a href="{{ URL::route('admin_home') }}">
			<h1 class="gorilla text-center">@lang('gorilla.app_name')</h1>
			<h6 class="gorilla-sub subheader text-center">@lang('gorilla.app_slogan')</h6>
		</a>

		<ul class="side-nav">
			<li class="{{ starts_with(Request::url(), URL::route('admin_posts')) ? 'menu-link active' : 'menu-link' }}">
				<a href="{{ URL::route('admin_posts') }}"><i class="foundicon-page"></i> @lang('gorilla.posts.title')</a>
			</li>
			<li class="{{ starts_with(Request::url(), URL::route('admin_tags')) ? 'menu-link active' : 'menu-link' }}">
				<a href="{{ URL::route('admin_tags') }}"><i class="foundicon-flag"></i> @lang('gorilla.tags.title')</a>
			</li>
			<li class="{{ starts_with(Request::url(), URL::route('admin_media')) ? 'menu-link active' : 'menu-link' }}">
				<a href="{{ URL::route('admin_media') }}"><i class="foundicon-photo"></i> @lang('gorilla.media.title')</a>
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
			<div class="profile-image"><img class="circle" src="{{ gravatar($logged->email, 40) }}"></div>
			<div class="profile-username">{{ $logged->username }}</div>
			<div class="profile-links">
				<a href="{{ URL::route('admin_user_update', array('id' => $logged->id)) }}">@lang('gorilla.users.profile')</a> &middot;
				<a href="{{ URL::route('logout') }}">@lang('gorilla.actions.logout')</a>
			</div>
		</div>
	</div>
	@show

	<div id="contents">
		<div class="row">
			<div class="large-12 columns">
				@yield('content')
			</div>
		</div>
	</div>

	<!-- media modal -->
	<div id="mediaModal" class="reveal-modal medium">
		<a class="close-reveal-modal">&#215;</a>
	</div>

	<!-- scripts -->
	<script type="text/javascript">
		var locale             = "{{ $locale }}";
		var confirm_question   = "@lang('gorilla.questions.confirm')";
		var media_modal_url    = "{{ URL::route('admin_media_modal', array('no-sidebar' => true, 'data-reveal-ajax' => true)) }}";
		var image_fallback_url = "{{ g_asset('img/media-image.jpg') }}";
	</script>

	{{ g_script('js/jquery.min.js') }}
	{{ g_script('js/plugins/foundation/foundation.min.js') }}
	{{ g_script('js/plugins/placeholder/jquery.placeholder.min.js') }}

	{{ g_script('js/plugins/moment/moment.min.js') }}
	{{ g_script('js/plugins/moment/langs.min.js') }}

	{{ g_script('js/plugins/select2/select2.min.js') }}
	{{ g_script('js/plugins/select2/select2_locale_it.js') }}
	{{ g_script('js/plugins/dropzone/dropzone.min.js') }}

	{{ g_script('js/plugins/pickadate/picker.js') }}
	{{ g_script('js/plugins/pickadate/picker.date.js') }}
	{{ g_script('js/plugins/pickadate/picker.time.js') }}
	{{ g_script('js/plugins/pickadate/legacy.js') }}
	{{ g_script('js/plugins/pickadate/translations/it_IT.js') }}

	{{ g_script('js/plugins/tinymce/tinymce.min.js') }}
	{{ g_script('js/admin.js') }}

	@yield('bottom_scripts')
</body>
</html>