    @extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Editar proveedor</div>
                <div class="panel-body">
                    
                    @if (Session::has('message'))
                    <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif

                    <form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('/editProvider') }}">
                        {{ csrf_field() }}

                        <input id="provider_id" type="hidden" class="form-control" name="provider_id" value="{{ $provider->id }}">
                        <div class="form-group{{ $errors->has('cedula_ruc') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Cédula o RUC</label>

                            <div class="col-md-6">
                                <input id="cedula_ruc" type="text" class="form-control" name="cedula_ruc" value="{{ $provider->cedula_ruc }}" required autofocus>

                                @if ($errors->has('cedula_ruc'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cedula_ruc') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $provider->name }}" required >

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $provider->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Télefono</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ $provider->phone }}" required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('direction') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Dirección</label>

                            <div class="col-md-6">
                                <textarea id="direction" type="text" class="form-control" name="direction" required maxlength="200">{{$provider->direction}}</textarea>

                                @if ($errors->has('direction'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('direction') }}</strong>
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
@endsection
