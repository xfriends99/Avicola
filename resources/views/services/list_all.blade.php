@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Servicios
                    <a href= "/addservice"  style="margin-top:-7px; float:right;" class="btn btn-success" >Nuevo Servicio</a>
                </div>
          <form action="/services/search" method="get" class="sidebar-form">
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
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Tipo de Calculo</th>
                                <th>Fecha</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $d)                     
                            <tr>
                                <td>{{ $d->code  }}</td>
                                <td>{{ $d->name  }}</td>
                                <td>{{ $d->price }}</td>
                                <td>{{ $d->type_calculation }}</td>
                                <td>{{ date('d-m-Y', strtotime($d->created_at))}}</td>
                                <td><a href= "{{url('service/'.$d->id)}}" class="btn btn-info" >Editar</a>&nbsp;&nbsp;
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
                if(confirm("¿Esto eliminar\xE1 el servicio, continuar?")){
                      window.location.href="/deleteService/"+$(this).attr('data-id');
                }
            });
        });
</script>
@endsection