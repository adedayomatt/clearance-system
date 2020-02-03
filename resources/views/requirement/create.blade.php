@extends('layouts.app')

@section('content')
    <div class="container py-5">
        @include('layouts.components.session')
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h4>New Requirement</h4>
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-muted">Stage</h5>
                        <h4> <a href="{{route('clearance.stage.show', $stage->id)}}">{{$stage->name}}</a> </h4>
                        <p>{{$stage->description}}</p>
                        <strong>Other requirements ({{number_format($stage->requirements->count())}})</strong>
                        @if ($stage->requirements->count() > 0)
                            <div class="list-group">
                                @foreach ($stage->requirements as $requirement)
                                    <div class="list-group-item"><a href="{{route('admin.requirement.edit', $requirement->id)}}">{{$requirement->title}}</a></div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-danger">No other requirement for this stage</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.requirement.store', $stage->id)}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Requirement title</label>
                                <input type="text" name="title" class="form-control" value="{{old('title')}}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Instructions</label>
                                <textarea name="instructions" class="form-control">{{old('instructions')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for=""><input type="checkbox" name="file_upload" {{old('file_upload')? 'checked' : ''}}> Require file upload</label>
                            </div>        
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">Add requirement</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection