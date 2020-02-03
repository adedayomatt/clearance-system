@extends('layouts.app')

@section('content')
    <div class="container py-5">
        @include('layouts.components.session')
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h4>Edit Requirement</h4>
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-muted">Stage</h5>
                        <h4> <a href="{{route('clearance.stage.show', $requirement->clearance_stage->id)}}">{{$requirement->clearance_stage->name}}</a> </h4>
                        <p>{{$requirement->clearance_stage->description}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.requirement.update', $requirement->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Requirement title</label>
                                <input type="text" name="title" class="form-control" value="{{$requirement->title}}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Instructions</label>
                                <textarea name="instructions" class="form-control">{{$requirement->instructions}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for=""><input type="checkbox" name="file_upload" {{$requirement->file_upload ? 'checked' : ''}}> Require file upload</label>
                            </div>        
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">Update requirement</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection