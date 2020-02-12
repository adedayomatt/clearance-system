<div class="card">
    <div class="card-body">
        <h4 class="text-center">
            {{$form->name}}
        </h4>
        <hr>
        @auth('web')
            @php
                 $student = Auth::guard('web')->user();
                 $clearance = $student->clearance($requirement->id);
            @endphp 
            @if ($clearance != null && $clearance->approved())
                <div class="alert alert-info">
                    You can no longer edit this form, It's already approved
                </div>
            @endif
        @endauth
        @if ($form->form_fields->count() > 0)
            <form action="{{isset($requirement) ? route('form.submit', [$requirement->id,$form->id]) : '#'}}" method="post">
                @csrf
                <p class="text-center">Field with <span class="text-danger">*</span> are required</p>
                @foreach ($form->form_fields as $field)
                <div class="form-group">
                    <label for="field-{{$field->id}}" >{{$field->label}} @if ($field->required) <span class="text-danger">*</span>  @endif</label>
                    @auth('web')
                        @php
                            $response = $student->form_response($field->id);
                            $value = $response != null ? $response->response : old($field->name);
                        @endphp
                    @endauth
                    <input type="{{$field->type}}" name="{{$field->name}}" value="{{ isset($value) ? $value : ''}}"  class="form-control" id="field-{{$field->id}}" placeholder="{{$field->placeholder}}" {{$field->required ? 'required' : ''}} @auth('admin') readonly @endauth  @auth('web')  {{$clearance != null && $clearance->approved() ? 'readonly' : ''}} @endauth>
                    @auth('admin')
                        <div class="text-right">
                            <a href="{{route('admin.form.field.edit', $field->id)}}">edit field</a>
                        </div>
                    @endauth
                </div>
                @endforeach
                @auth('web')
                    @if ($clearance != null && $clearance->approved())
                        <div class="form-group">
                            <button type="button" class="btn btn-primary disabled" disabled>Submit</button>
                        </div>
                    @else
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    @endif
                        
                @endauth
               
            </form>
        @else
           <div class="alert alert-danger">
              No field in this form yet
            </div> 
        @endif
    </div>
</div>