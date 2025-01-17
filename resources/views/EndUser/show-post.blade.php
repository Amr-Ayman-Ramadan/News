@extends("Layouts.EndUser.app")
@section("content")
    <!-- Single News Start-->
    <div class="single-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Carousel -->
                    <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#newsCarousel" data-slide-to="1"></li>
                            <li data-target="#newsCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{$post->image}}" class="d-block w-50" alt="First Slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>{{$post->title}}</h5>
                                    <p>
                                        {!! substr($post->description,50) !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div class="sn-content">
                        {!! $post->description !!}
                    </div>

                    <!-- Comment Section -->
                    <div class="comment-section">
                        <!-- Comment Input -->
                        <form id="commentForm">
                            <div class="comment-input">
                                @csrf
                                    <input type="hidden" name="user_id" value="2">
                                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                    <input type="text" name="comment"  placeholder="Add a comment..." id="commentBox" />
                                    <button type="submit" id="addCommentBtn">Comment</button>
                            </div>
                        </form>
                        <div style="display:none" id="errorMessage" class="alert alert-danger"></div>
                        <!-- Display Comments -->
                        <div class="comments">
                            @foreach($post->comments as $comment)
                                <div class="comment">
                                    <img src="{{$comment->user->image}}" alt="User Image" class="comment-img" />
                                    <div class="comment-content">
                                        <span class="username">{{$comment->user->username}}</span>
                                        <p class="comment-text">{{$comment->comment}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Show More Button -->
                        <button id="showMoreBtn" class="show-more-btn">Show more</button>
                    </div>

                    <!-- Related News -->
                    <div class="sn-related">
                        <h2>Related News</h2>
                        <div class="row sn-slider">
                            @foreach($posts_belongs_to_category as $post)
                                <div class="col-md-4">
                                    <div class="sn-img">
                                        <img src="{{$post->image}}" class="img-fluid" alt="Related News 1" />
                                        <div class="sn-title">
                                            <a href="{{route("endUser.post.show",$post->slug)}}">{{$post->title}}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="sidebar-widget">
                            <h2 class="sw-title">In This Category</h2>
                            <div class="news-list">
                                @foreach($posts_belongs_to_category as $post)
                                    <div class="nl-item">
                                        <div class="nl-img">
                                            <img src="{{$post->image}}" />
                                        </div>
                                        <div class="nl-title">
                                            <a href="{{route("endUser.post.show",$post->slug)}}">{{$post->title}}</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <div class="image">
                                <a href="https://htmlcodex.com"
                                ><img src="img/ads-2.jpg" alt="Image"
                                    /></a>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <div class="tab-news">
                                <ul class="nav nav-pills nav-justified">
                                    <li class="nav-item">
                                        <a
                                            class="nav-link active"
                                            data-toggle="pill"
                                            href="#featured"
                                        >Featured</a
                                        >
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#popular"
                                        >Popular</a
                                        >
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#latest"
                                        >Latest</a
                                        >
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div id="featured" class="container tab-pane active">
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="img/news-350x223-1.jpg" />
                                            </div>
                                            <div class="tn-title">
                                                <a href=""
                                                >Lorem ipsum dolor sit amet consec adipis elit</a
                                                >
                                            </div>
                                        </div>
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="img/news-350x223-2.jpg" />
                                            </div>
                                            <div class="tn-title">
                                                <a href=""
                                                >Lorem ipsum dolor sit amet consec adipis elit</a
                                                >
                                            </div>
                                        </div>
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="img/news-350x223-3.jpg" />
                                            </div>
                                            <div class="tn-title">
                                                <a href=""
                                                >Lorem ipsum dolor sit amet consec adipis elit</a
                                                >
                                            </div>
                                        </div>
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="img/news-350x223-4.jpg" />
                                            </div>
                                            <div class="tn-title">
                                                <a href=""
                                                >Lorem ipsum dolor sit amet consec adipis elit</a
                                                >
                                            </div>
                                        </div>
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="img/news-350x223-5.jpg" />
                                            </div>
                                            <div class="tn-title">
                                                <a href=""
                                                >Lorem ipsum dolor sit amet consec adipis elit</a
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <div id="popular" class="container tab-pane fade">
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="img/news-350x223-4.jpg" />
                                            </div>
                                            <div class="tn-title">
                                                <a href=""
                                                >Lorem ipsum dolor sit amet consec adipis elit</a
                                                >
                                            </div>
                                        </div>
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="img/news-350x223-3.jpg" />
                                            </div>
                                            <div class="tn-title">
                                                <a href=""
                                                >Lorem ipsum dolor sit amet consec adipis elit</a
                                                >
                                            </div>
                                        </div>
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="img/news-350x223-2.jpg" />
                                            </div>
                                            <div class="tn-title">
                                                <a href=""
                                                >Lorem ipsum dolor sit amet consec adipis elit</a
                                                >
                                            </div>
                                        </div>
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="img/news-350x223-1.jpg" />
                                            </div>
                                            <div class="tn-title">
                                                <a href=""
                                                >Lorem ipsum dolor sit amet consec adipis elit</a
                                                >
                                            </div>
                                        </div>
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="img/news-350x223-2.jpg" />
                                            </div>
                                            <div class="tn-title">
                                                <a href=""
                                                >Lorem ipsum dolor sit amet consec adipis elit</a
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <div id="latest" class="container tab-pane fade">
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="img/news-350x223-3.jpg" />
                                            </div>
                                            <div class="tn-title">
                                                <a href=""
                                                >Lorem ipsum dolor sit amet consec adipis elit</a
                                                >
                                            </div>
                                        </div>
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="img/news-350x223-4.jpg" />
                                            </div>
                                            <div class="tn-title">
                                                <a href=""
                                                >Lorem ipsum dolor sit amet consec adipis elit</a
                                                >
                                            </div>
                                        </div>
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="img/news-350x223-5.jpg" />
                                            </div>
                                            <div class="tn-title">
                                                <a href=""
                                                >Lorem ipsum dolor sit amet consec adipis elit</a
                                                >
                                            </div>
                                        </div>
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="img/news-350x223-4.jpg" />
                                            </div>
                                            <div class="tn-title">
                                                <a href=""
                                                >Lorem ipsum dolor sit amet consec adipis elit</a
                                                >
                                            </div>
                                        </div>
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="img/news-350x223-3.jpg" />
                                            </div>
                                            <div class="tn-title">
                                                <a href=""
                                                >Lorem ipsum dolor sit amet consec adipis elit</a
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <h2 class="sw-title">News Category</h2>
                            <div class="category">
                                <ul>
                                    @foreach($categories as $category)
                                        <li><a href="">{{$category->name}}</a><span>{{$category->posts->count()}}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single News End-->
@endsection
@push("js")
<script>
    // Show More Comment
    $(document).on("click","#showMoreBtn",function (e){
        e.preventDefault();
        $.ajax({
            url:"{{route('endUser.post.comments',$post->slug)}}",
            type:'GET',

            success:function (data) {
                $('.comments').empty();
                $.each(data,function (key,comment){
                    $('.comment').append(`<div class="comment">
                                    <img src="${comment.user.image}" alt="User Image" class="comment-img" />
                                    <div class="comment-content">
                                        <span class="username">${comment.user.username}</span>
                                        <p class="comment-text">${comment.comment}</p>
                                    </div>
                                </div>`)
                });
                $('#showMoreBtn').hide()
            },
            error:function (data){

            }
        })
    })

    // Save Comment
    $(document).on("submit", "#commentForm", function (e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: "{{ route('endUser.post.comments.store') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status === 200) {
                    // Prepend the new comment dynamically
                    $('.comments').prepend(`
                    <div class="comment">
                        <img src="${response.data.user.image}" alt="User Image" class="comment-img" />
                        <div class="comment-content">
                            <span class="username">${response.data.user.username}</span>
                            <p class="comment-text">${response.data.comment}</p>
                        </div>
                    </div>
                `);

                    // Reset the form and hide error messages
                    $('#commentForm')[0].reset();
                    $("#errorMessage").hide();
                } else {
                    console.log("Unexpected response:", response);
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) { 
                    var errors = xhr.responseJSON.errors;
                    if (errors.comment) {
                        $("#errorMessage").text(errors.comment[0]).show();
                    }
                } else {
                    console.log("Unexpected error:", xhr);
                }
            },
        });
    });
</script>
@endpush
