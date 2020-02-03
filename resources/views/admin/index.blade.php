@extends('layouts.app')

@section('content')
    <div class="container py-2">
        <div class="row">
            <div class="col-md-4">
                <div class="">
                    <h4>Clearance Stages</h4>
                    <hr>
                    <div class="">
                        @php
                            $stages = \App\ClearanceStage::all();
                        @endphp
                        @if ($stages->count() > 0)
                            <div class="list-group">
                                @foreach ($stages as $stage)
                                    <div class="list-group-item">
                                        <strong><a href="{{route('clearance.stage.show', $stage->id)}}">{{$stage->name}}</a></strong>
                                        <p>{{$stage->description}}</p>
                                        <hr>
                                        <p><span style="font-size: 150%" class="text-primary">{{number_format($stage->requirements->count())}}</span> requirements</p>
                                        <div class="row">
                                            @php
                                                $submissions = $stage->submissions()
                                            @endphp
                                            <div class="col-3 text-center">
                                                <strong class="d-block text-primary">{{number_format($stage->clearances()->count())}}</strong>
                                                <br>
                                                <div class="text-muted">
                                                    SUBMISSIONS
                                                </div>
                                            </div>
                                            <div class="col-3  text-center">
                                                <strong class="d-block text-success">{{number_format($submissions['approved']->count())}}</strong>
                                                <br>
                                                <div class="text-muted">
                                                    APPROVED
                                                </div>
                                            </div>
                                            <div class="col-3  text-center">
                                                <strong class="d-block text-danger">{{number_format($submissions['rejected']->count())}}</strong>
                                                <br>
                                                <div class="text-muted">
                                                    REJECTED
                                                </div>
                                            </div>
                                            <div class="col-3  text-center">
                                                <strong class="d-block text-warning">{{number_format($submissions['pending']->count())}}</strong>
                                                <br>
                                                <div class="text-muted">
                                                    PENDING
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        @else
                            <div class="alert alert-danger">
                                No clearance stage
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <h4 class="text-center">Recent Clearances</h4>
                @php
                    $clearances = \App\Clearance::orderby('created_at', 'desc')->paginate(20)
                @endphp
                @if ($clearances->count())
                    @foreach ($clearances as $clearance)
                        <div class="my-1">
                            @include('widgets.clearance')
                        </div>
                    @endforeach
                    {!!$clearances->links()!!}
                @else
                    
                @endif
            </div>
        </div>
    </div>
@endsection