<!-- Name -->
<div class="form-group">
    <label for="name">Name <span class="text-danger">*</span></label>
    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', isset($admin) ? $admin->name : '') }}" >
    @error('name')
    <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<!-- Username -->
<div class="form-group">
    <label for="username">Username <span class="text-danger">*</span></label>
    <input type="text" id="username" name="username"  class="form-control @error('username') is-invalid @enderror" value="{{ old('username', isset($admin) ? $admin->username : '') }}" >
    @error('username')
    <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<!-- Email -->
<div class="form-group">
    <label for="email">Email <span class="text-danger">*</span></label>
    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', isset($admin) ? $admin->email : '') }}" >
    @error('email')
    <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<!-- Status -->
<div class="form-group mb-4">
    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
        <option value="active" {{ old('status', isset($admin) ? $admin->status : '') == 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ old('status', isset($admin) ? $admin->status : '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
    </select>
    @error('status')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Role -->
<div class="form-group mb-4">
    <label for="role_id" class="form-label">Role <span class="text-danger">*</span></label>
    <select name="role_id" id="role_id" class="form-control @error('role_id') is-invalid @enderror">
        <option value="">Select Role</option>
        @foreach($roles as $role)
            <option value="{{ $role->id }}" {{ old('role_id', isset($admin) ? $admin->role_id : '') == $role->id ? 'selected' : '' }}>
                {{ $role->name }}
            </option>
        @endforeach
    </select>
    @error('role_id')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Password -->
<div class="form-group">
    <label for="password">Password <span class="text-danger">*</span></label>
    <input type="password" id="password" name="password" value="{{old("password")}}" class="form-control @error('password') is-invalid @enderror" >
    @error('password')
    <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<!-- Confirm Password -->
<div class="form-group">
    <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
    <input type="password" id="password_confirmation" name="password_confirmation" value="{{old("password_confirmation")}}" class="form-control @error('password_confirmation') is-invalid @enderror" >
    @error('password_confirmation')
    <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<!-- Submit Button -->
<div class="form-group text-right">
    <button type="submit" class="btn btn-primary">
        <i class="fa fa-save"></i> Save Admin
    </button>
</div>
