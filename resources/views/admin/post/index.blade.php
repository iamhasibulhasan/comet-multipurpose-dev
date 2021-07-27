@extends('admin.layouts.app')

@section('main-content')



    <!-- Main Wrapper -->
    <div class="main-wrapper">

    @include('admin.layouts.header')

    @include('admin.layouts.menu')

    <!-- Page Wrapper -->
        <div class="page-wrapper">

            <div class="content container-fluid">

                <!-- Page Header -->
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Welcome {{ Auth::user()->name }}!</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active">Tag</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <!-- Post Table -->

                <div class="row">
                    <div class="col-lg-12">

                        {{--Error & Success Message Show Here--}}
                        @include('validate')

                        <a href="{{ route('post.create') }}" class="btn btn-primary btn-sm">Add new post</a>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Posts [ Published ]</h4>
                                <a class="badge badge-primary" href="{{ route('post.index') }}">Published {{ ($published == 0 ? '' : '('.$published.')') }}</a>
                                <a class="badge badge-danger" href="{{ route('post.trash') }}">Trash {{ ($trash == 0 ? '' : '('.$trash.')') }}</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th>#SI</th>
                                            <th>Post Title</th>
                                            <th>Post Type</th>
                                            <th>Post Category</th>
                                            <th>Post Tag</th>
                                            <th>Create Time</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach( $all_data as $data )
                                            @php
                                                $featured_data = json_decode($data->featured);
                                            @endphp
                                            <tr>
                                                <td>{{ $loop -> index + 1 }}</td>
                                                <td>{{ $data -> title }}</td>
                                                <td>{{ $featured_data -> post_type }}</td>
                                                <td>{{ $featured_data -> post_type }}</td>
                                                <td>{{ $featured_data -> post_type }}</td>
                                                <td>{{ $data -> created_at->diffForHumans() }}</td>
                                                <td>
                                                    <div class="status-toggle">
                                                        <input type="checkbox" status_id="{{ $data->id }}" {{ $data->status==true ? 'checked="checked"' : '' }} id="post_status_{{ $loop -> index + 1 }}" class="check post-check">
                                                        <label for="post_status_{{ $loop -> index + 1 }}" class="checktoggle">checkbox</label>
                                                    </div>
                                                </td>
                                                <td>

                                                    <a href="#" class="btn btn-sm btn-warning edit-tag-btn" edit_id="{{ $data->id }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                    <a href="{{ route('post.trash.update', $data->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /Post Table -->

            </div>
        </div>
        <!-- /Page Wrapper -->


    </div>
    <!-- /Main Wrapper -->

    <!-- Add new tag modal -->

    <div class="modal fade" id="add_new_tag_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3>Add new category</h3>
                    <hr>
                    <form action="{{ route('tag.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input name="name" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- /Add new tag modal -->

    <!-- Edit tag modal -->

    <div class="modal fade" id="edit_tag_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3>Edit tag</h3>
                    <hr>
                    <form action="{{ route('tag.update', 1) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Name</label>
                            <input name="name" type="text" class="form-control">
                            <input name="edit_id" type="hidden" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- /Edit tag modal -->





@endsection
