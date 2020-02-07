<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{$student->matric}}-{{$student->prospect->fullname}}</title>
        <style>
            table{
                width: 100%;
                border: 1px solid #f7f7f7;
                border-collapse: collapse;
            }
            td, th{
                padding: 5px;
                border: 1px solid #f7f7f7
            }
            .no-border{
                border: 0px !important
            }
            .text-center{
                text-align: center
            }
            .text-left{
                text-align: left
            }
            .text-right{
                text-align: right
            }

        </style>
    </head>
    <body>
        <div class="text-center">
            <img src="{{asset('image/ui-brand.jpg')}}" alt="University of Ibadan" style="height: 50px">
        </div>
        <div class="text-center" style="border-bottom: 2px solid #f7f7f7; margin: 5px 0">
            <h2>Final Year Student Clearance</h2>
        </div>
        
        <table>
            <tr>
                <td style="width: 40%">
                    <div class="text-center my-2">
                        <img src="{{asset('storage/students/'.$student->passport)}}" alt="{{$student->prospect->fullname}}" style="width: 120px; height: 120px; border-radius: 50%">
                    </div>
                </td>
                <td style="width: 60%">
                    <table>
                        <tr>
                            <td>Matric</td>
                            <td><strong>{{$student->matric}}</strong></td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td><strong>{{$student->prospect->fullname}}</strong></td>
                        </tr>
                        <tr>
                            <td>Level</td>
                            <td><strong>{{$student->prospect->level}}</strong></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><strong>{{$student->email}}</strong></td>
                        </tr>
                    </table>
                </td>
            </tr>
            {{-- <tr>
                <td>
                    <div class="text-center">
                        <strong>ID (Front)</strong>
                        <div>
                            <img src="{{asset('storage/students/'.$student->school_id_front)}}" alt="{{$student->prospect->fullname}} ID front" style="width: 100%;">
                        </div>
                    </div>
                </td>
                <td>
                    <div class="text-center">
                        <strong>ID (Back)</strong>
                        <div>
                            <img src="{{asset('storage/students/'.$student->school_id_back)}}" alt="{{$student->prospect->fullname}} ID front" style="width: 100%;">
                        </div>
                    </div>
                </td>
            </tr> --}}
        </table>

        @foreach (\App\ClearanceStage::all() as $stage)
                <h3>{{$stage->name}}</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Requirement</th>
                            <th>Submitted</th>
                            <th>Approved</th>
                        </tr>
                    </thead>
                    @foreach ($stage->requirements as $requirement)
                        <tr>
                            <td style="width: 33%">{{$requirement->title}}</td>
                            <td style="width: 33%">{{$requirement->student_clearance($student->id)->created_at->format('d F, Y h:i a')}}</td>
                            <td style="width: 33%">{{$requirement->student_clearance($student->id)->approved_at->format('d F, Y h:i a')}}</td>
                        </tr>
                    @endforeach
                </table>
        @endforeach
    </body>
</html>