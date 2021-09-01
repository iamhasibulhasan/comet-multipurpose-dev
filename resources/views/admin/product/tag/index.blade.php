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

                <!-- Product tag Table -->

                <div class="row">
                    <div class="col-lg-12">

                        {{--Error & Success Message Show Here--}}
                        @include('validate')

                        <a data-toggle="modal" href="#add_new_tag_modal" class="btn btn-primary btn-sm">Add new tag</a>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Tags</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="product_tag_tbl" class="table table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th>#SI</th>
                                            <th>Tag Name</th>
                                            <th>Tag Slug</th>
                                            <th>Create Time</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /Product tag Table -->

            </div>
        </div>
        <!-- /Page Wrapper -->


    </div>
    <!-- /Main Wrapper -->

    <!-- Add new product tag modal -->

    <div class="modal fade" id="add_new_tag_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3>Add new tag</h3>
                    <hr>
                    <form id="product_tag_form" method="POST" enctype="multipart/form-data">
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

    <!-- /Add new product tag modal -->

    <!-- Edit product tag modal -->

    <div class="modal fade" id="edit_product_tag_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3>Edit tag</h3>
                    <hr>
                    <form id="edit_product_tag_form" tag-no="" method="POST">
                        @csrf
                        @method('PUT')
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

    <!-- /Edit product tag modal -->





@endsection
