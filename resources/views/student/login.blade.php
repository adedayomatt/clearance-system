@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-sm-8 col-md-4">
            @include('layouts.components.session')
            <div class="text-center">
                <h4>Login</h4>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control{{ $errors->has('matric') ? ' is-invalid' : '' }}" name="matric" value="{{ old('matric') }}" placeholder="Matric No" required autofocus>
                        </div>

                        <div class="form-group">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <div>
                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                            </div>
                            <div>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
