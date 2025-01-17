@extends("Layouts.EndUser.app")
@section("content")
<!-- Main News Start-->
<div class="main-news">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-md-4">
                            <div class="mn-img">
                                <img src="{{$post->image}}" />
                                <div class="mn-title">
                                    <a href="{{route("endUser.post.show",$post->slug)}}" title="{{$post->title}}">{{$post->title}}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{$posts->links()}}
            </div>

            <div class="col-lg-3">
                <div class="mn-list">
                    <h2>Other Categories</h2>
                    <ul>
                        @foreach($categories as $category)
                            <li><a href="{{route("endUser.category.posts",$category->slug)}}">{{$category->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main News End-->
@endsection
