@extends('install.base')

@section('content')
<h3 class="subheader text-info">{{ Lang::get('gorilla.install.check.title') }} <small class="text-muted">- {{ Lang::get('gorilla.install.check.subtitle') }}</small></h3>

<table class="full-width">
	<tbody>
		@foreach($requirements as $req => $status)
		<tr>
			<td>{{ Lang::get("gorilla.install.check.requirements.{$req}") }}</td>

			@if($status === true)
				<td class="text-success">OK</td>
			@else
				<td class="text-alert">{{ $status }}</td>
			@endif
		</tr>
		@endforeach
	</tbody>
</table>

<hr>

<div class="row">
	<div class="large-12 columns text-center">
		@if($valid)
			<a class="button success small expand" href="{{ URL::to('install/step1') }}">{{ Lang::get('gorilla.install.next') }}</a>
		@else
			<a class="button small expand" href="">{{ Lang::get('gorilla.install.check.repeat') }}</a>
		@endif
	</div>
</div>
@stop