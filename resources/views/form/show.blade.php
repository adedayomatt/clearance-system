@extends('layouts.app')

@section('content')
    <div class="container py-2">
        @include('layouts.components.session')
        <div class="row justify-content-center">
            @if (isset($requirement))
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <span class="text-muted">Clearance stage</span>
                            <h4>{{$requirement->clearance_stage->name}}</h4>
                            <p>{{$requirement->clearance_stage->description}}</p>
                            <hr>
                            <h5>{{$requirement->title}}</h5>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-md-5">
                @include('widgets.form')
            </div>
            @auth('admin')
                <div class="col-md-4">
                    <div class="card">
                        <h5 class="text-center">Add new field</h5>
                        <div class="card-body">
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
            @endauth

        </div>
    </div>
@endsection