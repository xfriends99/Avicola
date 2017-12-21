@extends('layouts.admin')

@section('content')
<div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Ventas
                    <a href= "/addsales"  style="margin-top:-7px; float:right;" class="btn btn-success" >Nueva Venta</a>
                </div>
                <form action="/sales/search" method="get" class="sidebar-form">
                    <div class="input-group">
                      <input type="text" name="search" class="form-control" placeholder="Buscar" style="    background-color: white;">
                          <span class="input-group-btn">
                            <button type="submit" name="Buscar" id="search-btn" class="btn btn-flat" style="    background-color: white;"><i class="fa fa-search"></i>
                            </button>
                          </span>
                    </div>
                </form>
                <div class="panel-body table-responsive">
                    @if (Session::has('message'))
                    <div class="alert alert-info">{{ Session::get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>
                    @endif
                    <div class="alert alert-info alertjavascript" style="display: none;"><span class="message"></span>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    </div>


                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Tipo de Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Fecha</th>
                                <th>Fecha de Credito</th>
                                <th></th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $d)                     
                            <tr>
                                <td>{{ $d->code  }}</td>
                                <td>{{ $d->type_product  }}</td>
                                <td>{{ $d->quantity }}</td>
                                <td><?php echo number_format($d->price_total, 2, ',', '.') ?></td>
                                <td>{{ date('d-m-Y', strtotime($d->created_at))}}</td>
                                <td>@if($d->date_credit){{ date('d-m-Y', strtotime($d->date_credit))}}@endif</td>
                                <td>@if($d->status == 'falta de pago') <a class="btn btn-success status" data-id="{{$d->id}}"  @if($d->status_payment==1) style="display:none;" @endif >Pagada</a> @endif
                                    <!-- <input type="checkbox" name="status" class="status" data-id="{{$d->id}}" @if($d->status_payment==1) checked @endif> -->
                                </td>
                                <td>
                                    @if($d->type_product== 'pollo en pie')  <a class="btn btn-warning merma" id-sale="{{ $d->id  }}" >Merma</a>&nbsp;&nbsp; @endif
                                    @if($d->type_product== 'pollo en pie')<a class="btn btn-warning dead" id-sale="{{ $d->id  }}" >Cargar pollos muertos</a>&nbsp;&nbsp; @endif
                                    @if($d->status != 'falta de pago')<!--<a href= "{{url('sales/'.$d->id)}}" class="btn btn-info editar" >Editar</a>&nbsp;&nbsp; -->@endif
                                    @if($d->status != 'falta de pago')<!--<a data-id="{{$d->id}}"  class="btn btn-danger delete" >Eliminar</a>  -->@endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        <?php echo $data->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="modal fade in" id="modal-merma" style=" padding-right: 15px;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Ingrese el peso total real al entregar el producto <span class="name-service"></span></h4>
              </div>
              <div class="modal-body">
                     <!-- <div class="col-md-12"> -->
                    <input  type="text" class="form-control mermaa"  required name="priceservice" 
                                placeholder="Peso en libras"  >
                    <input  type="hidden" class="form-control id-sales" name="pre"  >
                               
                            <!-- </div> -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-info save-merma">Guardar</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade in" id="modal-dead" style=" padding-right: 15px;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Pollos muertos y ventas al zoologico <span class="name-service"></span></h4>
              </div>
              <div class="modal-body">
                     <!-- <div class="col-md-12"> -->
                    <input  type="number" class="form-control quantity"  placeholder="Catidad de pollos muertos" required name="priceservice"              placeholder=""  ><br>
                    <input  type="text" class="form-control pricezoo price"  placeholder="Precio de venta por unidad" required name="priceservice"              placeholder=""  >
                    <input  type="hidden" class="form-control id-sales2" name="pre"  >
                               
                            <!-- </div> -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-info save-dead">Guardar</button>
              </div>
            </div>
          </div>
        </div>
</div>
<script >
    $(document).ready(function(){
        $('.delete').click(function(event){
                event.preventDefault();
                if(confirm("¿Esto eliminar\xE1 la venta, continuar?")){
                      window.location.href="/deleteSales/"+$(this).attr('data-id');
                }
            });
        $('.status').click(function(){
                 thiss = $(this);
            if(confirm("¿Al marcar la venta como pagada se vera reflejado en sus cuentas por cobrar?")){
  
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                    url:'/updateStatusSales',
                    method:'POST',
                    data:{id:thiss.attr('data-id'), status:1 },
                    success: function(data){      
                        // location.reload();  
                        $('.alertjavascript').show();
                        $('.message').html('Venta marcada como pagada satisfactoriamente');
                        thiss.hide();
                        thiss.siblings('.siblings');
                        (thiss.is(':checked'))?thiss.prop('true'):thiss.prop('false');
                    },
                    error:function(error){
                      console.log(error);
                      // alert("ERROR, ACTUALICE LA PAGINA");
                    }
                  });
            }
        });

        $('.merma').click(function(){
            $('.id-sales2').val($(this).attr('id-sale'));
            $('#modal-merma').modal({
                show: true,
            });
        });

        $('.save-merma').click(function(){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                url:'/updateMermaSales',
                method:'POST',
                data:{id:$('.id-sales2').val(), merma: $('.mermaa').val() },
                success: function(data){     
                            $('.mermaa').val('');
 
                     $('#modal-merma').modal('hide');
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

        $('.dead').click(function(){

            $('.id-sales2').val($(this).attr('id-sale'));
            $('#modal-dead').modal({
                show: true,
            });
        });


        $('.save-dead').click(function(){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                url:'/updateDeadSales',
                method:'POST',
                data:{id:$('.id-sales2').val(), pricezoo: $('.pricezoo').val(), quantity: $('.quantity').val() },
                success: function(data){    
                              $('.quantity').val('');
                         $('.pricezoo').val('');  
                     $('#modal-dead').modal('hide');
                },
                error:function(error){
                  console.log(error);
                  // alert("ERROR, ACTUALICE LA PAGINA");
                }
            });
        });

        });
</script>
@endsection