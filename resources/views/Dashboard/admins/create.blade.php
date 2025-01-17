@extends("Layouts.Dashboard.app")
@section("title", "Create Admin")
@section("content")
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 text-gray-800">Create Admin</h1>
            <a href="{{ route('admin.admins.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back to Admins
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Admin Details</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.admins.store') }}" method="POST">
                    @csrf
                    @include("Dashboard.admins._form")
                </form>
            </div>
        </div>
    </div>
@endsection
