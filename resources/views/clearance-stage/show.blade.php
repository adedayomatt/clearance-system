@extends('layouts.app')

@section('content')
    <div class="container-fluid py-2">
        <div class="row justify-content-center">
            <div class="col-md-3">
                @include('layouts.components.session')
                <div class="card">
                    <div class="card-body">
                        <span class="text-muted">Clearance stage</span>
                        <h4>{{$stage->name}}</h4>
                        <p>{{$stage->description}}</p>
                       @auth('web')
                            @php
                                $student = Auth::guard('web')->user()
                            @endphp
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
            <div class="col-md-4">
                <div class="card">
                    <div class="p-1">
                        <h4 class="text-center">Requirements</h4>
                        @auth('admin')
                            <div class="m-1 text-center">
                                <a href="{{route('admin.clearance.stage.edit', $stage->id)}}" class="btn btn-sm btn-primary">Edit stage</a>
                                <a href="{{route('admin.requirement.create', $stage->id)}}" class="btn btn-sm btn-primary">Add requirement</a>
                            </div>
                        @endauth
                    </div>
                    <hr>
                    <div class="card-body">
                        @if($stage->requirements->count() > 0)
                            @foreach ($stage->requirements as $requirement)
                                <div class="my-1">
                                    @include('widgets.requirement')
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
            <div class="col-md-5">
                @auth('web')
                    <h5>My Clearances</h5>
                    @php
                        $clearances = $stage->clearances($student_id = Auth::guard('web')->user()->id)
                    @endphp
                    @if ($clearances->count() > 0)
                        @foreach($clearances as $clearance)
                            <div class="my-1">
                                @include('widgets.clearance')
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-danger">
                            No clearance for this stage yet
                        </div>
                    @endif
                @endauth

                @auth('admin')
                    <h5>Student Clearances</h5>
                    @php
                        $clearances = $stage->clearances()
                    @endphp
                    @if ($clearances->count() > 0)
                    @foreach($clearances as $clearance)
                        <div class="my-1">
                            @include('widgets.clearance')
                        </div>
                    @endforeach
                    @else
                        <div class="alert alert-danger">
                            No clearance for this stage yet
                        </div>
                    @endif
                @endauth

                @guest('admin')
                        @guest('web')
                            <a href="{{route('login')}}" class="btn btn-primary">Start clearance</a>
                        @endguest
                    
                @endguest
            </div>
        </div>
    </div>
@endsection