<form action="{{route('requirement.upload', $requirement->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="">Upload <strong>{{$requirement->title}}</strong></label>
        <div class="text-danger">*supported format: pdf, jpg, jpeg</div>
        <input type="file" name="file" class="form-control" required>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success">Upload file</button>
    </div>
</form>