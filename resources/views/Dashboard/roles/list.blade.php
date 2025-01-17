@extends("Layouts.Dashboard.app")
@section("title", "Roles")
@section("content")
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 text-gray-800">Roles</h1>
            <p class="text-muted">Manage and organize your roles and permissions effectively.</p>
        </div>

        <!-- Data Table Card -->
        <div class="card shadow mb-4">

            <!-- Card Header -->
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Roles List</h6>
                <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Create Role
                </a>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Related Admin </th>
                            <th>Permissions</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->admins->count()}}</td>
                                <td>
                                    @if(!empty($role->permissions))
                                        <ul>
                                            @foreach($role->permissions as $permission)
                                                <li>{{ $permission }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-muted">No Permissions Assigned</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $role->created_at ? $role->created_at->format('Y-m-d') : 'N/A' }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $role->id }})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <form id="delete_role_{{ $role->id }}" action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{$role->id}}">
                            </form>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No Roles Found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <div class="d-flex justify-content-end">
                        {{-- Uncomment if pagination is implemented --}}
                        {{-- {{ $roles->links() }} --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

<script>
    function confirmDelete(roleId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this role?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete_role_${roleId}`).submit();
            }
        });
    }
</script>
