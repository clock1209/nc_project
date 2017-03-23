@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.report') }}
@endsection

@section('contentheader_title')
@endsection

@section('styles')
@endsection

@section('main-content')

<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('alerts.request')
            @include('alerts.unauthorized')
                <div class="panel panel-default">
                    <div class="panel-heading header-nuvem">reporte pedidos</div>
                    <div class="panel-body bgn">
                        {!!Form::open(['route'=>'report.result', 'method'=>'POST', 'class' => 'form-horizontal'])!!}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                        <div class="form-group">
                            <label for="user_lbl" class="col-sm-2 control-label">Usuario:</label>
                            <div class="col-sm-10">
                                {!! Form::select('users', $users2, null, ['class'=>'form-control']) !!}
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <label for="status_lbl" class="col-sm-2 control-label">Estatus:</label>
                            <div class="col-sm-10">
                                {!! Form::select('status', $status, null, ['class'=>'form-control']) !!}
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <label for="searchBy_lbl" class="col-sm-2 control-label">Buscar por:</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-sm-12" id="radios">
                                        {!! Build::rbReport() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="result-div">
                            <div class="col-sm-4 col-md-offset-2">
                                {!!Form::date('date1',$date,['class'=>'form-control datepicker'])!!}
                            </div>
                            <div class="col-sm-1 text-center">
                                <label for="status_lbl" class="col-sm-2 control-label">a</label>
                            </div>
                            <div class="col-sm-4">
                                {!!Form::date('date2',$date,['class'=>'form-control datepicker'])!!}
                            </div>
                        </div>
                        <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> <t class="hidden-xs">Generar Reporte</t></button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        data = $("#radios input[type='radio']:checked").val();
        date = $(".datepicker").val();
        var token = $("#token").val();

        $('body').delegate('#rbMonth','click', function(){
            data = $("#radios input[type='radio']:checked").val();
            $.ajax({
                url: 'report/searchby/'+data,
                headers: {'X-CSRF-TOKEN': token},
                type: 'GET',
                dataType: 'json',
                data: {data: data},
            }).done(function(data){
                console.log(data);
                // console.log(data[0]);
                $("#result-div").empty();
                $("#result-div").html(data.html);
                $.each(data[0], function (key, value){
                    if (key == data[2]) {
                        $('#months').append("<option value='" + key + "' selected>"+ value +"</option>");
                    }else{
                        $('#months').append("<option value='" + key + "'>"+ value +"</option>");
                    }
                });
                $.each(data[1], function (key, value){
                    if (value == data[3]) {
                        console.log('entró');
                        $('#years').append("<option value='" + key + "' selected>"+ value +"</option>");
                    }else{
                        $('#years').append("<option value='" + key + "'>"+ value +"</option>");
                    }
                });
            });
        });

        $('body').delegate('#rbRange','click', function(){
            data = $("#radios input[type='radio']:checked").val();
            $.ajax({
                url: 'report/searchby/'+data,
                headers: {'X-CSRF-TOKEN': token},
                type: 'GET',
                dataType: 'json',
                data: {data: data},
            }).done(function(data){
                console.log(data);
                $("#result-div").empty();
                $("#result-div").html(data.html);
                $(".datepicker").attr('value',date);
            });
        });
    });
</script>

@endsection