@extends('layouts.app')

@section('content')
    <div class="container py-2">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="p-2 text-center">
                        <h4>Profile</h4>
                    </div>
                    <hr>
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
                            <div class="list-group-item">
                                Email: <strong>{{$student->email}}</strong>
                            </div>
                        </div>  
                       
                        <div class="my-2">
                            <div class="text-center">
                                <strong>ID (Front)</strong>
                            </div>
                            <img src="{{asset('storage/students/'.$student->school_id_front)}}" alt="{{$student->prospect->fullname}} ID front" style="width: 100%;">
                        </div> 
                        <div class="my-2">
                            <div class="text-center">
                                <strong>ID (back)</strong>
                            </div>
                            <img src="{{asset('storage/students/'.$student->school_id_back)}}" alt="{{$student->prospect->fullname}} ID back" style="width: 100%;">
                        </div> 
                        <div class="my-2">
                            <hr>
                            <h5>Clearance Progress</h5>
                            <hr>
                            <div>
                                <strong>Requirement submissions</strong>
                                @include('widgets.progress-bar', ['percentage' => $student->clearance_progress])
                            </div>
                            <div>
                                <strong>Requirement submissionsApproval</strong>
                                @include('widgets.progress-bar', ['percentage' => $student->clearance_approval_progress])
                            </div>
                            
                            @auth('web')
                                <hr>
                                @if ($student->clearance_approval_progress == 100)
                                <div class="alert alert-success">
                                    Congratulations, you are through with your clearance
                                </div>
                                <form action="{{route('student.clearance.certificate')}}" method="post">
                                    @csrf
                                        <button class="btn btn-primary btn-block" type="submit">Print Certificate</button>
                                    </form>
                                @else
                                    <div class="alert alert-danger">
                                        You'll be able to print your clearance certificate when you submit all documents and are approved
                                    </div>
                                    <button class="btn btn-primary btn-block disabled" type="button">Print Certificate</button>
                                @endif

                            @endauth
                        </div>
                        

                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="p-2 text-center">
                        <h4>Clearances</h4>
                    </div>
                    <hr>
                    <div class="card-body">
                        @foreach (\App\ClearanceStage::all() as $stage)
                            <div class="my-1">
                                @include('widgets.clearance-stage', ['student' => $student])
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection