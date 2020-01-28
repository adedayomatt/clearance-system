@extends('layouts.app')

@section('style')
    <style>
    .front-banner{
        background: linear-gradient(to bottom right,#fff, #f1f1f1 )
    }
    .front-banner h1{
        font-size: 300%;
        font-weight: bolder
    }
    </style>
@endsection
@section('content')
<div class="container-fluid front-banner">
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
            <div class="text-center">
                <a href="{{ route('student.matric.check') }}" class="btn btn-lg btn-primary">Get Started</a>
            </div>
       </div>
   </div>
</div>
@endsection
