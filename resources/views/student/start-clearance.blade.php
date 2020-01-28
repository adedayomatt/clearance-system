@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row align-items-center justify-content-center">
        <div class="col-sm-6 col-md-4">
            <div class="list-group">
                <div class="list-group-item">
                    Matric: <strong>{{$prospect->matric}}</strong>
                </div>
                <div class="list-group-item">
                    Name: <strong>{{$prospect->fullname}}</strong>
                </div>
                <div class="list-group-item">
                    Level: <strong>{{$prospect->level}}</strong>
                </div>
                <div class="list-group-item">
                    Email: <strong>{{$prospect->email}}</strong>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <label>Setup password</label>

                        <div class="form-group">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="re-type password" required>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
