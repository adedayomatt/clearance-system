<div class="card">
    <div class="card-body">
        <h4><a href="{{route('clearance.stage.show', $stage->id)}}">{{$stage->name}}</a></h4>
        <p>{{$stage->description}}</p>
        <hr>
        <p><span style="font-size: 150%" class="text-primary">{{number_format($stage->requirements->count())}}</span> requirements</p>
        @if (isset($student))
            <div>
                <strong class="d-block">Submission</strong>
                @include('widgets.progress-bar', ['percentage' => $stage->submission_progress($student->id)])
            </div>
            @auth('web')
                <div class="text-right">
                    <a href="{{route('clearance.stage.show', $stage->id)}}" class="btn btn-sm btn-primary">Go to clearance</a>
                </div>
            @endauth
            <div>
                <strong class="d-block">Approval</strong>
                @include('widgets.progress-bar', ['percentage' => $stage->approval_progress($student->id)])
            </div>
            @auth('admin')
                <div class="text-right">
                    <a href="{{route('admin.student.stage.clearance', [$stage->id, $student->matric])}}" class="btn btn-sm btn-primary">view submissions</a>
                </div>
            @endauth
        @endif
    </div>
</div>
