@extends('layouts.app')

@section('content')
<div class="container py-3">
    @include('layouts.components.session')
    <div class="row justify-content-center">
        <div class="col-md-4">
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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>Start clearance</h4></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('student.clearance.register', $prospect->matric) }}"  enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="preview-image">
                                <label for="">Passport</label>
                                <div class="image-preview-container text-center"></div>
                                <div class="small">Upload your most recent passport</div>
                                <input type="file" name="passport" class="form-control {{ $errors->has('passport') ? ' is-invalid' : '' }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="">ID Card</label>
                                <div class="small">Clear scanned School Id card </div>
                            </div>
                            <div class="col-md-6">
                                <div class="preview-image">
                                    <strong for="">Front</strong>
                                    <div class="image-preview-container text-center"></div>
                                    <input type="file" name="front_id_card" class="form-control {{ $errors->has('front_id_card') ? ' is-invalid' : '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="preview-image">
                                    <strong for="">Back</strong>
                                    <div class="image-preview-container text-center"></div>
                                    <input type="file" name="back_id_card"  class="form-control {{ $errors->has('back_id_card') ? ' is-invalid' : '' }}">
                                </div>
                            </div>
                        </div>
                        <label>Setup password</label>
                        <div class="form-group">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="aaaaaaaa" required>
                        </div>

                        <div class="form-group">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="re-type password" value="aaaaaaaa" required>
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
