@extends("Layouts.Dashboard.app")
@section("title", "Edit Admin Profile")

@section("content")
    <center>
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="card-body shadow mb-4 col-10">
                <h2>Edit Admin Profile</h2>
                <div class="row">
                    <!-- Name -->
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" id="name" class="form-control">
                            @error('name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Username -->
                    <div class="col-6">
                        <div class="form-group">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" value="{{ old('username', auth()->user()->username) }}" id="username" class="form-control">
                            @error('username')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <!-- Email -->
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" id="email" class="form-control">
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="col-6">
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Leave blank to keep current password">
                            @error('password')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary w-100">Update Profile</button>
                    </div>
                </div>
            </div>
        </form>
    </center>
@endsection
