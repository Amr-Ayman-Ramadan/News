<!-- Top Bar Start -->
<div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="tb-contact">
                    <p><i class="fas fa-envelope"></i>info@mail.com</p>
                    <p><i class="fas fa-phone-alt"></i>+012 345 6789</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="tb-menu">
                    @guest()
                        <a href="{{route("auth.registerPage")}}">Register</a>
                        <a href="{{route("auth.login")}}">Login</a>
                    @endguest
                    @auth()
                        <a href="{{route("auth.logout")}}">Log out</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top Bar Start -->

<!-- Brand Start -->
<div class="brand">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4">
                <div class="b-logo">
                    <a href="index.html">
                        <img src="{{asset("assets/EnduserAssets/img/logo.png")}}" alt="Logo" />
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-4">
                <div class="b-ads">
                    <a href="https://htmlcodex.com">
                        <img src="{{asset("assets/EnduserAssets/img/ads-1.jpg")}}" alt="Ads" />
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <form action="{{route("endUser.search.index")}}" method="post">
                    @csrf
                    <div class="b-search">
                        <input type="text" name="search" placeholder="Search" />
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Brand End -->

<!-- Nav Bar Start -->
<div class="nav-bar">
    <div class="container">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a href="#" class="navbar-brand">MENU</a>
            <button
                type="button"
                class="navbar-toggler"
                data-toggle="collapse"
                data-target="#navbarCollapse"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div
                class="collapse navbar-collapse justify-content-between"
                id="navbarCollapse"
            >
                <div class="navbar-nav mr-auto">
                    <a href="{{route("endUser.home")}}" class="nav-item nav-link active">Home</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle"
                           data-toggle="dropdown">Categories</a>
                        <div class="dropdown-menu">
                        @foreach($categories as $category)
                                <a href="{{route("endUser.category.posts",$category->slug)}}" class="dropdown-item" title="{{$category->name}}">{{$category->name}}</a>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{route("endUser.contact.index")}}" class="nav-item nav-link">Contact Us</a>
                    <a href="{{route("endUser.dashboard.profile")}}" class="nav-item nav-link">Dashboard</a>
                </div>
                <div class="social ml-auto">
                    <!-- Notification Dropdown -->
                    @auth
                        <a href="#" class="nav-link dropdown-toggle" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            <span class="badge badge-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown" style="width: 300px;">
                            <h6 class="dropdown-header">Notifications</h6>

                            @forelse(auth()->user()->unreadNotifications as $notification)
                                <div class="dropdown-item d-flex justify-content-between align-items-center">
                                    <span>
                                        New comment:
                                        <a href="{{ $notification->data['link'] }}?notify={{ $notification->id }}">
                                            {{ Str::limit($notification->data['post_title'], 50) }}
                                        </a>
                                    </span>
                                    <button onclick="document.getElementById('delete-form-{{ $notification->id }}').submit()"
                                            type="button" class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </div>

                                <form id="delete-form-{{ $notification->id }}"
                                      action="{{ route('endUser.dashboard.notifications.destroy') }}"
                                      method="POST" style="display: none;">
                                    @csrf @method('DELETE')
                                    <input type="hidden" name="notification_id" value="{{ $notification->id }}">
                                </form>
                            @empty
                                <div class="dropdown-item text-center">No notifications</div>
                            @endforelse
                        </div>
                    @endauth

                    <!-- Social Links -->
                    <a href=""><i class="fab fa-twitter"></i></a>
                    <a href=""><i class="fab fa-facebook-f"></i></a>
                    <a href=""><i class="fab fa-linkedin-in"></i></a>
                    <a href=""><i class="fab fa-instagram"></i></a>
                    <a href=""><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Nav Bar End -->
