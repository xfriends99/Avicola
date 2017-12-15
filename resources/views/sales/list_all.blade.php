@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Ventas
                    <a href= "/addsales"  style="margin-top:-7px; float:right;" class="btn btn-success" >Nueva Venta</a>
                </div>
                <form action="/sales/search" method="get" class="sidebar-form">
                    <div class="input-group">
                      <input type="text" name="search" class="form-control" placeholder="Buscar">
                          <span class="input-group-btn">
                            <button type="submit" name="Buscar" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                            </button>
                          </span>
                    </div>
                </form>
                <div class="panel-body">
                    @if (Session::has('message'))
                    <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Tipo de Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Fecha</th>
                                <th>Fecha de Credito</th>
                                <th>Pagada</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $d)                     
                            <tr>
                                <td>{{ $d->code  }}</td>
                                <td>{{ $d->type_product  }}</td>
                                <td>{{ $d->quantity }}</td>
                                <td>{{ $d->price_total }}</td>
                                <td>{{ date('d-m-Y', strtotime($d->created_at))}}</td>
                                <td>{{ date('d-m-Y', strtotime($d->date_credit))}}</td>
                                <td><input type="checkbox" name="status" class="status" data-id="{{$d->id}}" @if($d->status_payment==1) checked @endif></td>
                                <td><a href= "{{url('sales/'.$d->id)}}" class="btn btn-info" >Editar</a>&nbsp;&nbsp;
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
                if(confirm("¿Esto eliminar\xE1 la venta, continuar?")){
                      window.location.href="/deleteSales/"+$(this).attr('data-id');
                }
            });
        $('.status').click(function(){
                 thiss = $(this);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                    url:'/updateStatusSales',
                    method:'POST',
                    data:{id:thiss.attr('data-id'), status: ($(this).is(':checked'))?'1':'0'},
                    success: function(data){        
                        (thiss.is(':checked'))?thiss.prop('true'):thiss.prop('false');
                    },
                    error:function(error){
                      console.log(error);
                      // alert("ERROR, ACTUALICE LA PAGINA");
                    }
                  });
            // }
        });
        });
</script>
@endsection