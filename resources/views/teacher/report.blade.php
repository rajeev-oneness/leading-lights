<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Results</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body class="border-dark">
    <h2 class="text-center">Leading Lights</h2>
    <div class="brand-logo text-center pt-5">
        <img src="{{ public_path('img/logo.jpg') }}">
    </div>
    @php
        $current_time = getAsiaTime24(date('Y-m-d H:i:s'))
    @endphp
    <p><strong>Class :</strong> {{ $class }}</span>
    <p><strong>Update On: </strong>{{ date('Y-m-d') }} {{ $current_time }}</p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sl. No</th>
                <th>Student Id</th>
                <th>Name Of Student</th>
                <th>Name Of Subject</th>
                <th>Exam date</th>
                <th>Marks</th>
                <th>Full Marks</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($all_result as $i => $result)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $result->roll_no }}</td>
                    <td>{{ $result->name }}</td>
                    <td>{{ $result->subject }}</td>
                    <td>{{ $result->date }}</td>
                    <td>{{ $result->marks }}</td>
                    <td>{{ $result->full_marks }}</td>
                </tr>
            @empty
                <tr>No data found</tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
