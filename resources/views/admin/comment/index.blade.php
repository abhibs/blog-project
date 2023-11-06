@extends('admin.layout.app')
@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Reply Comment </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">


                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>User Name</th>
                                        <th>User Image</th>
                                        <th>Blog Title</th>
                                        <th>Blog Image</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($datas as $key => $item)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td>{{ $item->user->name }}</td>
                                            <td><img src="{{ !empty($item->user->image) ? url('storage/user/' . $item->user->image) : url('no_image.jpg') }}"
                                                    alt="" style="width: 100px; height:100px;">
                                            </td>
                                            <td> {{ $item->blog->title }} </td>
                                            <td><img src="{{ asset($item->blog->image) }}" alt=""
                                                    style="width: 100px; height:100px;"></td>
                                            <td> {{ Str::limit($item->subject, 15) }} </td>
                                            <td> {{ Str::limit($item->message, 15) }} </td>

                                            <td>

                                                <a href="{{ route('admin-user-comment-replay', $item->id) }}"
                                                    class="btn btn-primary rounded-pill waves-effect waves-light">Replay</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->



        </div> <!-- container -->

    </div> <!-- content -->
@endsection
