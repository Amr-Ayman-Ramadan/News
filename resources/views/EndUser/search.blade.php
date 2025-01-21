@extends("Layouts.EndUser.app")
@section("content")
    <!-- Main News Start -->
    <div class="main-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        @foreach($posts as $post)
                            <div class="col-md-4">
                                <div class="mn-img">
                                    <img src="{{ $post->image }}"
                                         alt="{{ $post->title }}"
                                         loading="lazy">
                                    <div class="mn-title">
                                        <a href="{{route("endUser.post.show",$post->slug)}}">{{ $post->title }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $posts->links() }}
                    </div>
                </div>
                <div class="col-lg-3">
                    <!-- Read More Section -->
                    <div class="mn-list">
                        <h2>Read More</h2>
                        <ul>
                            @foreach($posts->take(10) as $post)
                                <li><a href="#">{{ $post->title }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main News End -->
@endsection
