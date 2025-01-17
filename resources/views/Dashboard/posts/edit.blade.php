@extends("Layouts.Dashboard.app")
@section("title", "Edit Post")

@section("content")
    <div class="container">
        <div class="card shadow-sm mt-5">
            <div class="card-header bg-primary text-white text-center">
                <h3>Edit Post</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.posts.update',$post) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method("PUT")
                    @include("Dashboard.posts._form")
                </form>
            </div>
        </div>
    </div>
@endsection

<style>
    /* Custom styling for the CKEditor to set the width */
    .ck-editor__editable {
        width: 100%;
        min-height: 200px;
    }
</style>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    // Initialize CKEditor for textareas with class "ckeditor"
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.ckeditor').forEach((editorElement) => {
            ClassicEditor
                .create(editorElement)
                .catch(error => {
                    console.error(error);
                });
        });
    });
</script>
