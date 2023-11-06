@extends('user.layout.app')
@section('content')
    <!-- ragister-section -->
    <section class="ragister-section centred sec-pad">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-xl-8 col-lg-12 col-md-12 offset-xl-2 big-column">
                    <div class="sec-title">
                        <h5>Register</h5>
                    </div>
                    <div class="tabs-box">

                        <div class="tabs-content">
                            <div class="tab active-tab" id="tab-1">
                                <div class="inner-box">
                                    <form action="{{ route('user-register-post') }}" method="post" class="default-form">
                                        @csrf
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email">
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="password" name="password_confirmation">
                                            @error('password_confirmation')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group message-btn">
                                            <button type="submit" class="theme-btn btn-one">Register</button>
                                        </div>
                                    </form>
                                    <div class="othre-text">
                                        <p>Already have an account? <a href="{{ route('user-login') }}">Login</a></p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ragister-section end -->
@endsection
