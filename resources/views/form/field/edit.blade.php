@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                @include('layouts.components.session')
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center">Edit Form Field {{$field->label}} for <a href="{{route('form.show', $field->form->id)}}">{{$field->form->name}}</a></h4>
                        <hr>
                        <form action="{{route('admin.form.field.update', $field->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Field Label</label>
                                <input type="text" name="label" class="form-control" value="{{$field->label}}">
                            </div>
                            <div class="form-group">
                                <label for="">Placeholder</label>
                                <input type="text" name="placeholder" class="form-control" value="{{$field->placeholder}}">
                            </div>
                            <div class="form-group">
                                <label for=""><input type="checkbox" name="required" id="" {{$field->required ? 'checked' : ''}}> Field is compulsoery</label>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">Update Field</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection