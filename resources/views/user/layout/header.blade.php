@php
    $data = Auth::user();
@endphp
<!-- main header -->
<header class="main-header">
    <!-- header-top -->

    <!-- header-lower -->
    <div class="header-lower">
        <div class="outer-box">
            <div class="main-box">
                <div class="logo-box">
                    <!-- <figure class="logo"><a href="index.html"><img src="assets/images/logo.png" alt=""></a></figure> -->
                    <a href="{{ route('home') }}">
                        <h2>Blog Project</h2>
                    </a>
                </div>
                <div class="menu-area clearfix">
                    <!--Mobile Navigation Toggler-->

                    <nav class="main-menu navbar-expand-md navbar-light">
                        <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">

                                @auth

                                    <li><a href="{{ route('user-profile') }}"><span>{{ $data->name }}</span></a></li>
                                @else
                                    <li><a href="{{ route('user-register') }}"><span>Register</span></a>
                                    </li>
                                    <li><a href="{{ route('user-login') }}"><span>Login</span></a></li>
                                @endauth
                                <li>
                                    <div class="btn-box">
                                        <a href="{{ route('user-blog') }}" class="theme-btn btn-one"><span>+</span>Add
                                            Blog</a>
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </nav>
                </div>


            </div>
        </div>
    </div>


</header>
<!-- main-header end -->
