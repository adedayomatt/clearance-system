@if (isset($requirement))
    <div class="card">
        <div class="card-body">
            <h5>{{$requirement->title}}</h5>
            <p>{!!$requirement->instructions!!}</p>
            <p>Requires file upload: {{$requirement->file_upload ? 'Yes' : 'No'}}</p>
            @auth('web')
                @php
                    $clearance = $requirement->student_clearance(auth('web')->user()->id)
                @endphp
                @if ($requirement->file_upload)
                    @if ($clearance)
                        <div>
                            Submission: <span class="badge badge-success">SUBMITTED</span>, {{$clearance->created_at->format('d F, Y h:i a')}}, {{$clearance->created_at->diffForHumans()}}
                        </div>
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
                        <div class="mt-2 text-right">
                            <a href="{{route('clearance.show', $clearance->id)}}" class="btn btn-sm btn-primary">view clearance</a>
                        </div>

                    @else
                        Submission: <span class="badge badge-danger">NOT SUBMITTED</span>
                        <div class="mt-2">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="collapse" data-target="#upload-req-{{$requirement->id}}">Upload {{$requirement->title}}</button>
                            <div class="mt-2 collapse" id="upload-req-{{$requirement->id}}">
                                @include('widgets.upload-requirement')
                            </div>
                        </div>
                    @endif
                @endif
            @endauth

            @auth('admin')
                <a href="{{route('admin.requirement.edit', $requirement->id)}}" class="btn btn-sm btn-primary">Edit requirement</a>
            @endauth
        </div>
    </div>
@endif
