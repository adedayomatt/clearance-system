@extends('layouts.app')

@section('content')
    <div class="container py-2">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        @include('layouts.components.session')
                        <div class="text-center my-2">
                            <img src="{{$student->avatar}}" alt="{{$student->prospect->fullname}}" style="width: 120px; height: 120px; border-radius: 50%">
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
                        <strong class="text-muted">CLEARANCE STAGE</strong>
                        <h4>{{$stage->name}}</h4>
                        <p>{{$stage->description}}</p>
                       @auth('web')
                            <div>
                                <strong class="d-block">Submission</strong>
                                @include('widgets.progress-bar', ['percentage' => $stage->submission_progress($student->id)])
                            </div>
                            <div>
                                <strong class="d-block">Approval</strong>
                                @include('widgets.progress-bar', ['percentage' => $stage->approval_progress($student->id)])
                            </div>
                        @endauth
        
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="p-1">
                        <h4 class="text-center">Requirements</h4>
                    </div>
                    <hr>
                    <div class="card-body">
                        @if($stage->requirements->count() > 0)
                            @foreach ($stage->requirements as $requirement)
                                <div class="my-1">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5>{{$requirement->title}}</h5>
                                            <p>{!!$requirement->instructions!!}</p>
                                            <div>
                                                @switch($requirement->type)
                                                    @case('form')
                                                        Type: Form, {{$requirement->form->name}} 
                                                        @break
                                                    @case('upload')
                                                        Type: Document upload
                                                        @break
                                                    @default
                                                        
                                                @endswitch
                                            </div>
                                            @php
                                                $clearance = $requirement->student_clearance($student->id)
                                            @endphp
                                            @if ($clearance)
                                                <div>
                                                    Submission: <span class="badge badge-success">SUBMITTED</span>, {{$clearance->created_at->format('d F, Y h:i a')}}, {{$clearance->created_at->diffForHumans()}}
                                                </div>
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
                                                <div class="text-right">
                                                    <a href="{{route('admin.clearance.show', $clearance->id)}}" class="btn btn-sm btn-primary">view clearance</a>
                                                </div>
                                            @else
                                                Submission: <span class="badge badge-danger">NOT SUBMITTED</span>
                                            @endif
                                                                   

                                        </div>
                                    </div>
                                
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-danger">
                                No requirement set yet
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection