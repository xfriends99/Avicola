@extends('layouts.app')

@section('content')
    <div class="container padding">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="/img/icon.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}
                <span id="reauth-email" class="reauth-email"></span>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required class="form-control" placeholder="Email" autofocus>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong style="color:red;">No podemos encontrar un usuario con esa dirección de correo electrónico.</strong>
                    </span>
                @endif
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Enviar</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
@endsection
