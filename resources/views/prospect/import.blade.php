@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                @include('layouts.components.session')
                <div class="text-center">
                    <h4>Import prospects</h4>
                </div>
                <div class="card">
                    <div class="card-body">
                        <p>Import an excel sheet that consist of students that are eligible for clearance</p>
                        <form action="{{route('admin.prospects.import')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Select and excel file</label>
                                <input type="file" name="file" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                                <small class="text-info">File must be .xlsx</small>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Import</button>
                             </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection