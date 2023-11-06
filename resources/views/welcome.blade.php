@extends('user.layout.app')
@section('content')
    <!-- news-section -->
    <section class="news-section sec-pad">
        <div class="auto-container">
            <div class="sec-title centred">
                <h5>Blogs</h5>

            </div>
            <div class="row clearfix">
                @foreach ($datas as $item)
                    <div class="col-lg-4 col-md-6 col-sm-12 news-block">
                        <div class="news-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><a
                                            href="{{ route('blog-detail', [$item->id, $item->slug]) }}"><img
                                                src="{{ asset($item->image) }}" alt=""></a>
                                    </figure>
                                </div>
                                <div class="lower-content">
                                    <h4><a
                                            href="{{ route('blog-detail', [$item->id, $item->slug]) }}">{{ $item->title }}</a>
                                    </h4>
                                    <ul class="post-info clearfix">
                                        <li class="author-box">
                                            <figure class="author-thumb"><img
                                                    src="{{ !empty($item->user->image) ? url('storage/user/' . $item->user->image) : url('no_image.jpg') }}"
                                                    alt="">
                                            </figure>
                                            <h5><a
                                                    href="{{ route('blog-detail', [$item->id, $item->slug]) }}">{{ $item->user->name }}</a>
                                            </h5>
                                        </li>
                                        {{ $item->created_at->format('M d Y') }}
                                        <li></li>
                                    </ul>
                                    <div class="text">
                                        {!! Str::limit($item->content, 50) !!}
                                    </div>
                                    <div class="btn-box">
                                        <a href="{{ route('blog-detail', [$item->id, $item->slug]) }}"
                                            class="theme-btn btn-two">See Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
            <div style="text-align: center;margin:50px;">
                {{ $datas->links() }}
            </div>
        </div>
    </section>
    <!-- news-section end -->
@endsection
