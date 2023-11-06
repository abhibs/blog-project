@extends('user.layout.app')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css">
    <style type="text/css">
        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: #b70000;
            font-weight: 700px;
        }
    </style>
    <div class="container mt-5">
        <div class="row">
            <div class="col-3">
                <button data-toggle="modal" data-target="#addBlog" class="theme-btn btn-one">Add
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-5">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Sl No</th>
                            <th scope="col">User Name</th>
                            <th scope="col">User Email</th>
                            <th scope="col">User Photo</th>
                            <th scope="col">Blog Title</th>
                            <th scope="col">Blog Image</th>
                            <th scope="col">Blog Content</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $key => $item)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->user->email }}</td>
                                <td><img src="{{ !empty($item->user->image) ? url('storage/user/' . $item->user->image) : url('no_image.jpg') }}"
                                        style="width:50px; height:50px;" alt="">
                                </td>
                                <td>{{ $item->title }}</td>
                                <td><img src="{{ asset($item->image) }}" style="width:50px; height:50px;" alt="">
                                </td>
                                <td>{{ Str::limit($item->content, 20) }}</td>
                                <td>
                                    <button data-toggle="modal" data-target="#editBlog" class="theme-btn btn-one"
                                        id="{{ $item->id }}" onclick="blogEdit(this.id)">Edit
                                    </button>
                                    <a href="{{ route('user-blog-delete', $item->id) }}" class="theme-btn btn-one">Delete
                                    </a>
                                </td>

                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addBlog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Blog</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user-blog-post') }}" method="post" class="default-form"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Title</label>
                            <input type="text" class="form-control" id="recipient-name" name="title">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Image</label>
                            <input type="file" class="form-control" id="recipient-name" name="image">
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Tags</label>
                            <br>
                            <input type="text" value="HTML, CSS" class="form-control" id="recipient-name"
                                data-role="tagsinput" name="tags">

                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Content</label>
                            <textarea class="ckeditor form-control" id="message-text" name="content"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="editBlog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Blog</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user-blog-update') }}" method="post" class="default-form"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="blog_id" id="blog_id">

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="blog_title">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Tags</label>
                            <br>
                            <input type="text" value="HTML, CSS" class="form-control" data-role="tagsinput"
                                name="tags" id="blog_tags">

                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Content</label>
                            <textarea class="ckeditor form-control" id="message-text" name="content" id="blog_content"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script type="text/javascript">
        function blogEdit(id) {
            $.ajax({
                type: 'GET',
                url: '/blog/edit/' + id,
                dataType: 'json',

                success: function(data) {
                    console.log(data.title)
                    $('#blog_title').val(data.title);
                    $('#blog_content').val(data.content);
                    $('#blog_tags').val(data.tags);
                    $('#blog_id').val(data.id);
                }
            })
        }
    </script>
@endsection
