@extends('teacher.layouts.master')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <div>Notification
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="tab-content">
                        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        @if (count((array) $notifications) > 0)
                                            @if ($notification->unreadCount > 0)
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <p class="small text-muted unread-noti-count mb-0">
                                                            <em>{{ $notification->unreadCount }}</b> unread messages
                                                                {{ $notification->unreadCount == 1 ? 'notification' : 'notifications' }}</em>
                                                        </p>


                                                    </div>
                                                    <div class="col-md-6 text-right">
                                                        <button
                                                            class="btn btn-flat btn-outline-danger btn-xs mark-all-read-btn"
                                                            onclick="markAllNotificationRead()"><i
                                                                class="fas fa-tag fa-rotate-90"></i>
                                                            Mark all as read</button>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif


                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="data-list">
                                                    @forelse ($notifications as $noti)
                                                        <a href="javascript: void(0)" class="notification-single"
                                                            onclick="readNotification('{{ $noti->id }}', '{{ $noti->route ? route($noti->route) : '' }}')">
                                                            <div
                                                                class="callout callout-sm {{ $noti->read_flag == 0 ? 'callout-dark' : '' }}">
                                                                <h6 class="heading">{{ $noti->title }}</h6>
                                                                <p class="description">{{ $noti->message }}</p>
                                                                <p class="timing">
                                                                    {{ \carbon\carbon::parse($noti->created_at)->diffForHumans() }}
                                                                </p>
                                                            </div>
                                                        </a>
                                                    @empty
                                                        <p class="small text-muted text-center my-5">No notifications yet
                                                        </p>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @include('hr.layouts.static_footer')
        <script>
            $(document).ready(function() {
                $('#attendance_table').DataTable();
            });
        </script>
    @endsection
