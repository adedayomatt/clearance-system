@extends('layouts.app')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    @include('layouts.components.session')
                    <div class="row align-items-center justify-content-center">
                        <div class="col-sm-6 col-md-4">
                            @if (isset($prospect))
                                <h4 class="text-success">Congratulations, you are eligible for clearance</h4>
                                <p>Find below your correct information</p>
                                <div class="list-group">
                                    <div class="list-group-item">
                                        Matric: <strong>{{$prospect->matric}}</strong>
                                    </div>
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
                                <div class="my-3">
                                    @if ($prospect->clearance_registered())
                                        <div class="alert alert-info">
                                            You already started your clearance
                                        </div>
                                        <div class="my-2">
                                            <a href="{{route('login')}}" class="btn btn-primary">Continue clearance</a>
                                        </div>
                                    @else
                                        <div class="my-2">
                                            <a href="{{route('student.clearance.start', $prospect->matric)}}" class="btn btn-primary">Start clearance</a>
                                        </div>
                                    @endif
        
                                </div>
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
                                <input type="text" name="matric_number" class="form-control" placeholder="Matric number" value="{{old('matric_number')}}">
                                </div>
            
                                <div class="form-group py-3 text-center">
                                    <button type="submit" class="btn btn-primary">Check matric number</button>
                                </div>
                            </form>
                        </div>
                    </div>
        
                </div>
            </div>
        </div>
    </section>
@endsection