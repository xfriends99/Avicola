@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Proveedores
                    <a href= "/addprovider"  style="margin-top:-7px; float:right;" class="btn btn-success" >Nuevo Proveedor</a>
                </div>

                <div class="panel-body">
                    @if (Session::has('message'))
                    <div class="alert alert-info">{{ Session::get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                    </div>
                    @endif

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Cédula o Ruc</th>
                                <th>Email</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($providers as $provider)
                            <tr>
                                <th>{{ $provider->name  }}</th>
                                <td>{{ $provider->cedula_ruc }}</td>
                                <td>{{ $provider->email }}</td>
                                <td><a href= "{{url('editProvider/'.$provider->id)}}" class="btn btn-info" >Editar</a>&nbsp;
                                    <a href= "{{url('deleteProvider/'.$provider->id)}}" onClick="return confirm('¿Esta seguro de eliminar al proveedor?');" class="btn btn-danger" >Eliminar</a> </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection