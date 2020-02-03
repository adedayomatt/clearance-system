@extends('layouts.app')

@section('content')
    <div class="container bg-white py-3">
        <h4> Prospective Clearance Students - {{number_format($prospects->count())}}</h4>
        <table class="table table-striped table-hovered">
            <thead>
                <tr>
                    <th>Matric</th>
                    <th>First Name</th>
                    <th>Second Name</th>
                    <th>Other Name</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Clearance status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prospects as $prospect)
                    <tr>
                        <td>{{$prospect->matric}}</td>
                        <td>{{$prospect->first_name}}</td>
                        <td>{{$prospect->last_name}}</td>
                        <td>{{$prospect->other_name}}</td>
                        <td>{{$prospect->email}}</td>
                        <td>{{$prospect->level}}</td>
                        <td class="bg-white">
                            @if ($prospect->clearance_registered())
                                <div>
                                    <strong>Submission</strong>
                                </div>
                                @include('widgets.progress-bar', ['percentage' => $prospect->student->clearance_progress])
                                <div>
                                    <strong>Approval</strong>
                                </div>
                                @include('widgets.progress-bar', ['percentage' => $prospect->student->clearance_approval_progress])
                                <div class="text-right">
                                    <a href="{{route('admin.student.show', $prospect->matric)}}" class="btn btn-sm btn-primary">view student clearance</a>
                                </div>
                            @else
                                <div class="alert alert-danger">
                                    Not started clearance yet
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection