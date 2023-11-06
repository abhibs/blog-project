@extends('admin.layout.app')
@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">

                                <li class="breadcrumb-item active">Reply Comment </li>
                            </ol>
                        </div>
                        <h4 class="page-title">Reply Comment </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- Form row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form id="myForm" method="post" action="{{ route('reply-message-post') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $comment->id }}">
                                <input type="hidden" name="user_id" value="{{ $comment->user_id }}">
                                <input type="hidden" name="blog_id" value="{{ $comment->blog_id }}">
                                <div class="row">
                                    <div class="form-group col-md-12 mb-3">
                                        <label for="inputEmail4" class="form-label">Subject </label>
                                        <input type="text" class="form-control" id="inputEmail4"
                                            value="{{ $comment->subject }}" readonly>
                                    </div>



                                    <div class="col-12 mb-3">
                                        <label for="inputEmail4" class="form-label"> Message </label>
                                        <textarea class="form-control" readonly rows="10">{{ $comment->message }}</textarea>
                                    </div>

                                    <div class="form-group col-md-12 mb-3">
                                        <label for="inputEmail4" class="form-label">User Name </label>
                                        <input type="text" class="form-control" id="inputEmail4"
                                            value="{{ $comment->user->name }}" readonly>

                                    </div>
                                    <div class="form-group col-md-12 mb-3">
                                        <label for="inputEmail4" class="form-label">User Email </label>
                                        <input type="text" class="form-control" id="inputEmail4"
                                            value="{{ $comment->user->email }}" readonly>

                                    </div>

                                    <div class="form-group col-md-12 mb-3">
                                        <label for="example-fileinput" class="form-label"> User Image </label>
                                        <br>
                                        <img src="{{ !empty($comment->user->image) ? url('storage/user/' . $comment->user->image) : url('no_image.jpg') }}"
                                            class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                    </div>


                                    <div class="form-group col-md-12 mb-3">
                                        <label for="inputEmail4" class="form-label">Blog Title </label>
                                        <input type="text" class="form-control" id="inputEmail4"
                                            value="{{ $comment->blog->title }}" readonly>
                                    </div>

                                    <div class="form-group col-md-12 mb-3">
                                        <label for="example-fileinput" class="form-label"> Blog Image </label>
                                        <br>
                                        <img src="{{ asset($comment->blog->image) }}"
                                            class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                    </div>

                                    <div class="form-group col-md-12 mb-3">
                                        <label for="inputEmail4" class="form-label">Blog Title </label>
                                        <input type="text" class="form-control" id="inputEmail4"
                                            value="{{ $comment->blog->title }}" readonly>
                                    </div>

                                    <div class="form-group col-md-12 mb-3">
                                        <label for="inputEmail4" class="form-label">Subject </label>
                                        <input type="text" name="subject" class="form-control" id="inputEmail4"
                                            placeholder="Enter Replay Subject">
                                    </div>



                                    <div class="col-12 mb-3">
                                        <label for="inputEmail4" class="form-label"> Message </label>
                                        <textarea class="form-control" name="message" rows="10" placeholder="Enter Replay Message"></textarea>
                                    </div>




                                </div>

                                <button type="submit" class="btn btn-primary waves-effect waves-light">Replay
                                    Comment</button>

                            </form>

                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div>
            <!-- end row -->



        </div> <!-- container -->

    </div> <!-- content -->
@endsection
