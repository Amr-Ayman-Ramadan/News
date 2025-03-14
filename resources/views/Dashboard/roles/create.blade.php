@extends("Layouts.Dashboard.app")
@section("title", "Create Role")
@section("content")
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 text-gray-800">Create Role</h1>
            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back to Roles
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Role Details</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.roles.store') }}" method="POST">
                    @csrf
                    @include("Dashboard.roles._form")
                </form>
            </div>
        </div>
    </div>
@endsection
