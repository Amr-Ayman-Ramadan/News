@extends("Layouts.EndUser.app")
@section("title","profile")
@section("content")
    <!-- Profile Start -->
    <div class="dashboard container">
        <!-- Sidebar -->
        <aside class="col-md-3 nav-sticky dashboard-sidebar">
            <!-- User Info Section -->
            <div class="user-info text-center p-3">
                <img src="{{asset(auth()->user()->image)}}" alt="User Image" class="rounded-circle mb-2"
                     style="width: 80px; height: 80px; object-fit: cover" />
                <h5 class="mb-0" style="color: #ff6f61">{{auth()->user()->name}}</h5>
            </div>

            <!-- Sidebar Menu -->
            <div class="list-group profile-sidebar-menu">
                <a href="{{route("endUser.dashboard.profile")}}" class="list-group-item list-group-item-action active menu-item" data-section="profile">
                    <i class="fas fa-user"></i> Profile
                </a>
                <a href="{{route("endUser.dashboard.notifications.index")}}" class="list-group-item list-group-item-action menu-item" data-section="notifications">
                    <i class="fas fa-bell"></i> Notifications
                </a>
                <a href="./setting.html" class="list-group-item list-group-item-action menu-item" data-section="settings">
                    <i class="fas fa-cog"></i> Settings
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Profile Section -->
            <section id="profile" class="content-section active">
                <h2>User Profile</h2>
                <div class="user-profile mb-3">
                    <img src="{{asset(auth()->user()->image)}}" alt="User Image" class="profile-img rounded-circle" style="width: 100px; height: 100px;" />
                    <span class="username">{{auth()->user()->username}}</span>
                </div>
                <br>
                @if (session()->has("errors"))
                    <div class="alert alert-danger">
                        @foreach(session("errors")->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </div>
                @endif
                <form action="{{route("endUser.dashboard.post.store")}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Add Post Section -->
                    <section id="add-post" class="add-post-section mb-5">
                        <h2>Add Post</h2>
                        <div class="post-form p-3 border rounded">
                            <!-- Post Title -->
                            <input type="text" name="title" id="postTitle" class="form-control mb-2" placeholder="Post Title" />

                            <!-- Post Content -->
                            <textarea id="postContent" name="description" class="form-control mb-2" rows="3" placeholder="What's on your mind?"></textarea>

                            <!-- Image Upload -->
                            <input type="file" id="postImage" name="images[]" class="form-control mb-2" accept="image/*" multiple />
                            <div class="tn-slider mb-2">
                                <div id="imagePreview" class="slick-slider"></div>
                            </div>

                            <!-- Category Dropdown -->
                            <select id="postCategory"  name="category_id" class="form-select mb-2">
                                <option value="" selected disabled>Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>

                            <!-- Enable Comments Checkbox -->
                            <label class="form-check-label mb-2">
                                <input type="checkbox" name="comment_able" class="form-check-input" /> Enable Comments
                            </label><br>

                            <!-- Post Button -->
                            <button type="submit" class="btn btn-primary post-btn">Post</button>
                        </div>
                    </section>
                    <!-- Posts Section -->
                </form>

                <section id="posts" class="posts-section">
                    <h2>Recent Posts</h2>
                    <div class="post-list">
                        <!-- Post Item -->
                        @foreach($posts as $post)
                            <div class="post-item mb-4 p-3 border rounded">
                                <div class="post-header d-flex align-items-center mb-2">
                                    <img src="{{$post->user->image }}" alt="User Image" class="rounded-circle" style="width: 50px; height: 50px;" />
                                    <div class="ms-3">
                                        <h5 class="mb-0">{{ auth()->user()->name }}</h5>
                                        <small class="text-muted">2 hours ago</small>
                                    </div>
                                </div>
                                <h4 class="post-title">{{ $post->title }}</h4>
                                <p class="post-content">{!! $post->description !!}</p>

                                @if($post->images->count() > 0)
                                    <div id="newsCarousel{{ $post->id }}" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            @foreach($post->images as $index => $image)
                                                <li data-target="#newsCarousel{{ $post->id }}" data-slide-to="{{ $index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                                            @endforeach
                                        </ol>
                                        <div class="carousel-inner">
                                            @foreach($post->images as $image)
                                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                    <img src="{{ asset("storage/" .$image->path) }}" class="d-block w-100" alt="Slide">
                                                    <div class="carousel-caption d-none d-md-block">
                                                        <h5>{{ $post->title }}</h5>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <a class="carousel-control-prev" href="#newsCarousel{{ $post->id }}" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#newsCarousel{{ $post->id }}" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                @endif

                                <div class="post-actions d-flex justify-content-between">
                                    <div class="post-stats">
                                    <span class="me-3">
                                        <i class="fas fa-eye"></i> {{ $post->num_of_views }} views
                                    </span>
                                    </div>
                                    <div>
                                        <a href="{{route("endUser.dashboard.post.edit",$post)}}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="javascript:void(0)"
                                           onclick="confirmDelete({{ $post->id }})"
                                           class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>

                                        <form id="deleteForm{{ $post->id }}" action="{{ route('endUser.dashboard.post.destroy') }}" method="post" style="display: none;">
                                            @csrf @method('DELETE')
                                            <input type="hidden" name="slug" value="{{$post->slug}}">
                                        </form>

                                        <script>
                                            function confirmDelete(postId) {
                                                if (confirm('Are you sure you want to delete this post?')) {
                                                    document.getElementById('deleteForm' + postId).submit();
                                                }
                                            }
                                        </script>

                                        <button class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-comment"></i> Comments
                                        </button>
                                    </div>
                                </div>

                                <!-- Display Comments -->
                                <div class="comments">
                                    <div class="comment">
                                        <img src="" alt="User Image" class="comment-img" />
                                        <div class="comment-content">
                                            <span class="username"></span>
                                            <p class="comment-text">First comment</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Add more posts here dynamically -->
                    </div>
                </section>
            </section>
        </div>
    </div>
    <!-- Profile End -->
@endsection

@push("js")
    <script>
        $(function(){
            $("#postImage").fileinput();

            $('#postContent').summernote({
                placeholder: 'Write your post here...',
                tabsize: 2,
                height: 150, // Set the height of the editor
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });

    </script>
@endpush
