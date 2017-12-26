@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Clientes
                    <a href= "/addclient"  style="margin-top:-7px; float:right;" class="btn btn-success" >Nuevo Cliente</a>
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
                            @foreach($clients as $client)
                            <tr>
                                <th>{{ $client->name  }}</th>
                                <td>{{ $client->cedula_ruc }}</td>
                                <td>{{ $client->email }}</td>
                                <td><a href= "{{url('editClient/'.$client->id)}}" class="btn btn-info" >Editar</a>&nbsp;
                                <a href= "{{url('deleteClient/'.$client->id)}}" onClick="return confirm('¿Esta seguro de eliminar al cliente?');" class="btn btn-danger" >Eliminar</a> </td>
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