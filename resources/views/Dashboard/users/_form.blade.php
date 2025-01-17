@csrf
<div class="card-body shadow mb-4 col-10">
    <div class="row">
        <!-- Name -->
        <div class="col-6">
            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" value="{{old("name",isset($user) ? $user->name : "")}}" id="name" class="form-control" >
                @error('name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Username -->
        <div class="col-6">
            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" value="{{old("username",isset($user) ? $user->username : "")}}" id="username" class="form-control" >
                @error('username')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <!-- Phone -->
        <div class="col-6">
            <div class="form-group">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone"  value="{{old("phone",isset($user)? $user->phone : "")}}" id="phone" class="form-control" >
                @error('phone')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Email -->
        <div class="col-6">
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" value="{{old("email",isset($user)?$user->email : "")}}" id="email" class="form-control" >
                @error('email')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <!-- Password -->
        <div class="col-6">
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password"  id="password" class="form-control" >
                @error('password')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Status -->
        <div class="col-6">
            <div class="form-group">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-control" >
                    <option value="" selected disabled>Select Status</option>
                    <option value="active" @selected(old("status",isset($user) ? $user->status : "") == "active")>Active</option>
                    <option value="inactive" @selected(old("status",isset($user) ? $user->status:"") == "inactive")>Inactive</option>
                </select>
                @error('status')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <!-- Image -->
        <div class="col-6">
            <div class="form-group">
                <label for="image" class="form-label">Profile Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @error('image')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Country -->
        <div class="col-6">
            <div class="form-group">
                <label for="country" class="form-label">Country</label>
                <input type="text" name="country" value="{{old("country",isset($user) ? $user->country : "")}}" id="country" class="form-control">
                @error('country')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <!-- City -->
        <div class="col-6">
            <div class="form-group">
                <label for="city" class="form-label">City</label>
                <input type="text" name="city" value="{{old("city",isset($user) ? $user->city : "")}}" id="city" class="form-control">
                @error('city')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Street -->
        <div class="col-6">
            <div class="form-group">
                <label for="street" class="form-label">Street</label>
                <input type="text" name="street" value="{{old("street",isset($user) ? $user->street : "")}}"  id="street" class="form-control">
                @error('street')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </div>
    </div>
</div>
