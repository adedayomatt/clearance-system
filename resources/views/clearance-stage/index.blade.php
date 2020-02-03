@extends('layouts.app')

@section('content')
    <div class="container py-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h4>Clearance stages</h4>
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
@endsection