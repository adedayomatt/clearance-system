@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                @include('layouts.components.session')
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center">New Form Field for <a href="{{route('form.show', $form->id)}}">{{$form->name}}</a></h4>
                        <hr>
                        <form action="{{route('admin.form.field.store', $form->id)}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Field Label</label>
                                <input type="text" name="label" class="form-control" value="{{old('label')}}">
                            </div>
                            <div class="form-group">
                                <label for="">Placeholder</label>
                                <input type="text" name="placeholder" class="form-control" value="{{old('placeholder')}}">
                            </div>
                            <div class="form-group">
                                <label for=""><input type="checkbox" name="required" id=""> Field is compulsoery</label>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">Add Field</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection