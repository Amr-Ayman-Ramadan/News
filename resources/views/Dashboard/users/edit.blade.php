@extends("Layouts.Dashboard.app")
@section("title", "Update Users")

@section("content")
    <center>
        <form action="{{ route('admin.users.update',$user) }}" method="POST" enctype="multipart/form-data">
            @method("PUT")
            <h2>Update User</h2>
            <input type="hidden" name="userId" value="{{$user->id}}">
            @include("Dashboard.users._form")
        </form>
    </center>
@endsection
