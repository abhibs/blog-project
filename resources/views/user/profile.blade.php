@extends('user.layout.app')
@section('content')
    <!-- property-page-section -->
    <section class="property-page-section property-list">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">


                    <div class="blog-sidebar">
                        <div class="sidebar-widget post-widget">
                            <div class="widget-title">
                                <h4>User Blog </h4>
                            </div>
                            @foreach ($blogs as $item)
                                <div class="post-inner">
                                    <div class="post">
                                        <figure class="post-thumb"><a href="blog-details.html">
                                                <img src="{{ asset($item->image) }}" alt=""></a></figure>
                                        <h5><a href="blog-details.html">{{ $item->title }} </a></h5>
                                        {!! Str::limit($item->content, 50) !!}
                                        <p> </p>
                                    </div>

                                </div>
                            @endforeach

                        </div>


                        <div class="sidebar-widget category-widget">
                            <div class="widget-title">
                                <h4>Setting</h4>
                            </div>
                            <div class="widget-content">
                                <ul class="category-list ">

                                    <li> <a href="{{ route('user-profile') }}"><i class="fab fa fa-envelope "></i> Dashboard
                                        </a></li>

                                    <li><a href="{{ route('user-profile-edit') }}"><i class="fa fa-key"
                                                aria-hidden="true"></i> Edit
                                            Profile
                                        </a></li>
                                    <li><a href="{{ route('user-logout') }}"><i class="fa fa-chevron-circle-up"
                                                aria-hidden="true"></i> Logout </a></li>
                                </ul>

                            </div>
                        </div>
                    </div>






                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="property-content-side">

                        <div class="wrapper list">
                            <div class="deals-list-content list-item">



                                <div class="deals-block-one">
                                    <div class="inner-box">
                                        <div class="image-box">
                                            <figure class="image"><img
                                                    src="{{ !empty($data->image) ? url('storage/user/' . $data->image) : url('user/assets/images/resource/deals-3.jpg') }}"
                                                    alt=""></figure>

                                        </div>
                                        <div class="lower-content">
                                            <div class="title-text">
                                                <h4><a href="">{{ $data->name }}</a></h4>
                                            </div>
                                            <div class="price-box clearfix">
                                                <div class="price-info pull-left">
                                                    <h6>{{ $data->email }}</h6>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- property-page-section end -->
@endsection
