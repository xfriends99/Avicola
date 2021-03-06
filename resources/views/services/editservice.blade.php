@extends('layouts.admin')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Nuevo Servicio</div>
                <div class="panel-body">
                    <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('/editService') }}" id="Form">
                        {{ csrf_field() }}
                      
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Codigo</label>

                            <div class="col-md-6">
                                <input id="name" type="text" disabled class="form-control" value="{{$data->code}}"  autofocus>
                                <input type="hidden" name="code" value="{{$data->code}}">
                                <input type="hidden" name="id" value="{{$data->id}}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" maxlength="20"  required value="{{$data->name}}"  autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Precio</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control price" required name="price" value="{{$data->price}}" >

                                @if ($errors->has('price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group{{ $errors->has('type_calculation') ? ' has-error' : '' }}">
                            <label for="roles_id" class="col-md-4 control-label">Tipo de calculo</label>

                            <div class="col-md-6">
                                <select id="roles_id"  class="form-control" name="type_calculation" required>
                                            <option value="">Seleccione</option>
                                            
                                            <option value="peso" @if($data->type_calculation =='peso') selected @endif>Peso</option>
                                            <option value="unidad" @if($data->type_calculation =='unidad') selected @endif>Unidad</option>
                                            
                                </select>

                                @if ($errors->has('type_calculation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type_calculation') }}</strong>
                                    </span>
                                @endif
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
    </div>
</div>
<script>
$(document).ready(function(){

$("#Form").validate();

    $(".price").inputmask("decimal",{
        integerDigits:5,
        digits:2,
        allowMinus:false,        
        digitsOptional: false,
        placeholder: "0",
        rightAlign: false,
    });

    
});
</script>
@endsection