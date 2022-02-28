<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Results</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        /* table th,table td{
            white-space: nowrap;
        } */
        /* body {
            outline: 3px solid #e1e1e1;
            outline-offset: 10px;
            /* padding: 10px; */
        } */
    </style>
</head>

<body>
    {{-- <h2 class="text-center">Leading Lights</h2> --}}
    <div class="brand-logo text-center pt-5">
        <img src="{{ public_path('img/logo.jpg') }}">
    </div>
    @php
        $current_time = getAsiaTime24(date('Y-m-d H:i:s'));
        $class_details = App\Models\Classes::where('id',$class)->first('name');
    @endphp
    <p><strong>Class :</strong> {{ $class_details->name }}</span>
    <p><strong>Update On: </strong>{{ date('Y-m-d') }} {{ $current_time }}</p>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-sm">
            <thead>
                <tr>
                    <th>Sl. No</th>
                    <th>Student Id</th>
                    <th>Name Of Student</th>
                    <th>Marks</th>
                    <th>Total Marks</th>
                    <th>Division</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($all_result as $i => $result)
                    <tr>
                        @php
                            $subject_details = App\Models\Subject::find($result->subject);
                            $user_details = App\Models\User::find($result->user_id);

                            $total_marks = App\Models\Result::
                                where('results.user_id',$result->user_id)
                                ->where('total_marks', '!=', '')
                                ->join('arrange_exams', 'arrange_exams.id', '=', 'results.exam_id')
                                ->sum('total_marks');
                            $full_marks = App\Models\Result::
                                where('results.user_id',$result->user_id)
                                ->where('total_marks', '!=', '')
                                ->join('arrange_exams', 'arrange_exams.id', '=', 'results.exam_id')
                                ->sum('full_marks');
                            $percentage = ($total_marks / $full_marks) * 100;
                        @endphp
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $user_details->id_no }}</td>
                        <td>{{ $user_details->first_name }} {{ $user_details->last_name }}</td>
                        <td>{{ $total_marks }}</td>
                        <td>{{ $full_marks }}</td>
                        <td>@if ($percentage > 60)
                            FIrst Division
                        @elseif ($total_marks <= 50 && ($total_marks > 40))
                            Second Division
                        @else
                            Failed
                        @endif</td>
                    </tr>
                @empty
                    <tr>No data found</tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>
