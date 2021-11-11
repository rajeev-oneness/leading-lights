@extends('admin.layouts.master')
@section('content')
    <div class="dashboard-body" id="content">
        <div class="dashboard-content">
            <div class="row m-0 dashboard-content-header">
                <div class="col-lg-6 d-flex">
                    <a id="sidebarCollapse" href="javascript:void(0);">
                        <i class="fas fa-bars"></i>
                    </a>
                    <ul class="breadcrumb p-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="{{ route('admin.classes.index') }}">All Classes List</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="#" class="active">Add class</a></li>
                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="dashboard-body-content">
                <h5>Add Class</h5>
                <hr>
                <form action="{{ route('admin.classes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row m-0 pt-3">
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="name">Class Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span style="color: red;">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="admission_fees">Admission Fees(&#8377;)</label>
                                <input type="number" name="admission_fees" class="form-control" id="admission_fees"
                                    value="{{ old('admission_fees') }}" min="1">
                                @if ($errors->has('admission_fees'))
                                    <span style="color: red;">{{ $errors->first('admission_fees') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group edit-box">
                                <label for="monthly_fees">Monthly Fees(&#8377;)</label>
                                <input type="number" name="monthly_fees" class="form-control" id="monthly_fees"
                                    value="{{ old('monthly_fees') }}" min="1">
                                @if ($errors->has('monthly_fees'))
                                    <span style="color: red;">{{ $errors->first('monthly_fees') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="actionbutton">SAVE</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script>
        CKEDITOR.replace('page_content');
    </script>
@endsection
