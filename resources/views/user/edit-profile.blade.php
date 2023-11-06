@extends('user.layout.app')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
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
                    <div class="blog-details-content">
                        <div class="news-block-one">
                            <div class="inner-box">

                                <div class="lower-content">




                                    <form action="{{ route('user-profile-update') }}" method="post" class="default-form"
                                        enctype="multipart/form-data">
                                        @csrf



                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" value="{{ $data->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" value="{{ $data->email }}">
                                        </div>



                                        <div class="form-group">
                                            <label for="formFile" class="form-label">Image</label>
                                            <input class="form-control" name="image" type="file" id="image">
                                        </div>

                                        <div class="form-group">
                                            <label for="formFile" class="form-label"> </label>
                                            <img id="showImage"
                                                src="{{ !empty($data->image) ? url('storage/user/' . $data->image) : url('no_image.jpg') }}"
                                                alt="" style="width: 100px; height: 100px;"></a>
                                        </div>


                                        <div class="form-group message-btn">
                                            <button type="submit" class="theme-btn btn-one">Save Changes </button>
                                        </div>
                                    </form>



                                </div>
                            </div>
                        </div>


                    </div>


                </div>

            </div>
        </div>
    </section>
    <!-- property-page-section end -->

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
