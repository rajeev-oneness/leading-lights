@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <form action="{{ route('teacher.uploadHomeTask') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                            <div class="form-group">
                                <label for="class">Class</label>
                                <select class="custom-select" id="class" name="class">
                                <option  value="">Choose...</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->name }}">{{ $class->name }}</option>  
                                @endforeach
                                </select>
                                @if ($errors->has('class'))
                                    <span style="color: red;">{{ $errors->first('class') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="subject">Class</label>
                                <select class="custom-select" id="subject" name="subject">
                                    <option disabled value="">Choose...</option>
                                    <option value="Math">Math</option>
                                    <option value="History">History</option>  
                                </select>
                                @if ($errors->has('subject'))
                                    <span style="color: red;">{{ $errors->first('subject') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="submission_time">Submission time</label>
                                <input type="time" class="form-control" name="submission_time" id="submission_time">
                                @if ($errors->has('submission_time'))
                                <span style="color: red;">{{ $errors->first('submission_time') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="submission_date">Submission date</label>
                                <input type="date" class="form-control" name="submission_date" id="submission_date">
                                @if ($errors->has('submission_date'))
                                <span style="color: red;">{{ $errors->first('submission_date') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="upload_file">Upload Question Paper as a Document</label>
                                <input type="file" class="form-control" name="upload_file" id="upload_file">
                                @if ($errors->has('upload_file'))
                                <span style="color: red;">{{ $errors->first('upload_file') }}</span>
                                @endif
                            </div>
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary" id='update_profile'>Save</button>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
</script>
@endsection
