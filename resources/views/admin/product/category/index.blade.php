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
                <div class="row">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Add new category</h4>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">Category Information</h4>
                                <form action="{{ route('product-category.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Category Name</label>
                                                <div class="col-lg-9">
                                                    <input name="name" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Category Icon</label>
                                                <div class="col-lg-9">
                                                    <input name="icon" type="text" class="form-control">
                                                </div>
                                            </div><div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Category Image</label>
                                                <div class="col-lg-9">
                                                    <input name="image" type="file" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label">Parent Category</label>
                                                <div class="col-lg-9">
                                                    <select name="parent" class="form-control">
                                                        <option value="">Select</option>
                                                        @foreach($all_data as $data)
                                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7">
                        <div class="card">
                            <div class="card-header">Category Structure</div>
                            <div class="card-body">
                                <ul>
                                    @foreach($parent_category as $cat1)
                                        <li>{{ $cat1->name }}
                                            <!-- Edit delete Button -->
                                            <div class="category-manage">
                                                <a class="edit_cat" edit_id="{{ $cat1->id }}"  href="#">Edit</a>
                                                <a href="{{ route('product-category.destroy', $cat1->id) }}">Delete</a>
                                            </div>
                                            <!-- /Edit delete Button -->
                                            <ul>
                                                @foreach($cat1->getChild as $cat2)
                                                    <li>{{ $cat2->name }}
                                                        <!-- Edit delete Button -->
                                                        <div class="category-manage">
                                                            <a class="edit_cat" edit_id="{{ $cat2->id }}"   href="#">Edit</a>
                                                            <a href="{{ route('product-category.destroy', $cat2->id) }}">Delete</a>
                                                        </div>
                                                        <!-- /Edit delete Button -->
                                                        <ul>
                                                            @foreach($cat2->getChild as $cat3)
                                                                <li>{{ $cat3->name }}
                                                                    <!-- Edit delete Button -->
                                                                    <div class="category-manage">
                                                                        <a class="edit_cat" edit_id="{{ $cat3->id }}"  href="#">Edit</a>
                                                                        <a href="{{ route('product-category.destroy', $cat3->id) }}">Delete</a>
                                                                    </div>
                                                                    <!-- /Edit delete Button -->
                                                                    <ul>
                                                                        @foreach($cat3->getChild as $cat4)
                                                                            <li>{{ $cat4->name }}
                                                                            <!-- Edit delete Button -->
                                                                                <div class="category-manage">
                                                                                    <a class="edit_cat" edit_id="{{ $cat4->id }}" href="#">Edit</a>
                                                                                    <a href="{{ route('product-category.destroy', $cat4->id) }}">Delete</a>
                                                                                </div>
                                                                                <!-- /Edit delete Button -->
                                                                                <ul>
                                                                                    @foreach($cat4->getChild as $cat5)
                                                                                        <li>{{ $cat5->name }}
                                                                                            <!-- Edit delete Button -->
                                                                                            <div class="category-manage">
                                                                                                <a class="edit_cat" edit_id="{{ $cat5->id }}"  href="#">Edit</a>
                                                                                                <a href="{{ route('product-category.destroy', $cat5->id) }}">Delete</a>
                                                                                            </div>
                                                                                            <!-- /Edit delete Button -->
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->
    <!-- Edit product category modal -->

    <div class="modal fade" id="edit_product_category_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3>Edit Category</h3>
                    <hr>
                    <form action="{{ route('product-category.update') }}" id="edit_product_category_form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input name="name" type="text" class="form-control">
                            <input name="edit_id" type="hidden" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Icon</label>
                            <input name="icon" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Parent</label>
                            <select name="parent_cat" class="form-control"></select>
                        </div>
                        <div class="form-group">
                            <img style="width: 150px;" id="product_category_image" alt=""><br><br>
                            <label for="image">Image</label>
                            <input id="image" name="new_image" type="file" class="form-control">
                            <input name="old_image" type="hidden" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-block">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- /Edit product category modal -->

@endsection
