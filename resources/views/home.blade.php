@extends('layouts.app')

@section('style')
    <style>
    .section-1{
        background: linear-gradient(to bottom right,#fff, #f1f1f1 )
    }
    .front-banner h1{
        font-size: 300%;
        font-weight: bolder
    }
    .stages-container{
        background-color: #fff;
        border-radius: 5px;
        padding: 5px;
        margin-top: 20px;
        box-shadow: 0px 50px 50px rgba(0,0,0,.2);
    }
    @media (min-width: 768px){
        .stages-container{
            margin-top: -100px;
        }
    }
    </style>
@endsection
@section('content')
<div class="front-banner">
    <section class="container-fluid section-1" style="padding-top: 20px">
        <div class="row justify-content-center align-items-center">
            <div class="col-sm-8">
                <div class="text-center">
                     <img src="{{asset('image/graduation-cap.png')}}" alt="" style="width: 100%">
                </div>
            </div>
            <div class="col-sm-4">
                 <h1 class="text-primary">Easy</h1>
                 <h4>Online Clearance System</h4>
                 <h4>For</h4>
                 <h1 class="text-primary">Graduating Students</h1>
                 <div class="text-center py-5">
                     <a href="{{ route('student.matric.check') }}" class="btn btn-lg btn-primary">Get Started</a>
                 </div>
            </div>
        </div>
    </section>

   <section class="section-2 container-fluid" style="">
    <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="stages-container">
                    @php
                        $stages = \App\ClearanceStage::all();
                    @endphp
                    @if ($stages->count() > 0)
                        @foreach ($stages as $stage)
                            <div class="my-1">
                                @include('widgets.clearance-stage')
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-danger">
                            No clearance stage yet
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
 
   </section>
@endsection
