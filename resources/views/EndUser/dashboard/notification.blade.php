@extends("Layouts.EndUser.app")
@section("title","")
@section("content")
    <!-- Dashboard Start-->
    <div class="dashboard container">
        <!-- Sidebar -->
        <aside class="col-md-3 nav-sticky dashboard-sidebar">
            <!-- User Info Section -->
            <div class="user-info text-center p-3">
                <img
                    src="./img/news-450x350-2.jpg"
                    alt="User Image"
                    class="rounded-circle mb-2"
                    style="width: 80px; height: 80px; object-fit: cover"
                />
                <h5 class="mb-0" style="color: #ff6f61">Salem Taha</h5>
            </div>

            <!-- Sidebar Menu -->
            <div class="list-group profile-sidebar-menu">
                <a
                    href="{{route("endUser.dashboard.profile")}}"
                    class="list-group-item list-group-item-action menu-item"
                    data-section="profile"
                >
                    <i class="fas fa-user"></i> Profile
                </a>
                <a
                    href="{{route("endUser.dashboard.notifications.index")}}"
                    class="list-group-item list-group-item-action active menu-item"
                    data-section="notifications"
                >
                    <i class="fas fa-bell"></i> Notifications
                </a>
                <a
                    href="./setting.html"
                    class="list-group-item list-group-item-action menu-item"
                    data-section="settings"
                >
                    <i class="fas fa-cog"></i> Settings
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <div class="container">
                <h2 class="mb-4">Notifications</h2>
                @forelse(auth()->user()->notifications as $notification)
                    <a href="{{$notification->data['link']}}?notify={{$notification->id}}">
                        <div class="notification alert alert-info">
                            <strong>You Have Notification From : {{$notification->data["user_name"]}}</strong> Post Title:{{$notification->data['post_title']}}
                            <div class="float-right">
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="dropdown-item text-center">No notifications</div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Dashboard End-->

@endsection
