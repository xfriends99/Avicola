@extends('layouts.admin')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Nuevo Compra</div>
                <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('/editsales') }}" id="Form">
                        {{ csrf_field() }}
                      
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Codigo</label>
                          
                            <div class="col-md-6">
                                <input id="name" type="text" disabled class="form-control" value=" {{$data->id }} "  >
                                <input type="hidden" name="code" value="{{$data->id }} ">
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
                                <select   class="form-control type_product" name="type_product"  required>
                                            <option value="">Seleccione</option>
                                            
                                            <option value="pollo en pie" @if($data->type_product == 'pollo en pie' ) selected @endif>Pollo en pie</option>
                                            <option value="gallina roja"  @if($data->type_product == 'gallina roja' ) selected @endif>Gallina roja</option>
                                            <option value="gallina moles"  @if($data->type_product == 'gallina moles' ) selected @endif>Gallina moles</option>
                                            
                                </select>

                                @if ($errors->has('type_product'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type_product') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div style="display: none" class="hide_chiken_pie">
               <!--              <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Peso</label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control" required name="weight" value="{{$data->merma_weight}}"   >

                                </div>
                            </div> -->
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Merma</label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control" required name="merma_weight" value="{{$data->merma_weight}}"   >

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Cantidad pollo muertos</label>

                                <div class="col-md-6">
                                    <input  type="number" class="form-control " required name="quantity_dead" value="{{$data->quantity_dead}}"  >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Precio de Pollo Zoologico</label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control price" required name="price_buy_zoo"  value="{{$data->price_buy_zoo}}"  >
                                </div>
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
                            <label for="name" class="col-md-4 control-label">Servicio </label>

                            <div class="col-md-6">
                                <select   class="form-control" name="services" >
                                            <option value="">Seleccione</option>
                                            @foreach($services as $s)
                                            <option value="{{$s->id}}" @if($data->service == $s->id) selected @endif>{{$s->name}}</option>
                                            @endforeach
                                </select>
                                @if ($errors->has('type_product'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type_product') }}</strong>
                                    </span>
                                @endif
                            </div>
<a href= "/addsales"   class="btn btn-success" data-toggle="modal" >Cambiar precio</a>

                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Estatus </label>

                            <div class="col-md-6">
                                <select   class="form-control" name="status" required>
                                            <option value="">Seleccione</option>
                                            <option value="en pie" @if($data->status == 'en pie') selected @endif>En pie</option>
                                            <option value="en proceso" @if($data->status == 'en proceso') selected @endif>En proceso</option>
                                            <option value="entregado" @if($data->status == 'entregado') selected @endif>Entregado</option>
                                            <option value="falta de pago" @if($data->status == 'falta de pago') selected @endif>Falta de pago</option>
                                            @if(Auth::user()->rol->id==1)
                                            <option value="cerrada" @if($data->status == 'cerrada') selected @endif>Cerrada</option>
                                            @endif
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
                                  <input type="text" class="form-control pull-right" id="date_credit" name="date_credit" value="{{ date('d-m-Y', strtotime($data->date_credit))}}">
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
<!--     <div class="modal fade in" id="modal-default" style="display: block; padding-right: 15px;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Default Modal</h4>
              </div>
              <div class="modal-body">
                <p>One fine body…</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div> -->
    </div>
</div>


<script>
$(document).ready(function(){

$("#Form").validate();
$('#date_credit').datepicker()


    $(".price").inputmask("decimal",{
        integerDigits:5,
        digits:2,
        allowMinus:false,        
        digitsOptional: false,
        placeholder: "0",
        rightAlign: false,
    });

   // $(".price").inputmask('decimal', { digits: 2});
    $(".type_product").change(function(){
        if($(this).val()=="pollo en pie"){
            $('.hide_chiken_pie').show();
        }else{
            $('.hide_chiken_pie').hide();
        }
    });
});
</script>
@endsection