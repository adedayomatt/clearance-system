@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                @include('layouts.components.session')
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center">Edit form: {{$form->name}}</h4>
                        <hr>
                        <form action="{{route('admin.form.update', $form->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Form name</label>
                                <input type="text" name="name" class="form-control" value="{{$form->name}}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">Update form</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection