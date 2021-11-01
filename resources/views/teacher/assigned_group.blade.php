@extends('teacher.layouts.master')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-window-restore"></i>
                        </div>
                        <div>Assigned Group
                        </div>
                    </div>
                </div>
            </div>
            <div class="tabs-animation">
                <div class="table-responsive">
                    <table class="table table-hover bg-table" id="group_table">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Group name</th>
                                <th>Total Students</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groups as $i => $group)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td> {{ $group->name }}</td>
                                    <td>
                                        @php
                                            $ids= explode(',',$group->student_ids);
                                            echo count($ids);
                                        @endphp
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        @include('teacher.layouts.static_footer')
    </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#group_table').DataTable();
        });
    </script>
@endsection
