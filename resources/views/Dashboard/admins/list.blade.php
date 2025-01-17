@extends("Layouts.Dashboard.app")
@section("title", "Admins")
@section("content")
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 text-gray-800">Admins</h1>
            <p class="text-muted">Manage and organize your admins effectively.</p>
        </div>

        <!-- Data Table Card -->
        <div class="card shadow mb-4">
            <!-- Card Header -->
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Admins List</h6>
                <a href="{{ route('admin.admins.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Create Admin
                </a>
            </div>
            <!-- Filter Section -->
            @include("Dashboard.admins.filter.filter")

            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Status</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($admins as $admin)
                            <tr>
                                <td>{{ $admin->id }}</td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->username }}</td>
                                <td>{{ $admin->status }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->roles->name}}</td>
                                <td>{{ $admin->created_at->format('Y-m-d') }}</td>
                                <td>
{{--                                    <a href="{{ route('admin.admins.show', $admin->id) }}" class="btn btn-sm btn-warning">--}}
{{--                                        <i class="fa fa-eye"></i>--}}
{{--                                    </a>--}}
                                    <a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $admin->id }})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <form id="delete_admin_{{ $admin->id }}" action="{{ route('admin.admins.destroy',$admin->id) }}" method="POST" style="display: none;">
                                @csrf @method('DELETE')
                                <input type="hidden" name="id" value="{{$admin->id}}">
                            </form>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No Admins Found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <div class="d-flex justify-content-end">
                        {{ $admins->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

<script>
    function confirmDelete(adminId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this admin?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete_admin_${adminId}`).submit();
            }
        });
    }
</script>
