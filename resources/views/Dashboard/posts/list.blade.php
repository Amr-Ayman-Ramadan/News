@extends("Layouts.Dashboard.app")
@section("title", "Posts")
@section("content")
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 text-gray-800">Posts</h1>
            <p class="text-muted">Manage and organize your posts effectively.</p>
        </div>

        <!-- Data Table Card -->
        <div class="card shadow mb-4">

            <!-- Card Header -->
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Posts List</h6>
                <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Create Post
                </a>
            </div>

            <!-- Filter Section -->
            @include("Dashboard.posts.filter.filter")

            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>
                                    <span class="badge badge-{{ $post->status == 'active' ? 'success' : 'secondary' }}">
                                        {{ $post->status == 'active' ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>{{$post->user->name ?? 'N/A' }}</td>
                                <td>{{$post->category->name ?? 'N/A' }}</td>
                                <td>{{ $post->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $post->id }})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <form id="delete_post_{{ $post->id }}" action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display: none;">
                                @csrf @method('DELETE')
                                <input type="hidden" name="id" value="{{$post->id}}">
                            </form>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No Posts Found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <div class="d-flex justify-content-end">
                        {{ $posts->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

<script>
    function confirmDelete(postId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this post?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete_post_${postId}`).submit();
            }
        });
    }
</script>
