@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Usuarios
                    <a href= "/adduser"  style="margin-top:-7px; float:right;" class="btn btn-success" >Nuevo Usuario</a>
                </div>

                <div class="panel-body">
                    @if (Session::has('message'))
                    <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif

                    <table class="table table-hover">
                        <thead>
                            <tr>

                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Email</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)                     
                            <tr>
                                <th>{{ $user->name  }}</th>
                                <td>{{ $user->surname }}</td>
                                <td>{{ $user->email }}</td>
                                <td><a href= "{{url('profile/'.$user->id)}}" class="btn btn-info" >Editar</a>&nbsp;&nbsp;@if($user->id != Auth::user()->id)
                                <a href= "{{url('deleteUser/'.$user->id)}}" onClick="return confirm('¿Esta seguro?');" class="btn btn-danger" >Eliminar</a> @endif </td>
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