@extends('layouts.admin')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Nuevo Compra</div>
                <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('/editbuy') }}" id="Form">
                        {{ csrf_field() }}
                      
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Codigo</label>
                          
                            <div class="col-md-6">
                                <input id="name" type="text" disabled class="form-control" value="{{$data->code }}"  >
                                <input type="hidden" name="code" value=" {{$data->code }}">
                                <input type="hidden" name="id" value="{{$data->id}}">
                                @if ($errors->has('code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Tipo de Producto </label>

                            <div class="col-md-6">

                                <select   class="form-control" name="type_product"  required>
                                            <option value="">Seleccione</option>
                                            
                                            <option value="Pollo en pie" @if($data->type_product== 'Pollo en pie') selected @endif >Pollo en pie</option>
                                            <option value="Gallina roja" @if($data->type_product== 'Gallina roja') selected @endif>Gallina roja</option>
                                            <option value="Gallina moles" @if($data->type_product== 'Gallina moles') selected @endif>Gallina moles</option>
                                            
                                </select>

                                @if ($errors->has('type_product'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type_product') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Cantidad</label>

                            <div class="col-md-6">
                                <input  type="number" class="form-control " required name="quantity" value="{{$data->quantity}}" >

                                @if ($errors->has('quantity'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Cantidad en Peso</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control " required name="quantity_weight" value="{{$data->quantity_weight}}" placeholder="Peso en Libras"  >

                                @if ($errors->has('quantity_weight'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('quantity_weight') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Precio</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control price" required name="price_unity" value="{{$data->price_unity}}" placeholder="Precio por unidad"  >

                                @if ($errors->has('price_unity'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price_unity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Tipo de precio </label>

                            <div class="col-md-6">
                                <select   class="form-control" name="type_price" required>
                                            <option value="">Seleccione</option>
                                            <option value="peso" @if($data->type_price== 'peso') selected @endif>Peso</option>
                                            <option value="unidad" @if($data->type_price== 'unidad') selected @endif>Por unidad</option>
                                            
                                </select>

                                @if ($errors->has('type_product'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type_product') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        
                        <div class="form-group{{ $errors->has('roles_id') ? ' has-error' : '' }}">
                            <label for="roles_id" class="col-md-4 control-label">Fecha de Credito</label>

                            <div class="col-md-6">
                               <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" class="form-control pull-right" id="date_credit" @if($data->status_pay==1) disabled @endif name="date_credit" value="{{ date('d-m-Y', strtotime($data->date_credit))}}">
                                </div>
                            </div>
                        </div>

    



                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Editar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){

$("#Form").validate();
$('#date_credit').datepicker({
    startDate: 'Default'
});



    $(".price").inputmask("decimal",{
        integerDigits:5,
        digits:2,
        allowMinus:false,        
        digitsOptional: false,
        placeholder: "0",
        rightAlign: false,
    });

   // $(".price").inputmask('decimal', { digits: 2});
    
});
</script>
@endsection