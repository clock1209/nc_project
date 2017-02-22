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
					<div class="panel-heading header-nuvem">{{ trans('adminlte_lang::message.welcome') }}</div>

					<div class="panel-body bgn text-center">
						<b>{{ Auth::user()->name }}</b>,
						{{ trans('adminlte_lang::message.logged') }}
						<div class="img-padd">
							<img src="{{ asset('/img/nuvem_fs.png') }}" alt="nuvem" class="img-responsive center img-padd">
						</div>
							
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
