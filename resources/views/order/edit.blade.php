@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.editorder') }}
@endsection

@section('contentheader_title')
@endsection

@section('styles')
    <style type="text/css" media="screen">
        .linea{
            border-top: 2px solid #ccc;        
            margin-top: 5px;
        }
        .letra{
            font-size:large;
        }
    </style>
@endsection

@section('main-content')

<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('alerts.request')
            @include('alerts.unauthorized')
            <div class="panel panel-default">
                <div class="panel-heading header-nuvem">{{ trans('adminlte_lang::message.editorder') }}</div>

                <div class="panel-body bgn">
                   {!!Form::model($order, ['route'=> ['order.update',$order->id], 'method'=>'PUT', 'class'=>'form-horizontal'])!!}

                   {{-- {!! Form::hidden('client', $client) !!}
                   {!! Form::hidden('user', Auth::user()->username) !!}
                   {!! Form::hidden('address', $address) !!}
                   {!! Form::hidden('budget', $budget) !!}
                   {!! Form::hidden('description', $description) !!}
                   {!! Form::hidden('quote_date', $date) !!}
                   {!! Form::hidden('date', $date) !!}
                   {!! Form::hidden('phonenumber', $phonenumber) !!}
                   {!! Form::hidden('email', $email) !!}
                   {!! Form::hidden('exp_date', $client) !!}
                   {!! Form::hidden('status', 'En progreso') !!} --}}

                    <div class="form-group">
                        <div class="col-sm-8 col-md-offset-3">
                            <div class="text-right">
                                {!!Form::label('client',$order['client'],['class' => 'form-control-static', 'style'=>'margin-right: 10px;'])!!}
                                <a data-toggle="modal" data-target="#cotizacion" class="btn btn-info" id="VerCliente"><i class="glyphicon glyphicon-eye-open"></i> <t class="hidden-xs"> Ver Cotización</t></a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="retainer_lbl" class="col-sm-3 control-label">*{{ trans('adminlte_lang::message.retainer') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::text('retainer',null,['class'=>'form-control'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="delivery_date_lbl" class="col-sm-3 control-label">*{{ trans('adminlte_lang::message.delivery_date') }}:</label>
                        <div class="col-sm-8">
                            {!!Form::date('delivery_date',null,['class'=>'form-control datepicker'])!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="priority_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.priority') }}:</label>
                        <div class="col-sm-8">
                            {!! Form::select('priority', $priority, $prio_sel,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status_lbl" class="col-sm-3 control-label">{{ trans('adminlte_lang::message.status') }}:</label>
                        <div class="col-sm-8">
                            {!! Form::select('status', $status, $sta_sel,['class'=>'form-control']) !!}
                        </div>
                    </div>


                    <div class="text-center">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" id="update" data-toggle="confirmation"><i class="glyphicon glyphicon-floppy-disk"></i> <t class="hidden-xs">Actualizar</t></button>
                            {{-- <a class="btn btn-danger btn-close" href="{{ route('order.destroy').'/'.$order->id }}" ><i class="glyphicon glyphicon-floppy-remove"></i> <t class="hidden-xs">Borrar</t></a> --}}
                            <a data-toggle="modal" data-target="#finalizar" class="btn btn-success" id="VerCliente"><i class="glyphicon glyphicon-eye-open"></i> <t class="hidden-xs"> Finalizar</t></a>
                            <a class="btn btn-danger btn-close" href="{{ route('order.index') }}"><i class="glyphicon glyphicon-remove"></i> <t class="hidden-xs">Cancelar</t></a>
                        </div>
                    </div>

                </div>
                {!!Form::close()!!}
            </div>
        </div>
    </div>

    <div class="modal fade" id="cotizacion">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header header-nuvem">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Datos de Pedido</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{-- <div class="col-md-4 col-sm-4">
                            {!! Form::label('Fecha creación:', null, ['class'=>'form-control etiquetas']) !!}
                            </div>
                            <div class="col-md-8 col-sm-8">
                            {!! Form::label('order_date', null, ['class'=>'form-control bg_etiquetas', 'id'=>'order_date']) !!}
                        </div>
                        <div class="col-md-4 col-sm-4">
                            {!! Form::label('Feche entrega:', null, ['class'=>'form-control etiquetas']) !!}
                            </div>
                            <div class="col-md-8 col-sm-8">
                            {!! Form::label('delivery_date', null, ['class'=>'form-control bg_etiquetas', 'id'=>'delivery_date']) !!}
                        </div> --}}
                        <div class="col-md-3 col-sm-4">
                            {!! Form::label('Cliente:', null, ['class'=>'form-control etiquetas']) !!}
                            </div>
                            <div class="col-md-9 col-sm-8">
                            {!! Form::label('client', $order['client'], ['class'=>'form-control bg_etiquetas', 'id'=>'client']) !!}
                        </div>
                        {{-- <div class="col-md-3 col-sm-4">
                            {!! Form::label('Usuario:', null, ['class'=>'form-control etiquetas']) !!}
                            </div>
                            <div class="col-md-9 col-sm-8">
                            {!! Form::label('user', $order['user'], ['class'=>'form-control bg_etiquetas', 'id'=>'user']) !!}
                        </div> --}}
                        <div class="col-md-3 col-sm-4">
                            {!! Form::label('Teléfono:', null, ['class'=>'form-control etiquetas']) !!}
                            </div>
                            <div class="col-md-9 col-sm-8">
                            {!! Form::label('phone_number', $order['phone_number'], ['class'=>'form-control bg_etiquetas', 'id'=>'phone_number']) !!}
                        </div>
                        <div class="col-md-3 col-sm-4">
                            {!! Form::label('Correo:', null, ['class'=>'form-control etiquetas']) !!}
                            </div>
                            <div class="col-md-9 col-sm-8">
                            {!! Form::label('email', $order['email'], ['class'=>'form-control bg_etiquetas', 'id'=>'email']) !!}
                        </div>
                        <div class="col-md-3 col-sm-4">
                            {!! Form::label('Presupuesto:', null, ['class'=>'form-control etiquetas']) !!}
                            </div>
                            <div class="col-md-9 col-sm-8">
                            {!! Form::label('budget', $order['budget'], ['class'=>'form-control bg_etiquetas', 'id'=>'budget']) !!}
                        </div>
                        <div class="col-md-3 col-sm-4">
                            {!! Form::label('Anticipo:', null, ['class'=>'form-control etiquetas']) !!}
                            </div>
                            <div class="col-md-9 col-sm-8">
                            {!! Form::label('retainer', $order['retainer'], ['class'=>'form-control bg_etiquetas', 'id'=>'retainer']) !!}
                        </div>
                        <div class="col-md-3 col-sm-4">
                            {!! Form::label('Prioridad:', null, ['class'=>'form-control etiquetas']) !!}
                            </div>
                            <div class="col-md-9 col-sm-8">
                            {!! Form::label('priority', $order['priority'], ['class'=>'form-control bg_etiquetas', 'id'=>'priority']) !!}
                        </div>
                        <div class="col-md-3 col-sm-4">
                            {!! Form::label('Estatus:', null, ['class'=>'form-control etiquetas']) !!}
                            </div>
                            <div class="col-md-9 col-sm-8">
                            {!! Form::label('status', $order['status'], ['class'=>'form-control bg_etiquetas', 'id'=>'status']) !!}
                        </div>
                        <div class="col-md-12 col-sm-12">
                            {!! Form::label('Domicilio:', null, ['class'=>'form-control etiquetas']) !!}
                            </div>
                            <div class="col-md-12 col-sm-12" style="margin-bottom: 5px; margin-top: 0px">
                            {{-- {!! Form::textarea('address', null, ['readonly', 'class'=>'form-control bg_etiquetas', 'id'=>'address', 'rows' => '2']) !!} --}}
                            <div class="form-control bg_etiquetas" id="address">{{ $order['address'] }}</div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            {!! Form::label('Descripción:', null, ['class'=>'form-control etiquetas']) !!}
                            </div>
                            <div class="col-md-12 col-sm-12"  style="margin-top: 0px">
                            {{-- {!! Form::textarea('description', null, ['readonly', 'class'=>'form-control bg_etiquetas', 'id'=>'description', 'rows' => '4']) !!} --}}
                            <div class="form-control bg_etiquetas" id="description">{{ $order['description'] }}</div>
                        </div>


                    </div>

                </div>{{-- modal-body --}}
                <div class="modal-footer background-nuvem">
                    <a href="#" data-dismiss="modal" class="btn btn-default">Cerrar</a>
                </div>
            </div>
        </div>
    </div>

     <div class="modal fade" id="finalizar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header header-nuvem">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Finalzación de pedido</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        
                    {!!Form::open(['route'=>'sale.finish', 'method'=>'POST', 'class' => 'form-horizontal'])!!}
                    <div class="col-md-3 col-sm-4">
                        {!! Form::label('Presupuesto:', null, ['class'=>'form-control etiquetas']) !!}
                        </div>
                        <div class="col-md-9 col-sm-8">
                        {!! Form::label('budget', '$'.$order['budget'], ['class'=>'form-control bg_etiquetas', 'id'=>'budget']) !!}
                    </div>
                    <div class="col-md-3 col-sm-4">
                        {!! Form::label('Anticipo:', null, ['class'=>'form-control etiquetas']) !!}
                        </div>
                        <div class="col-md-9 col-sm-8">
                        {!! Form::label('retainer', '$'.$order['retainer'], ['class'=>'form-control bg_etiquetas', 'id'=>'retainer']) !!}
                    </div>
                    {{-- <div class="form-horizontal linea"> --}}
                        <div class="col-md-4 col-sm-4 linea">
                        {!! Form::label('Restante a Pagar:', null, ['class'=>'form-control etiquetas', 'style'=>'margin-top: 5px;']) !!}
                        </div>
                        <div class="col-md-8 col-sm-8 linea">
                        {!! Form::text('Total Restante', '$'.$total_restante, ['class'=>'form-control bg_etiquetas texto', 'id'=>'total_restante', 'style'=>'margin-top: 5px;']) !!}
                    </div>

                    {!! Form::hidden('client', $order['client']) !!}
                   {!! Form::hidden('user', $order['user']) !!}
                   {!! Form::hidden('address', $order['address']) !!}
                   {!! Form::hidden('budget', $order['budget']) !!}
                   {!! Form::hidden('description', $order['description']) !!}
                   {!! Form::hidden('quote_date', $order['quote_date']) !!}
                   {!! Form::hidden('date', $date) !!}
                   {!! Form::hidden('phone_number', $order['phone_number']) !!}
                   {!! Form::hidden('email', $order['email']) !!}
                   {!! Form::hidden('budget', $order['budget']) !!}
                   {!! Form::hidden('retainer', $order['retainer']) !!}

                    {{-- </div> --}}
                    
                    {{-- <div class="form-group text-center"> --}}
                        
                    {{-- </div> --}}
                   

                    </div>{{-- row --}}

                </div>{{-- modal-body --}}
                <div class="modal-footer background-nuvem">
                {!! Form::submit('Finalizar Pedido', ['class'=>'btn btn-success']) !!}
                    <a href="#" data-dismiss="modal" class="btn btn-default">Cerrar</a>
                </div>
                 {!! Form::close() !!}
            </div>
        </div>
    </div>

</div>
</div>

<script>

    $(document).ready(function(){
        $('body').delegate('#update','mouseenter',function(){
            $('[data-toggle=confirmation]').confirmation({
              rootSelector: '[data-toggle=confirmation]',
              title: "¿Está seguro?",
              singleton: true,
              popout: true,
              btnOkLabel: 'Sí',
              btnCancelLabel: 'No',
              placement: 'top',
              onConfirm: function() {
                    $('submit').click();
                },
                onCancel: function() {
                },
            });
        });

        $("[name='homePhone']").inputmask("9999-9999");  //static mask
        $("[name='cellPhone']").inputmask("(99)-9999-9999");  //static mask

        // $('body').delegate('.get-order','click',function(){
        //             odr_id = $(this).attr('odr_id');
        //             $.ajax({
        //                 url : '{{ URL::to("/order") }}' + '/' + odr_id ,
        //                 type : 'GET',
        //                 dataType: 'json',
        //                 data : {id: odr_id}
        //             }).done(function(data){
        //                 console.log(data);
        //                 $("#order_date").html(data.created_at );
        //                 $("#client").html(data.client );
        //                 $("#user").html(data.user );
        //                 $("#phone_number").html(data.phone_number);
        //                 $("#email").html(data.email );
        //                 $("#address").html(data.address );
        //                 $("#description").html(data.description );
        //                 $("#budget").html("$"+data.budget );
        //                 $("#retainer").html("$"+data.retainer );
        //                 $("#delivery_date").html(data.delivery_date );
        //                 $("#priority").html(data.priority );
        //                 $("#status").html(data.status );
        //             });

        //            });
    });
    
</script>
    
@endsection
