@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h4 class="text-center">New clearance stage</h4>
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.clearance.stage.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="stage name" value="{{old('name')}}">
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="description" class="form-control" placeholder="stage description">{{old('description')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Pre-requisite stages</label>
                                @php
                                    $stages = \App\ClearanceStage::all();
                                @endphp
                                <div>
                                    @if ($stages->count() > 0)
                                        @foreach ($stages as $stage)
                                            <label for="" class="m-2"><input type="checkbox" name="pre_requisite[]"> {{$stage->name}}</label>
                                        @endforeach
                                    @else
                                        <div class="alert alert-danger">No other stages</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">Create stage</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection