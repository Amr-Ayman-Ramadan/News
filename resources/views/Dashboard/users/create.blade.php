@extends("Layouts.Dashboard.app")
@section("title", "Create Users")

@section("content")
        <center>
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                <h2>Create User</h2>
                @include("Dashboard.users._form")
            </form>
        </center>
@endsection
