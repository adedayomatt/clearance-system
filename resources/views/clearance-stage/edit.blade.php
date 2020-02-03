@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h4 class="text-center">Edit clearance stage</h4>
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.clearance.stage.update', $stage->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="stage name" value="{{$stage->name}}">
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" class="form-control" placeholder="stage description">{{$stage->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">update stage</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection