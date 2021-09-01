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
                                <li class="breadcrumb-item active">Brand</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->

                <!-- Post category Table -->

                <div class="row">
                    <div class="col-lg-12">

                        {{--Error & Success Message Show Here--}}
                        @include('validate')

                        <a data-toggle="modal" href="#add_new_brand_modal" class="btn btn-primary btn-sm">Add new brand</a>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">All Brands</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="product_brand_tbl" class="table table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th>#SI</th>
                                            <th>Brand Name</th>
                                            <th>Brand Slug</th>
                                            <th>Logo</th>
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

                <!-- /Post category Table -->

            </div>
        </div>
        <!-- /Page Wrapper -->


    </div>
    <!-- /Main Wrapper -->

    <!-- Add new product brand modal -->

    <div class="modal fade" id="add_new_brand_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3>Add new brand</h3>
                    <hr>
                    <form id="product_brand_form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input name="name" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Logo</label>
                            <input name="logo" type="file" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- /Add new product brand modal -->

    <!-- Edit product brand modal -->

    <div class="modal fade" id="edit_product_brand_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3>Edit category</h3>
                    <hr>
                    <form id="edit_product_brand_form" form-no="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Name</label>
                            <input name="name" type="text" class="form-control">
                            <input name="edit_id" type="hidden" class="form-control">
                        </div>
                        <div class="form-group">
                            <img style="width: 150px;" id="product_brand_logo" alt=""><br>
                            <label for="new_lo">Logo</label>
                            <input id="new_lo" name="new_logo" type="file" class="form-control">
                            <input name="old_logo" type="hidden" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- /Edit product brand modal -->





@endsection
