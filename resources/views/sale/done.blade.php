@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.registersale') }}
@endsection

@section('contentheader_title')
@endsection

@section('styles')
	<style type="text/css" media="screen">
		
	</style>
@endsection

@section('main-content')
<div class="container-fluid spark-screen">
	<div class="row">
			{{-- {!! Build::alert_ajax('Cliente Eliminado Exitosamente') !!} --}}
			<div class="panel panel-default">
				<div class="panel-heading header-nuvem">{{ trans('adminlte_lang::message.clientlist') }}</div>
				<div class="panel-body table-responsive bgn">
				</div>
			</div>
	</div>
</div>
@endsection