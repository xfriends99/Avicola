@extends('layouts.admin')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Nuevo Compra</div>
                <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('/addsales') }}" id="Form">
                        {{ csrf_field() }}
                      
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Codigo</label>
                          
                            <div class="col-md-6">
                                <input id="name" type="text" disabled class="form-control" value="@if($data) {{$data->id + 1}} @else 1 @endif"  >
                                <input type="hidden" name="code" value="@if($data) {{$data->id + 1}} @else 1 @endif">
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
                                            
                                            <option value="pollo en pie">Pollo en pie</option>
                                            <option value="gallina roja">Gallina roja</option>
                                            <option value="gallina moles">Gallina moles</option>
                                            
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
                                <label for="name" class="col-md-4 control-label">Merma</label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control" required name="merma_weight"   >

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Cantidad pollo muertos</label>

                                <div class="col-md-6">
                                    <input  type="number" class="form-control " required name="quantity_dead"   >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Precio de Pollo Zoologico</label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control price" required name="price_buy_zoo"   >
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Cantidad</label>

                            <div class="col-md-6">
                                <input  type="number" class="form-control " required name="quantity" >

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
                                <input  type="text" class="form-control price" required name="price_unity" placeholder="Precio por unidad"  >

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
                                <select   class="form-control select-service" id="select-service" name="services" >
                                            <option value="">Seleccione</option>
                                            @foreach($services as $s)
                                            <option value="{{$s->id}}">{{$s->name}}</option>
                                            @endforeach
                                </select>
                                @if ($errors->has('type_product'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type_product') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="button" class="btn btn-success change_price"  style="display: none" data-target="#modal-default">
                Cambiar precio
              </button>

                        </div>
          <!--               <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Estatus </label>

                            <div class="col-md-6">
                                <select   class="form-control" name="status" required>
                                            <option value="">Seleccione</option>
                                            <option value="en pie">En pie</option>
                                            <option value="en proceso">En proceso</option>
                                            <option value="entregado">Entregado</option>
                                            <option value="falta de pago">Falta de pago</option>
                                            @if(Auth::user()->rol->id==1)
                                            <option value="cerrada">Cerrada</option>
                                            @endif
                                </select>

                                @if ($errors->has('type_product'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type_product') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->


                        
                        <div class="form-group{{ $errors->has('roles_id') ? ' has-error' : '' }}">
                            <label for="roles_id" class="col-md-4 control-label">Fecha de Credito</label>

                            <div class="col-md-6">
                               <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" class="form-control pull-right" id="date_credit" name="date_credit">
                                </div>
                            </div>
                        </div>

    



                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Agregar
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

$('.select-service').change(function(){
    if($(this).val()!=''){
        $('.change_price').show();
    }else{
        $('.change_price').hide();
    }
});

$('.change_price').click(function(){
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
    // $(".type_product").change(function(){
    //     if($(this).val()=="pollo en pie"){
    //         $('.hide_chiken_pie').show();
    //     }else{
    //         $('.hide_chiken_pie').hide();
    //     }
    // });
});
</script>
@endsection