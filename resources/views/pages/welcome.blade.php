@extends('layouts.default')
@section('content')
	<!-- Demo content -->
	@include('components.initial-component', [
		'title' => '{· meat<strong>code</strong>',
		'image' => themosis_assets() . '/images/screenshot.png',
	])
@endsection