@extends('layouts.app')

@section('content')
    <div class="container padding">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="img/login.jpg" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="input-group margen">
                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                    <input id="email" type="email" name="email" class="form-control borderInput" placeholder="Correo electrónico" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="input-group margen">
                    <span class="input-group-addon"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
                    <input id="password" type="password" name="password" class="form-control borderInput" placeholder="Contraseña" required>
                </div>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong style="color:red;">Estas credenciales no coinciden con nuestros registros.</strong>
                    </span>
                @endif
                <div id="remember" class="checkbox white">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordarme
                    </label>
                    <a href="{{ route('password.request') }}" class="forgot-password aright">
                        Olvido su cotraseña?
                    </a>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">LOGIN</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
@endsection
