<form action="{{route("admin.categories.update",$category)}}" method="POST">
    @csrf @method("PUT")
    <div class="modal-body">
        <div class="form-group">
            <label for="category-name">Category Name</label>
            <input
                type="text"
                name="name"
                value="{{old("name",$category->name)}}"
                id="category-name"
                class="form-control"
                placeholder="Enter category name"
            >
            @error("name")
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="category-status">Status</label>
            <select name="status" id="category-status" class="form-control">
                <option value="" disabled selected>Select Status</option>
                <option value="active" @selected(old('status', $category->status) == "active")>Active</option>
                <option value="inactive" @selected(old('status', $category->status) == "inactive")>Not Active</option>
            </select>
            @error("status")
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update Category</button>
    </div>
</form>
