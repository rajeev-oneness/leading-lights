@extends('student.layouts.master')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-graduation-cap"></i>
                        </div>
                        <div>Testimonial
                        </div>
                    </div>
                </div>
            </div>
            <div class="tabs-animation">
                <div class="card mb-3">
                  @if (session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                      {{ session('success') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  @endif
                  @if (session('error'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{ session('error') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  @endif
                  <div class="card-header">Add Testimonial</div>
                    <form action="{{ route('user.testimonial') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="card-body">
                        <div class="form-group">
                          <label class="control-label">Testimonial Content<span class="text-danger">*</span> </label>
                          <textarea name="content" id="content" cols="5" rows="5" class="form-control"></textarea>
                          {{-- <input type="text" class="form-control" name="content" id="content" value="{{ old('content') }}"  required /> --}}
                          @if ($errors->has('content'))
                              <span style="color: red;">{{ $errors->first('content') }}</span>
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
        @include('teacher.layouts.static_footer')
    </div>
@endsection
