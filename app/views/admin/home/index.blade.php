@extends('admin.base')

@section('content')
<div class="page-header">
	<div class="row">
		<div class="large-6 columns">
			<h3>{{ Lang::get('gorilla.home.title') }}</h3>
		</div>
		<div class="large-6 columns text-right">
			<h4 class="subheader text-info"><i class="foundicon-calendar"></i>&emsp; {{ $now }}</h4>
		</div>
	</div>
</div>

<div class="row">
	<div class="large-4 columns">
		<ul class="pricing-table">
			<li class="title">{{ strtoupper(Lang::get('gorilla.posts.plur')) }}</li>
			<li class="price">
				<h2><a href="{{ URL::route('admin_posts') }}">{{ $totals['posts'] }}</a></h2>
			</li>
		</ul>
	</div>
	<div class="large-4 columns">
		<ul class="pricing-table">
			<li class="title">{{ strtoupper(Lang::get('gorilla.tags.plur')) }}</li>
			<li class="price">
				<h2><a href="{{ URL::route('admin_tags') }}">{{ $totals['tags'] }}</a></h2>
			</li>
		</ul>
	</div>
	<div class="large-4 columns">
		<ul class="pricing-table">
			<li class="title">{{ strtoupper(Lang::get('gorilla.users.plur')) }}</li>
			<li class="price">
				<h2><a href="{{ URL::route('admin_users') }}">{{ $totals['users'] }}</a></h2>
			</li>
		</ul>
	</div>
</div>
@stop