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
                        <li><a href="{{ route('admin.testimonial.index') }}">All Testimonial</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="#" class="active">View testimonial</a></li>
                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            {{-- <hr> --}}

            <div class="dashboard-body-content mt-5">
                <h5>View Testimonial</h5>
                <div class="float-right">
                    @if ($testimonial->status == "0")
                        <a href="{{ route('admin.testimonial.approve') }}"
                        class="btn btn-info pull-right" onclick="approveTestimonial({{ $testimonial->id }})"
                        id="approveTestimonial">Approve</a>
                    @elseif ($testimonial->status == "1")
                        <a href="{{ route('admin.testimonial.reject') }}"
                        class="btn btn-info pull-right" onclick="rejectTestimonial({{ $testimonial->id }})"
                        id="rejectTestimonial">Reject</a>
                    @elseif ($testimonial->status == "2")
                    <a href="#" class="btn btn-info pull-right">Rejected</a>
                    @endif
                </div>
                <hr>
                @if ($testimonial->status == "1")
                     <h5 class="">This testimonial is verified<i
                    class="text-success fa fa-check-circle"></i></h5>
                @elseif ($testimonial->status == "2")
                    <h5 class="">This testimonial is rejected <i
                    class="text-danger fa fa-times-circle"></i></h5>
                @else
                    <h5 class="">This testimonial is not verified <i
                    class="text-danger fa fa-exclamation-circle"></i></h5>
                @endif
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            @php
                                if ($testimonial->user->image) {
                                    $profile_image_path = $testimonial->user->image;
                                } else {
                                    $profile_image_path = 'frontend/images/img-1.jpg';
                                }

                            @endphp
                            <img src="{{ asset($profile_image_path) }}" alt="John Doe"
                                class="img-fluid">
                        </div>
                        <div class="col-md-8">
                            {!! $testimonial->content !!}
                            <h4 class="mt-5">Name: {{ $testimonial->user->first_name }} {{ $testimonial->user->last_name }}</h4>
                            <h5>Id: {{ $testimonial->user->id_no }}</h5>
                            <h6>Address: {{ $testimonial->user->address ? $testimonial->user->address : 'N/A' }}</h6>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <script>
        function approveTestimonial(testimonial_id){
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
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, APPROVE it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    event.preventDefault();
                    let url = $("#approveTestimonial").attr('href');
                    let data = {
                        testimonial_id: testimonial_id,
                    };
                    $.ajax({
                        url: url,
                        type: "PUT",
                        data: data,
                        dataType: 'json',
                        beforeSend: function() {
                            $("#approveTestimonial").text('Loading...')
                        },
                        success: function(response) {
                            if (response.data === 'approved') {
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
                        'This testimonial status remain same :)',
                        'error'
                    )
                }
            })
        }
        function rejectTestimonial(testimonial_id){
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
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, REJECT it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    event.preventDefault();
                    let url = $("#rejectTestimonial").attr('href');
                    let data = {
                        testimonial_id: testimonial_id,
                    };
                    $.ajax({
                        url: url,
                        type: "PUT",
                        data: data,
                        dataType: 'json',
                        beforeSend: function() {
                            $("#rejectTestimonial").text('Loading...')
                        },
                        success: function(response) {
                            if (response.data === 'approved') {
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
                        'This testimonial status remain same :)',
                        'error'
                    )
                }
            })
        }
    </script>
@endsection
