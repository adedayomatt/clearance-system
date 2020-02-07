<div class="card">
    <div class="card-body">
        <div class="d-flex">
            <img src="{{$clearance->student->avatar}}" alt="{{$clearance->student->prospect->fullname}}" style="width: 50px; height: 50px; border-radius: 50%">
            <div class="ml-1">
                <strong class="d-block"><a href="{{route('admin.student.show', $clearance->student->matric)}}">{{$clearance->student->prospect->fullname}}</a></strong>
                <div>
                    <small>{{$clearance->student->prospect->level}}L, {{$clearance->created_at->format('d F, Y h:i a')}}, {{$clearance->created_at->diffForHumans()}}</small>
                </div>
                {{$clearance->requirement->title}} for clearance in stage <a href="{{route('clearance.stage.show', $clearance->requirement->clearance_stage->id)}}">{{$clearance->requirement->clearance_stage->name}}</a>
                @if ($clearance->approved())
                    <div>
                        Status: <span class="badge badge-success">APPROVED</span>, {{$clearance->approved_at->format('d F, Y h:i a')}}, {{$clearance->approved_at->diffForHumans()}}
                    </div>
                @else
                    @if($clearance->rejected())
                        <div>
                            Status: <span class="badge badge-danger">REJECTED</span>, {{$clearance->rejected_at->format('d F, Y h:i a')}}, {{$clearance->rejected_at->diffForHumans()}}
                        </div>
                    @else
                        <div>
                            Status: <span class="badge badge-warning">PENDING...</span>
                        </div>
                    @endif
                @endif
                <div class="d-flex">
                    @auth('web')
                        <a href="{{route('clearance.show', $clearance->id)}}" class="btn btn-sm btn-primary mr-auto">view clearance</a>
                    @endauth

                    @auth('admin')
                        <a href="{{route('admin.clearance.show', $clearance->id)}}" class="btn btn-sm btn-primary mr-auto">view clearance</a>
                    @endauth
                </div>

            </div>
        </div>
    </div>
</div>