@extends('Layouts.Dashboard.app')

@section('title', 'View Post')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h3>Post Details</h3>
            </div>
            <div class="card-body">
                <!-- Post Title -->
                <div class="mb-4">
                    <h4 class="text-primary">Title:</h4>
                    <p>{{ $post->title }}</p>
                </div>

                <!-- Post Image -->
                @if($post->image)
                    <div class="mb-4 text-center">
                        <h4 class="text-primary">Image:</h4>
                        <img src="{{ $post->image }}" alt="Post Image" class="img-fluid rounded shadow-sm" style="max-height: 300px;">
                    </div>
                @endif

                <!-- Post Description -->
                <div class="mb-4">
                    <h4 class="text-primary">Description:</h4>
                    <p>{!! strip_tags($post->description) !!}</p>
                </div>

                <!-- Post Author -->
                <div class="mb-4">
                    <h4 class="text-primary">Author:</h4>
                    <p>{{ $post->user->name ?? 'N/A' }}</p>
                </div>

                <!-- Post Category -->
                <div class="mb-4">
                    <h4 class="text-primary">Category:</h4>
                    <p>{{ $post->category->name ?? 'Uncategorized' }}</p>
                </div>

                <!-- Post Status -->
                <div class="mb-4">
                    <h4 class="text-primary">Status:</h4>
                    <p class="{{ $post->status === 'active' ? 'text-success' : 'text-danger' }}">
                        {{ ucfirst($post->status) }}
                    </p>
                </div>

                <!-- Comments Allowed -->
                <div class="mb-4">
                    <h4 class="text-primary">Comments Allowed:</h4>
                    <p>{{ $post->comment_able ? 'Yes' : 'No' }}</p>
                </div>

                <!-- Post Created At -->
                <div class="mb-4">
                    <h4 class="text-primary">Created At:</h4>
                    <p>{{ $post->created_at->format('d M, Y h:i A') }}</p>
                </div>

                <!-- Back Button -->
                <div class="text-center">
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Back to Posts</a>
                </div>
            </div>
        </div>
    </div>
@endsection
