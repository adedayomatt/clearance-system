@extends('layouts.app')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-sm-6 col-md-4">
                    @include('layouts.components.session')
                    @if (isset($prospect))
                        <h4 class="text-success">Congratulations, you are eligible for clearance</h4>
                        <p>Find below your correct information</p>
                        <div class="list-group">
                            <div class="list-group-item">
                                Name: <strong>{{$prospect->fullname}}</strong>
                            </div>
                            <div class="list-group-item">
                                Level: <strong>{{$prospect->level}}</strong>
                            </div>
                            <div class="list-group-item">
                                Email: <strong>{{$prospect->email}}</strong>
                            </div>
                        </div>
                        @if ($prospect->clearance_registered())
                            <div class="alert alert-info">
                                You already started your clearance
                            </div>
                            <form action="{{route('login')}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary">Continue clearance</button>
                            </form>
                        @else
                            <form action="{{route('student.clearance.start', $prospect->matric)}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary">Start clearance</button>
                            </form>
                        @endif
                    @else
                        <div class="text-center p-5">
                            <img src="{{asset('image/graduation-avatar.png')}}" style="width: 100%">
                        </div>
                    @endif
                    
                </div>
                <div class="col-sm-6 col-md-4">
                    <form action="{{route('student.matric.confirm')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="text-center">
                                <label for="">Confirm if you are eligible for clearance </label>
                            </div>
                            <input type="text" name="matric_number" class="form-control" placeholder="Matric number">
                        </div>
    
                        <div class="form-group py-3 text-center">
                            <button type="submit" class="btn btn-primary">Check matric number</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection