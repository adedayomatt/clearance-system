@extends('layouts.app')

@section('content')
    <div class="container py-5">
        @include('layouts.components.session')
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h4>Edit Requirement</h4>
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-muted">Stage</h5>
                        <h4> <a href="{{route('clearance.stage.show', $requirement->clearance_stage->id)}}">{{$requirement->clearance_stage->name}}</a> </h4>
                        <p>{{$requirement->clearance_stage->description}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.requirement.update', $requirement->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">Requirement title</label>
                                <input type="text" name="title" class="form-control" value="{{$requirement->title}}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Instructions</label>
                                <textarea name="instructions" class="form-control">{{$requirement->instructions}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="requirement-type">Requirement type</label>
                                <select name="requirement_type" class="form-control" id="requirement-type" required>
                                    <option value="">Select an option</option>
                                    <option value="form" {{$requirement->type == 'form' ? 'selected' : ''}}>Form</option>
                                    <option value="upload" {{$requirement->type == 'upload' ? 'selected' : ''}}>Document upload</option>
                                </select>
                            </div>
                            <div class="form-group" id="type-form" style="display: {{$requirement->type === 'form' ? 'block' : 'none'}}">
                                @php
                                    $forms = \App\Form::all();
                                @endphp
                                <label for="form">Select form to fill</label>
                                @if ($forms->count() > 0)
                                    <select name="form" class="form-control" id="form">
                                        @foreach ($forms as $form)
                                            <option value="{{$form->id}}" {{$form->id == $requirement->form_id ? 'selected' : ''}}>{{$form->name}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <div class="alert alert-danger">
                                        No form created yet
                                    </div>
                                    <a href="{{route('admin.form.create')}}">create form</a>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-primary">Update requirement</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('bottom-scripts')
    <script>
        $(document).ready(function() {
            $('#requirement-type').change(function(e) {
                if($(this).val() === 'form'){
                    $('#type-form').css({'display': 'block'})
                }else{
                    $('#type-form').css({'display': 'none'})
                }
            })
        })
    </script>
@endsection