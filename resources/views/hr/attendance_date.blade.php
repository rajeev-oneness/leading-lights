@extends('hr.layouts.master')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon"> <i class="fa fa-users"></i>
                        </div>
                        <div>Attendance</div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="card mb-3 col-lg-6">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-header-title mb-4">
                                    Attendance Date Wise
                                </div>
                                <form class="form" action="{{ route('teacher.attendance') }}" method="POST">
                                    @csrf
                                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                        <div class="d-sm-flex align-items-baseline">
                                            <p class="des  mr-2"><span class="mr-2"><i
                                                        class="fa fa-circle"></i></span>Attendance Date</p>
                                            @if (isset($specific_attendance))
                                                @if ($specific_attendance->count() > 0)
                                                    <input type="text" name="date" id="date" class="form-control datepicker"
                                                        value="{{ old('date') ?? $specific_date }}">
                                                @endif
                                            @else
                                                <input type="text" name="date" id="date" class="form-control datepicker"
                                                    value="{{ old('date') }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
                                        @if ($errors->has('date'))
                                            <span style="color: red;">{{ $errors->first('date') }}</span>
                                        @endif
                                        {{-- @if ($errors->has('end_date'))
                                        <span style="color: red;">{{ $errors->first('end_date') }}</span>
                                    @endif --}}
                                    </div>
                                    <button type="submit" class="btn-pill btn btn-dark mt-4" value="attendance"
                                        name="submit_btn">Proceed</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3 col-lg-6">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-header-title mb-4">
                                    Between Two Days
                                </div>
                                @if (session('error'))
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <form class="form" action="" method="POST">
                                    @csrf
                                    <div class="d-sm-flex">
                                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                            <div class=" align-items-baseline">
                                                <p class="des  mr-2"><span class="mr-2"><i
                                                            class="fa fa-circle"></i></span>Start Date</p>


                                                <input type="text" name="start_date" id="start_date"
                                                    class="form-control datepicker" value="">



                                            </div>
                                        </div>
                                        <div class="d-sm-flex align-items-center justify-content-end mb-4 ml-4">
                                            <div class="align-items-baseline">
                                                <p class="des  mr-2"><span class="mr-2"><i
                                                            class="fa fa-circle"></i></span>End Date</p>

                                                <input type="text" name="end_date" id="end_date"
                                                    class="form-control datepicker" value="">



                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
                                        @if ($errors->has('start_date'))
                                            <span style="color: red;">{{ $errors->first('start_date') }}</span>
                                        @endif
                                        @if ($errors->has('end_date'))
                                            <span style="color: red;">{{ $errors->first('end_date') }}</span>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn-pill btn btn-dark mt-4" value="attendance_range"
                                        name="submit_btn">Proceed</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-hover bg-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Roll</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-tr">
                            <td>John Doe</td>
                            <td>1</td>
                            <td><span class="mr-2"><i class="fa fa-check-circle text-success"></i></span>PRESENT
                            </td>
                        </tr>
                        <tr class="bg-tr">
                            <td>John Doe</td>
                            <td>1</td>
                            <td><span class="mr-2"><i class="fa fa-check-circle text-success"></i></span>PRESENT
                            </td>
                        </tr>
                        <tr class="bg-tr">
                            <td>John Doe</td>
                            <td>1</td>
                            <td>
                                <div class="d-sm-flex justify-content-around align-items-center">
                                    <div class="d-sm-flex ab"> <span class="mr-2"><i
                                                class="fa fa-exclamation-circle text-danger"></i></span>ABSENT</div>
                                    <div class="">Applied leave1 Casual Leave Applied</div>
                                </div>
                            </td>
                        </tr>
                        <tr class="bg-tr">
                            <td>John Doe</td>
                            <td>1</td>
                            <td><span class="mr-2"><i class="fa fa-check-circle text-success"></i></span>PRESENT
                            </td>
                        </tr>
                        <tr class="bg-tr">
                            <td>John Doe</td>
                            <td>1</td>
                            <td><span class="mr-2"><i class="fa fa-check-circle text-success"></i></span>PRESENT
                            </td>
                        </tr>
                        <tr class="bg-tr">
                            <td>John Doe</td>
                            <td>1</td>
                            <td>
                                <div class="d-sm-flex justify-content-around align-items-center">
                                    <div class="d-sm-flex ab"> <span class="mr-2"><i
                                                class="fa fa-exclamation-circle text-danger"></i></span>ABSENT</div>
                                    <div class="">Applied leave1 Casual Leave Applied</div>
                                </div>
                                <!-- <span class="mr-2"><i class="fa fa-exclamation-circle text-danger"></i></span>ABSENT Applied leave
    1 Casual Leave Applied</td> -->
                            </td>
                        </tr>
                        <tr class="bg-tr">
                            <td>John Doe</td>
                            <td>1</td>
                            <td><span class="mr-2"><i class="fa fa-check-circle text-success"></i></span>PRESENT
                            </td>
                        </tr>
                        <tr class="bg-tr">
                            <td>John Doe</td>
                            <td>1</td>
                            <td><span class="mr-2"><i class="fa fa-check-circle text-success"></i></span>PRESENT
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @include('hr.layouts.static_footer')
    </div>


@endsection
