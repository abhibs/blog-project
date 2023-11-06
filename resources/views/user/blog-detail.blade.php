@extends('user.layout.app')
@section('content')
    <section class="sidebar-page-container blog-details sec-pad-2">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="blog-details-content">
                        <div class="news-block-one">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img src="{{ asset($blog->image) }}" alt=""></figure>
                                </div>
                                <div class="lower-content">
                                    <h3>{{ $blog->title }}</h3>
                                    <ul class="post-info clearfix">
                                        <li class="author-box">
                                            <figure class="author-thumb"><img
                                                    src="{{ !empty($item->user->image) ? url('storage/user/' . $item->user->image) : url('no_image.jpg') }}"
                                                    alt=""></figure>
                                            <h5><a href="">{{ $blog->user->name }}</a></h5>
                                        </li>
                                        <li>
                                            {{ $blog->created_at->format('M d Y') }}

                                        </li>
                                    </ul>
                                    <div class="text">
                                        {!! $blog->content !!}
                                    </div>

                                </div>
                            </div>
                        </div>
                        @php
                            $comment = App\Models\Comment::where('blog_id', $blog->id)
                                ->where('parent_id', null)
                                ->get();
                        @endphp
                        <div class="comments-area">

                            <div class="comment-box">
                                @foreach ($comment as $comm)
                                    <div class="comment">
                                        <figure class="thumb-box">
                                            <img src="{{ !empty($comm->user->image) ? url('storage/user/' . $comm->user->image) : url('no_image.jpg') }}"
                                                alt="">
                                        </figure>
                                        <div class="comment-inner">
                                            <div class="comment-info clearfix">
                                                <h5>{{ $comm->user->name }}</h5>
                                                <span>{{ $comm->created_at->format('M d Y') }}</span>
                                            </div>
                                            <div class="text">
                                                <p>{{ $comm->subject }}</p>
                                                <p>{{ $comm->message }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                        $reply = App\Models\Comment::where('parent_id', $comm->id)->get();
                                        $admin = App\Models\Admin::first();

                                    @endphp
                                    @foreach ($reply as $rep)
                                        <div class="comment replay-comment">
                                            <figure class="thumb-box">
                                                <img src="{{ !empty($admin->image) ? url('storage/admin/' . $admin->image) : url('no_image.jpg') }}"
                                                    alt="">
                                            </figure>
                                            <div class="comment-inner">
                                                <div class="comment-info clearfix">
                                                    <h5>{{ $admin->name }}</h5>
                                                    <span>{{ $rep->created_at->format('M d Y') }}</span>
                                                </div>
                                                <div class="text">
                                                    <p>{{ $rep->subject }}</p>
                                                    <p>{{ $rep->message }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach

                            </div>
                        </div>
                        <div class="comments-form-area">

                            @auth
                                <form action="{{ route('user-comment-store') }}" method="post"
                                    class="comment-form default-form">
                                    @csrf
                                    <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                    <div class="row">

                                        <div class="col-lg-12 col-md-6 col-sm-12 form-group">
                                            <input type="text" name="subject" placeholder="Subject">
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                            <textarea name="message" placeholder="Your message"></textarea>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                            <button type="submit" class="theme-btn btn-one">Submit Now</button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <p><b>For Add Comment You need to login first <a href="{{ route('user-login') }}"> Login Here
                                        </a>
                                    </b></p>
                            @endauth

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="blog-sidebar">
                        <div class="sidebar-widget search-widget">
                            <div class="widget-title">
                                <h4>Search</h4>
                            </div>
                            <div class="search-inner">
                                <form action="{{ route('user-blog-search') }}" method="get">
                                    <div class="form-group">
                                        <input type="text" name="search" placeholder="Search">
                                        <button type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="sidebar-widget post-widget">
                            <div class="widget-title">
                                <h4>Recent Posts</h4>
                            </div>
                            <div class="post-inner">
                                @foreach ($newblogposts as $item)
                                    <div class="post">
                                        <figure class="post-thumb"><a
                                                href="{{ route('blog-detail', [$item->id, $item->slug]) }}"><img
                                                    src="{{ asset($item->image) }}" alt=""></a></figure>
                                        <h5><a
                                                href="{{ route('blog-detail', [$item->id, $item->slug]) }}">{{ $item->title }}</a>
                                        </h5>
                                        {{ $item->created_at->format('M d Y') }}
                                        <span class="post-date"></span>
                                    </div>
                                @endforeach


                            </div>
                        </div>

                        <div class="sidebar-widget tags-widget">
                            <div class="widget-title">
                                <h4>Popular Tags</h4>
                            </div>
                            <div class="widget-content">
                                <ul class="tags-list clearfix">
                                    @foreach ($tags_all as $tag)
                                        <li><a href="">{{ ucwords($tag) }}</a></li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- sidebar-page-container -->
@endsection
