@extends('layouts.admin')

@section('content')
<div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Compras
                    <a href= "/addbuy"  style="margin-top:-7px; float:right;" class="btn btn-success" >Nueva Compra</a>
                </div>
          <form action="/buy/search" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="search" class="form-control" placeholder="Buscar" style="    background-color: white;">
              <span class="input-group-btn">
                <button type="submit" name="Buscar" id="search-btn" class="btn btn-flat" style="    background-color: white;"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
                <div class="panel-body">
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
                                <td>{{ date('d-m-Y', strtotime($d->date_credit))}}</td>
                                <td><a  class="btn btn-success status" data-id="{{$d->id}}"  @if($d->status_pay==1) style="display:none;" @endif >Pagada</a>

                                    <!-- <input type="checkbox" name="status" class="status" data-id="{{$d->id}}" @if($d->status_pay==1) checked @endif></td> -->
                                <td><a href= "{{url('buy/'.$d->id)}}" class="btn btn-info" >Editar</a>&nbsp;&nbsp;
                                <a  data-id="{{$d->id}}"  class="btn btn-danger delete" >Eliminar</a> </td>
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
</div>
<script >
    $(document).ready(function(){
        $('.delete').click(function(event){
                event.preventDefault();
                if(confirm("¿Esto eliminar\xE1 la compra, continuar?")){
                      window.location.href="/deleteBuy/"+$(this).attr('data-id');
                }
            });
        $('.status').click(function(){
            if(confirm("¿Al marcar la compra como pagada se vera reflejado en sus cuentas por pagar?")){
                 thiss = $(this);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                    url:'/updateStatusBuy',
                    method:'POST',
                    data:{id:thiss.attr('data-id'), status: 1},
                    // data:{id:thiss.attr('data-id'), status: ($(this).is(':checked'))?'1':'0'},
                    success: function(data){ 
                        // location.reload();  
                        $('.alertjavascript').show();
                        $('.message').html('Compra marcada como pagada satisfactoriamente');
                        thiss.hide();

                    // window.location.href="/buy";  
                        (thiss.is(':checked'))?thiss.prop('true'):thiss.prop('false');
                    },
                    error:function(error){
                      console.log(error);
                      // alert("ERROR, ACTUALICE LA PAGINA");
                    }
                  });
            }
        });
        });
</script>
@endsection