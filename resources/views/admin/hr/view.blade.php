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
                        <li><a href="{{ route('admin.hr.index') }}">HR List</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="#" class="active">HR Details</a></li>

                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper d-sm-flex justify-content-between mr-3">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="fa fa-text-height"></i>
                                </div>
                                <div>HR Profile
                                </div>
                            </div>
                            <div class="ml-5">
                                @if ($hr->status == 0)
                                    @if ($hr->rejected == 0)
                                        <a href="{{ route('admin.hr.approve', $hr->id) }}" class="btn btn-info pull-right"
                                            onclick="activeAccount({{ $hr->id }})" id="activeAccount">Approve</a>
                                        <a href="{{ route('admin.hr.reject', $hr->id) }}"
                                            class="btn btn-info pull-right mr-2"
                                            onclick="rejectAccount({{ $hr->id }})" id="rejectAccount">Reject</a>
                                    @elseif ($hr->rejected == 1 && $hr->is_rejected_document_uploaded == 0)
                                        <button class="btn btn-info pull-right mr-2" data-toggle="tooltip"
                                            data-placement="top" title="This account is  rejected">Rejected</button>
                                    @elseif ($hr->rejected == 1 && $hr->is_rejected_document_uploaded == 1)
                                        <a href="{{ route('admin.hr.approve', $hr->id) }}" class="btn btn-info pull-right"
                                            onclick="activeAccount({{ $hr->id }})" id="activeAccount">Approve</a>
                                    @endif
                                @else
                                    @if ($hr->deactivated == 0)
                                        <a href="{{ route('admin.hr.deactivate', $hr->id) }}"
                                            class="btn btn-danger pull-right"
                                            onclick="deactivateAccount({{ $hr->id }})" id="deactivateAccount"
                                            data-toggle="tooltip">Deactivate</a>
                                    @elseif ($hr->deactivated == 1)
                                        <a href="{{ route('admin.hr.activate', $hr->id) }}"
                                            class="btn btn-info pull-right" onclick="activate_account({{ $hr->id }})"
                                            id="activateAccount">Activate</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="tabs-animation">
                        <div class="bg-edit2 p-4">
                            @if ($hr->status == 1 && $hr->deactivated == 0)
                                <h5 class="">This account is verified <i
                                        class="text-success fa fa-check-circle"></i></h5>
                            @elseif ($hr->status == 0 && $hr->rejected == 0)
                                <h5 class="">This account is not verified <i
                                        class="text-danger fa fa-exclamation-circle"></i></h5>
                            @elseif ($hr->status == 0 && $hr->rejected == 1)
                                <h5 class="">This account is rejected <i
                                        class="text-danger fa fa-times-circle"></i></h5>
                            @elseif ($hr->status == 1 && $hr->deactivated == 1)
                                <h5 class="">This account is deactivated <i
                                        class="text-danger fa fa-times-circle"></i></h5>
                            @endif

                            @if ($hr->status == 0 && $hr->rejected == 1 && $hr->is_rejected_document_uploaded == 1)
                                <h6 class="">Document has been uploaded, please verify that!</h6>
                            @endif
                            <div class="row">
                                <div class="col-lg-5 col-sm-4">
                                    <img src="{{ asset($hr->image ? $hr->image : 'frontend/assets/images/avata2.jpg') }}"
                                        class="img-fluid mx-auto">
                                </div>
                                <div class="col-lg-7 col-sm-8 not2">
                                    <p>Joined-
                                        {{ $hr->created_at ? date('d-m-Y', strtotime($hr->created_at)) : 'N/A' }}
                                    </p>
                                    <h4 class="mb-4">{{ $hr->first_name }} {{ $hr->last_name }}<span
                                            class="ml-3">
                                            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> -->
                                        </span></h4>
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-3">
                                            <label>Address:</label>
                                        </div>
                                        <div class="col-lg-6 col-sm-7">
                                            <p id="address">{{ $hr->address ? $hr->address : 'N/A' }}</p>
                                        </div>
                                        <div class="col-lg-2 col-sm-2">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-3">
                                            <label>Mob. No:</label>
                                        </div>
                                        <div class="col-lg-6 col-sm-7">
                                            <p>{{ $hr->mobile ? $hr->mobile : 'N/A' }}</p>
                                        </div>
                                        <div class="col-lg-2 col-sm-2">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-3">
                                            <label>Email Id:</label>
                                        </div>
                                        <div class="col-lg-6 col-sm-7">
                                            <p>{{ $hr->email ? $hr->email : 'N/A' }}</p>
                                        </div>
                                        <div class="col-lg-2 col-sm-2">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-3">
                                            <label>Employee ID:</label>
                                        </div>
                                        <div class="col-lg-6 col-sm-7">
                                            <p>{{ $hr->id_no ? $hr->id_no : 'N/A' }}</p>
                                        </div>
                                        <div class="col-lg-2 col-sm-2">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-3">
                                            <label>Academic Qualification:</label>
                                        </div>
                                        <div class="col-lg-6 col-sm-7">
                                            <p id="qualification">{{ $hr->qualification ? $hr->qualification : 'N/A' }}
                                            </p>
                                        </div>
                                        <div class="col-lg-2 col-sm-2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-12">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="card-header-title font-size-lg text-capitalize mb-4">
                                                My Bio
                                            </div>
                                            <p>{{ $hr->about_us ? $hr->about_us : 'N/A' }}<span></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-12">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="card-header-title font-size-lg text-capitalize mb-4">
                                                Documents
                                            </div>
                                            <ul class="list">
                                                @forelse ($certificates as $certificate)
                                                    <li>
                                                        {{-- <img src="{{ asset($certificate->image) }}"
                                            class="img-fluid mx-auto w-100"> --}}
                                                        <a href="{{ asset($certificate->image) }}" target="_blank"
                                                            class="img-fluid mx-auto w-100">Upload
                                                            documents on
                                                            <span
                                                                title="Update on">{{ date('Y-m-d', strtotime($certificate->created_at)) }}</span>
                                                            <i class="fas fa-arrow-right"></i></a>
                                                    </li>
                                                @empty
                                                    <li>Not Available</li>
                                                @endforelse
                                            </ul>
                                            {{-- <div class="d-sm-flex align-items-baseline justify-content-between">
											<label class="check">PRESENT<span class="ml-2"><i
														class="fa fa-check-circle text-success"></i></span></label>
										</div> --}}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="app-wrapper-footer">
                    <div class="app-footer">
                        <div class="app-footer__inner">
                            <div class="app-footer-right">
                                <ul class="header-megamenu nav">
                                    <li class="nav-item">
                                        <a class="nav-link">
                                            Copyright &copy; 2021 | All Right Reserved
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        // For approve an account
        function activeAccount(hr_id, status) {
            event.preventDefault();
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                iconHtml: '<img src="{{ asset('img/logo.jpg') }}">',
                showCancelButton: true,
                confirmButtonText: 'Yes, APPROVE it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    event.preventDefault();
                    let url = $("#activeAccount").attr('href');
                    let data = {
                        hr_id: hr_id,
                        status: status
                    };
                    $.ajax({
                        url: url,
                        type: "PUT",
                        data: data,
                        dataType: 'json',
                        beforeSend: function() {
                            $("#activeAccount").text('Loading...')
                        },
                        success: function(response) {
                            if (response.data === 'activated') {
                                location.reload();
                            } else {
                                location.reload();
                            }
                        }
                    })
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'This account status remain same :)',
                        'error'
                    )
                }
            })


        }

        // For deactivate an account
        function deactivateAccount(hr_id, status) {
            event.preventDefault();
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                iconHtml: '<img src="{{ asset('img/logo.jpg') }}">',
                showCancelButton: true,
                confirmButtonText: 'Yes, DEACTIVATE it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    event.preventDefault();
                    let url = $("#deactivateAccount").attr('href');
                    let data = {
                        hr_id: hr_id,
                        status: status
                    };
                    $.ajax({
                        url: url,
                        type: "PUT",
                        data: data,
                        dataType: 'json',
                        beforeSend: function() {
                            $("#deactivateAccount").text('Loading...')
                        },
                        success: function(response) {
                            if (response.data === 'inactivated') {
                                location.reload();
                            } else {
                                location.reload();
                            }
                        }
                    })
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'This account status remain ACTIVE :)',
                        'error'
                    )
                }
            })

        }

        // For activate an account
        function activate_account(hr_id, status) {
            event.preventDefault();

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                iconHtml: '<img src="{{ asset('img/logo.jpg') }}">',
                showCancelButton: true,
                confirmButtonText: 'Yes, ACTIVATE it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    event.preventDefault();
                    let url = $("#activateAccount").attr('href');
                    let data = {
                        hr_id: hr_id,
                        status: status
                    };
                    $.ajax({
                        url: url,
                        type: "PUT",
                        data: data,
                        dataType: 'json',
                        beforeSend: function() {
                            $("#activateAccount").text('Loading...')
                        },
                        success: function(response) {
                            if (response.data === 'inactivated') {
                                location.reload();
                            } else {
                                location.reload();
                            }
                        }
                    })
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'This account status remain DEACTIVATE :)',
                        'error'
                    )
                }
            })

        }

        // For reject an account
        function rejectAccount(hr_id) {
            event.preventDefault();
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                iconHtml: '<img src="{{ asset('img/logo.jpg') }}">',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    event.preventDefault();
                    let url = $("#rejectAccount").attr('href');
                    let data = {
                        hr_id: hr_id
                    };
                    $.ajax({
                        url: url,
                        type: "PUT",
                        data: data,
                        dataType: 'json',
                        beforeSend: function() {
                            $("#rejectAccount").text('Loading...')
                        },
                        success: function(response) {
                            if (response.data === 'rejected') {
                                location.reload();
                            }
                        }
                    })
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'This account status remain same :)',
                        'error'
                    )
                }
            })


        }
    </script>
@endsection
