@extends('layouts.app')
@php
    $student = $clearance->student;
    $requirement = $clearance->requirement;
    $stage = $requirement->clearance_stage;
@endphp
@section('content')
    <div class="container-fluid py-2">
        <div class="row justify-content-center">
            <div class="col-md-3">
                @include('layouts.components.session')
                <div class="card">
                    <div class="card-body">
                        <div class="text-center my-2">
                            <img src="{{asset('storage/students/'.$student->passport)}}" alt="{{$student->prospect->fullname}}" style="width: 120px; height: 120px; border-radius: 50%">
                        </div>
                        <div class="list-group">
                            <div class="list-group-item">
                                Matric: <strong>{{$student->matric}}</strong>
                            </div>
                            <div class="list-group-item">
                                Name: <strong>{{$student->prospect->fullname}}</strong>
                            </div>
                            <div class="list-group-item">
                                Level: <strong>{{$student->prospect->level}}</strong>
                            </div>
                        </div> 
                        <hr>
                        <strong class="d-block text-muted">CLEARANCE STAGE</strong>
                        <h4><a href="{{route('clearance.stage.show', $stage->id)}}">{{$stage->name}}</a></h4>
                        <hr>
                        <strong class="d-block text-muted">REQUIREMENT</strong>
                        {{$requirement->title}}
                        <hr>
                        @if ($clearance->approved())
                            <div>
                                Status: <span class="badge badge-success">APPROVED</span>, {{$clearance->approved_at->format('d F, Y h:i a')}}, {{$clearance->approved_at->diffForHumans()}}
                            </div>
                        @else
                            @if($clearance->rejected())
                                <div>
                                    Status: <span class="badge badge-danger">REJECTED</span>, {{$clearance->rejected_at->format('d F, Y h:i a')}}, {{$clearance->rejected_at->diffForHumans()}}
                                </div>
                            @else
                                <div>
                                    Status: <span class="badge badge-info">PENDING...</span>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                @if ($requirement->file_upload)
                    <h4 class="text-center">Uploaded document</h4>
                    @if($clearance->upload !== null)
                        <div class="text-center">
                            <iframe src="{{$clearance->uploaded_file}}" frameborder="0" style="min-height: 80vh; width: 100%"></iframe>
                        </div>                
                    @else
                        <div class="alert alert-danger">
                            No file uploaded
                        </div>
                    @endif
                @endif
            </div>
            <div class="col-md-3">
                @if ($clearance->upload !== null)
                    <div class="card">
                        <div class="card-body">
                            @auth('web')
                                @if (!$clearance->approved())
                                    <button type="button" class="btn btn-sm btn-primary btn-block" data-toggle="collapse" data-target="#re-upload-req-{{$requirement->id}}">Re-upload {{$requirement->title}}</button>
                                    <div class="mt-2 collapse" id="re-upload-req-{{$requirement->id}}">
                                        @include('widgets.upload-requirement')
                                    </div>                                        
                                @else
                                    <div class="alert alert-success">Clearance approved {{$clearance->approved_at->format('d F, Y h:i a')}}</div>    
                                @endif
                            @endauth
        
                            @auth('admin')
                                    <form action="{{route('admin.clearance.approve', $clearance->id)}}" method="post" class="my-3">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success btn-block">Approve</button>
                                    </form>
                                    <form action="{{route('admin.clearance.reject', $clearance->id)}}" method="post" class="my-3">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger btn-block">Reject</button>
                                    </form>
                            @endauth
                        </div>
                    </div>
               
                @endif
            </div>
        </div>
    </div>
@endsection