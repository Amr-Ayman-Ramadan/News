@extends("Layouts.Dashboard.app")
@section("title", "Categories")
@section("content")
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 text-gray-800">Categories</h1>
            <p class="text-muted">Manage and organize your categories effectively.</p>
        </div>

        <!-- Data Table Card -->
        <div class="card shadow mb-4">

            <!-- Card Header -->
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Categories List</h6>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-category">
                    <i class="fa fa-plus"></i> Create Category
                </button>
            </div>

            <!-- Filter Section -->
            @include("Dashboard.categories.filter.filter")

            <!-- Card Body -->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Posts Count</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                  <span class="badge badge-{{ $category->status == 'active' ? 'success' : 'secondary' }}">
                                        {{ $category->status == 'active' ? 'Active' : 'Inactive' }}
                                  </span>
                                </td>
                                <td>{{ $category->posts_count }}</td>
                                <td>{{ $category->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#editCategory-{{$category->id}}"  class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $category->id }})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <form id="delete_category_{{ $category->id }}" action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display: none;">
                                @csrf @method('DELETE')
                            </form>
                            <!-- Modal -->
                            <div class="modal fade" id="editCategory-{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Edit Category</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @include("Dashboard.categories.edit")
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No Categories Found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <div class="d-flex justify-content-end">
                        {{ $categories->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Category Modal -->
        @include("Dashboard.categories.create")

    </div>
@endsection

    <script>
        function confirmDelete(categoryId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this category?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete_category_${categoryId}`).submit();
                }
            });
        }
    </script>
