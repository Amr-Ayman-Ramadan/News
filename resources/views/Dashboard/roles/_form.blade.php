<!-- Name -->
<div class="form-group">
    <label for="name">Role Name <span class="text-danger">*</span></label>
    <input type="text" id="name" name="name"
           class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', isset($role) ? $role->name : '') }}">
    @error('name')
    <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<!-- Permissions -->
<div class="form-group">
    <label for="permissions">Permissions <span class="text-danger">*</span></label>
    <div class="row">
        @foreach(config('permissions.permissions') as $key => $value)
            <div class="col-md-4">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                           id="permission_{{ $key }}"
                           name="permissions[]"
                           value="{{ $key }}"
                        {{
                            (is_array(old('permissions')) && in_array($key, old('permissions'))) ||
                            (isset($role) && is_array($role->permissions) && in_array($key, $role->permissions))
                            ? 'checked' : ''
                        }}>
                    <label class="form-check-label" for="permission_{{ $key }}">
                        {{ $value }}
                    </label>
                </div>
            </div>
        @endforeach
    </div>
    @error('permissions')
    <span class="text-danger d-block">{{ $message }}</span>
    @enderror
</div>

<!-- Submit Button -->
<div class="form-group text-right">
    <button type="submit" class="btn btn-primary">
        <i class="fa fa-save"></i> Save Role
    </button>
</div>
