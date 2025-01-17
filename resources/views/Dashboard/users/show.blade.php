@extends("Layouts.Dashboard.app")
@section("title", "User Details")
@section("content")
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">User Details</h1>

        <!-- User Details Card -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">User Information</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="text-center">
                            @if($user->image)
                                <img src="{{ $user->image }}" alt="User Image" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                            @else
                                <span>No Image</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-8">
                        <table class="table table-bordered">
                            <tr>
                                <th>ID</th>
                                <td>{{ $user->id }}</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{ $user->username }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ ucfirst($user->status) }}</td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td>{{ $user->country }}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $user->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                        </table>
                        <div class="mt-3">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Back to Users</a>
{{--                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Edit User</a>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
