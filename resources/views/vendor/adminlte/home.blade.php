@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection

@section('contentheader_title')
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			@if(Session::has('unauthorized'))
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
				{{ Session::get('unauthorized') }}    
			</div>
			@endif
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading"  style="background: #1792a4; color: white;"><b>{{ trans('adminlte_lang::message.welcome') }}</b></div>

					<div class="panel-body">
						{{ Auth::user()->name }},
						{{ trans('adminlte_lang::message.logged') }}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
