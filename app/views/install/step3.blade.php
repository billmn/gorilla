@extends('install.base')

@section('content')
<h3 class="subheader text-info">{{ Lang::get('gorilla.install.step3.title') }} <small class="text-muted">- {{ Lang::get('gorilla.install.step3.subtitle') }}</small></h3>
<br />

<h4 class="subheader text-center text-success">{{ Lang::get('gorilla.install.step3.description') }}</h4>
<br />

<hr>

<div class="row">
	<div class="large-12 columns text-center">
		<a class="button small expand" href="{{ URL::route('login') }}">{{ Lang::get('gorilla.install.step3.go_to_admin') }}</a>
	</div>
</div>
@stop