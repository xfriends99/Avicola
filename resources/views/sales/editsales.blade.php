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
                                <input id="name" type="text" disabled class="form-control" value="<?php echo str_pad($data->id, 8, "0", STR_PAD_LEFT);?>"  >
                                <input type="hidden" name="code" value="<?php echo str_pad($data->id, 8, "0", STR_PAD_LEFT);?>">
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
                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Peso por libra</label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control" required name="pound_weight"  value="{{$data->pound_weight}}"  >

                                </div>
                            </div>

                         <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Tipo de precio </label>

                            <div class="col-md-6">
                                <select   class="form-control" name="type_price" required>
                                            <option value="">Seleccione</option>
                                            <option value="peso" @if($data->type_price=='peso') selected @endif>Peso</option>
                                            <option value="unidad" @if($data->type_price=='unidad') selected @endif>Por unidad</option>
                                            
                                </select>

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
                                <select   class="form-control select-service" name="services" >
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
                            <button type="button" class="btn btn-success change_price"  data-target="#modal-default">
    Cambiar precio
              </button>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Estatus {{$data->status}} </label>

                            <div class="col-md-6">
                                <select   class="form-control" name="status" required>
                                            <option value="">Seleccione</option>
                                            <!-- <option value="en pie" @if($data->status == 'en pie') selected @endif>En pie</option> -->
                                            <option value="en proceso" @if($data->status == 'en proceso') selected @endif>En proceso</option>
                                            @if($data->type_product == 'pollo en pie' ) <option value="entregado" @if($data->status == 'entregado') selected @endif>Entregado</option> @endif
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
                            <label for="roles_id" class="col-md-4 control-label">Fecha de Credito {{$data->date_credit}}</label>

                            <div class="col-md-6">
                               <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" class="form-control pull-right" id="date_credit" name="date_credit" value="@if($data->date_credit){{ date('d-m-Y', strtotime($data->date_credit))}} @endif" @if($data->status_payment==1) disabled @endif>
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
    <div class="modal fade in" id="modal-service" style=" padding-right: 15px;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Servicio <span class="name-service"></span></h4>
              </div>
              <div class="modal-body">
                     <!-- <div class="col-md-12"> -->
                                <input  type="text" class="form-control price priceservice" required name="priceservice" placeholder=""  >
                                 <input  type="hidden" class="form-control id-service" name="pre"  >
                               
                            <!-- </div> -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary save-service">Editar</button>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function(){

$("#Form").validate();
$('#date_credit').datepicker();
$('.select-service').change(function(){
    if($(this).val()!=''){
        console.log($(this).val());
        $('.change_price').show();
    }else{
        $('.change_price').hide();
    }
});
$('.change_price').click(function(){
//  $( "#Form").validate({
//   rules: {
//     select-service: {
//       required: true

//     }
//   }
// });
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
            url:'/apiservice/'+$('.select-service').val(),
            method:'get',
            success: function(data){      
                console.log(data);  
                $('.priceservice').val(data.price);
                $('.name-service').html(data.name);
                $('.id-service').val(data.id);
            },
            error:function(error){
              console.log(error);
              // alert("ERROR, ACTUALICE LA PAGINA");
            }
          });
    $('#modal-service').modal({
                        show : true
                    });
});

$('.save-service').click(function(){
        console.log($('.id-service').val());
           $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
            url:'/apiservice',
            data:{'price': $('.priceservice').val(), 'id': $('.id-service').val()},
            method:'post',
            success: function(data){      
                console.log(data);  
                $('#modal-service').modal('hide');
                // $('.priceservice').val(data.price);
                // $('.name-service').html(data.name);
            },
            error:function(error){
              console.log(error);
              // alert("ERROR, ACTUALICE LA PAGINA");
            }
          });

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
     if($('.type_product').val()=="pollo en pie"){
            $('.hide_chiken_pie').show();
        }
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