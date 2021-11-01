<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Results</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  </head>
  <body>
    <h2 class="text-center">Leading Lights</h2>
    <div class="brand-logo text-center pt-5">
        <img src="{{ public_path('img/logo.jpg') }}">
    </div>
    <p><strong>Name of Student:</strong> {{ $user_details->first_name }} {{ $user_details->last_name }}</p>
    <p><strong>Student Id :</strong> {{ $user_details->id_no }}</p>
    @php
        $class_details = App\Models\Classes::where('id',$user_details->class)->first('name')
    @endphp
    <p><strong>Class :</strong> {{ $class_details->name }}</span>
    <table class="table table-bordered">
    <thead>
      <tr>
        <th>Sl. No</th>
        <th>Name Of Subject</th>
        <th>Marks</th>
        <th>Full Marks</th>
      </tr>
      </thead>
      <tbody>
        @foreach ($all_result as $i => $result)
            <tr>
                <td>{{ $i + 1 }}</td>
                @php
                    $subject_details = App\Models\Subject::find($result->subject);
                @endphp
                <td>{{ $subject_details->name }}</td>
                <td>{{ $result->marks }}</td>   
                <td>{{ $result->full_marks }}</td>
            </tr>
        @endforeach
      </tbody>
    </table>
      <table class="table table-bordered">
      <thead class="mt-5 text-secondary">
          <td><strong>Total Marks</strong></td>
    </thead>
    <tbody>
        <tr>
            <td class="text-center text-primary">
                <strong>{{ $total_marks }} / {{ $total_full_marks }}</strong>
            </td>
        </tr>
    </tbody>
    </table>
  </body>
</html>