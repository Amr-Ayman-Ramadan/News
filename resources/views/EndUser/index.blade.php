@extends("Layouts.EndUser.app")
@section("content")

    <!-- Top News Start -->
    <div class="top-news">
        <div class="container">
            <div class="row">
                <!-- Latest Posts Slider -->
                <div class="col-md-6 tn-left">
                    <div class="row tn-slider">
                        @foreach($latestPosts as $post)
                            <div class="col-md-6">
                                <div class="tn-img">
                                    <img src="{{ asset('storage/' . optional($post->images->first())->path) }}"
                                         alt="{{ $post->title }}"
                                         loading="lazy"
                                         style="width: 100%; height: auto;">

                                    <div class="tn-title">
                                        <a href="{{route("endUser.post.show",$post->slug)}}">{{ $post->title }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Four Posts Section -->
                <div class="col-md-6 tn-right">
                    <div class="row">
                        @php $fourPosts = $posts->getCollection()->take(4); @endphp
                        @foreach($fourPosts as $post)
                            <div class="col-md-6">
                                <div class="tn-img">
                                    <img src="{{ asset('storage/' . optional($post->images->first())->path) }}"
                                         alt="{{ $post->title }}"
                                         loading="lazy"
                                         style="width: 100%; height: auto;">

                                    <div class="tn-title">
                                        <a href="{{route("endUser.post.show",$post->slug)}}">{{ $post->title }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Top News End -->

    <!-- Category News Start -->
    <div class="cat-news">
        <div class="container">
            <div class="row">
                @foreach($categories_with_posts as $category)
                    <div class="col-md-6">
                        <h2>{{ $category->name }}</h2>
                        <div class="row cn-slider">
                            @foreach($category->posts as $post)
                                <div class="col-md-6">
                                    <div class="cn-img">
                                        <img src="{{ asset('storage/' . optional($post->images->first())->path) }}"
                                             alt="{{ $post->title }}"
                                             loading="lazy"
                                             style="width: 100%; height: auto;">

                                        <div class="cn-title">
                                            <a href="{{route("endUser.post.show",$post->slug)}}">{{ $post->title }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Category News End -->

    <!-- Tab News Start -->
    <div class="tab-news">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <!-- Popular and Oldest News Tabs -->
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#popular">Popular News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#oldest">Oldest News</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!-- Popular News -->
                        <div id="popular" class="container tab-pane fade show active">
                            @foreach($popularPosts as $popularPost)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{ asset('storage/' . optional($popularPost->images->first())->path) }}"
                                             alt="{{ $popularPost->title }}"
                                             loading="lazy">
                                    </div>
                                    <div class="tn-title">
                                        <a href="{{route("endUser.post.show",$post->slug)}}">{{ $popularPost->title }} ({{ $popularPost->comments_count }} comments)</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Oldest News -->
                        <div id="oldest" class="container tab-pane fade">
                            @foreach($oldestPosts as $oldestPost)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{ asset('storage/' . optional($oldestPost->images->first())->path)}}"
                                             alt="{{ $oldestPost->title }}"
                                             loading="lazy">
                                    </div>
                                    <div class="tn-title">
                                        <a href="{{route("endUser.post.show",$post->slug)}}">{{ $oldestPost->title }}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Latest and Most Viewed News Tabs -->
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#latest-news">Latest News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#most-viewed">Most Viewed</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <!-- Latest News -->
                        <div id="latest-news" class="container tab-pane fade show active">
                            @foreach($latestPosts as $latestPost)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{ asset('storage/' . optional($latestPost->images->first())->path) }}"
                                             alt="{{ $latestPost->title }}"
                                             loading="lazy">
                                    </div>
                                    <div class="tn-title">
                                        <a href="{{route("endUser.post.show",$post->slug)}}">{{ $latestPost->title }}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Most Viewed -->
                        <div id="most-viewed" class="container tab-pane fade">
                            @foreach($mostViewPosts as $mostViewPost)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{ asset('storage/' . optional($mostViewPost->images->first())->path) }}"
                                             alt="{{ $mostViewPost->title }}"
                                             loading="lazy">
                                    </div>
                                    <div class="tn-title">
                                        <a href="{{route("endUser.post.show",$post->slug)}}">{{ $mostViewPost->title }}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tab News End -->

    <!-- Main News Start -->
    <div class="main-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        @foreach($posts as $post)
                            <div class="col-md-4">
                                <div class="mn-img">
                                    <img src="{{ asset('storage/' . optional($post->images->first())->path) }}"
                                         alt="{{ $post->title }}"
                                         loading="lazy"
                                         style="width: 100%; height: auto;">


                                    <div class="mn-title">
                                        <a href="#">{{ $post->title }}</a>
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
