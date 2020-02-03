@extends('layouts.app')

@section('content')
    <div class="container py-2">
        @if ($clearances->count() > 0)
            @foreach ($clearances as $clearance)
                <div class="my-1">
                    @include('widgets.clearance')
                </div>
            @endforeach
        @else
            <div class="alert alert-danger">
                No pending clearance yet
            </div>
        @endif
    </div>
@endsection