<!-- Title -->
        <div class="form-group mb-4">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title"
                   class="form-control @error('title') is-invalid @enderror"
                   value="{{ old('title', isset($post) ? $post->title : '') }}" placeholder="Enter post title">
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Description -->
        <div class="form-group mb-4">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description"
                      class="form-control ckeditor @error('description') is-invalid @enderror"
                      rows="8" placeholder="Enter post description">{{ old('description', isset($post) ? $post->description : '') }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Allow Comments -->
        <div class="form-group mb-4">
            <label for="comment_able" class="form-label">Allow Comments</label>
            <select name="comment_able" id="comment_able"
                    class="form-control @error('comment_able') is-invalid @enderror">
                <option value="1" @selected(old("comment_able", isset($post) ? $post->comment_able : "") == "1")>Yes</option>
                <option value="0" @selected(old("comment_able", isset($post) ? $post->comment_able : "") == "0")>No</option>
            </select>
            @error('comment_able')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Status -->
        <div class="form-group mb-4">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status"
                    class="form-control @error('status') is-invalid @enderror">
                <option value="active" {{ old('status', isset($post) ? $post->status : 'active') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', isset($post) ? $post->status : '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Category -->
        <div class="form-group mb-4">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id"
                    class="form-control @error('category_id') is-invalid @enderror">
                <option value="" disabled selected>Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', isset($post) ? $post->category_id : '') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Author -->
        <div class="form-group mb-4">
            <label for="user_id" class="form-label">Author</label>
            <select name="user_id" id="user_id"
                    class="form-control @error('user_id') is-invalid @enderror">
                <option value="" disabled selected>Select an author</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', isset($post) ? $post->user_id : '') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            @error('user_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Image Upload -->
        <div class="form-group mb-4">
            <label for="image">Post Image</label>
            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
            @if(isset($post) && $post->image)
                <div class="mt-2">
                    <img src="{{ asset($post->image) }}" alt="Current Image" class="img-fluid" width="100">
                </div>
            @endif
            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="form-group text-center">
            <button type="submit" class="btn btn-success">{{ isset($post) ? 'Update Post' : 'Create Post' }}</button>
        </div>

