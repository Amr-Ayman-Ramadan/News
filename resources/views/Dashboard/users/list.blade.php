@extends("Layouts.Dashboard.app")

@section("title", "Users")

@section("content")
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Users Management</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Users List</h6>
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i> Add New User
                </a>
            </div>

            <!-- Include Filter Component -->
            @include("Dashboard.users.filter.filter")

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Country</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                        <span class="badge {{ $user->status == 'active' ? 'badge-success' : 'badge-danger' }}">
                                            {{ ucfirst($user->status) }}
                                        </span>
                                </td>
                                <td>{{ $user->country ?? 'N/A' }}</td>
                                <td>
                                    @if($user->image)
                                        <img src="{{ $user->image }}" alt="User Image" class="img-thumbnail rounded-circle" style="width: 50px; height: 50px;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!-- View Button -->
                                        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-info mr-2" title="View User">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        <!-- Edit Button -->
                                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning mr-2" title="Edit User">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <!-- Status Toggle Button -->
                                        <a href="{{ route('admin.users.status', $user->id) }}" class="btn btn-sm {{ $user->status == 'active' ? 'btn-warning' : 'btn-success' }} mr-2" title="{{ $user->status == 'active' ? 'Deactivate User' : 'Activate User' }}">
                                            <i class="fa {{ $user->status == 'active' ? 'fa-stop' : 'fa-play' }}"></i>
                                        </a>

                                        <!-- Delete Button -->
                                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $user->id }})" title="Delete User">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>

                                    <!-- Delete Form -->
                                    <form id="delete_user_{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center alert alert-info">No users found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $users->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection


    <script>
        function confirmDelete(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete_user_${userId}`).submit();
                }
            });
        }
    </script>

