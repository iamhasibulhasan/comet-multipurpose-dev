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
                                <li class="breadcrumb-item active">Category</li>
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

                        <a data-toggle="modal" href="#add_new_category_modal" class="btn btn-primary btn-sm">Add new category</a>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Categories</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th>#SI</th>
                                            <th>Category Name</th>
                                            <th>Category Slug</th>
                                            <th>Create Time</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach( $all_data as $data )
                                        <tr>
                                            <td>{{ $loop -> index + 1 }}</td>
                                            <td>{{ $data -> name }}</td>
                                            <td>{{ $data -> slug }}</td>
                                            <td>{{ $data -> created_at->diffForHumans() }}</td>
                                            <td>
                                                <div class="status-toggle">
                                                    <input type="checkbox" status_id="{{ $data->id }}" {{ $data->status==true ? 'checked="checked"' : '' }} id="category_status_{{ $loop -> index + 1 }}" class="check cat-check">
                                                    <label for="category_status_{{ $loop -> index + 1 }}" class="checktoggle">checkbox</label>
                                                </div>
                                            </td>
                                            <td>

{{--                                                <a href="#" class="btn btn-sm btn-info"><i class="fa fa-eye" aria-hidden="true"></i></a>--}}
                                                <a href="#" class="btn btn-sm btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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

    <!-- Add new category modal -->

    <div class="modal fade" id="add_new_category_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3>Add new category</h3>
                    <hr>
                    <form action="{{ route('category.store') }}" method="POST">
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

    <!-- /Add new category modal -->





@endsection
