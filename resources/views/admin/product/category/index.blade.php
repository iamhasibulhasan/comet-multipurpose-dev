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
                                                <a href="#">Edit</a>
                                                <a href="{{ route('product-category.destroy', $cat1->id) }}">Delete</a>
                                            </div>
                                            <!-- /Edit delete Button -->
                                            <ul>
                                                @foreach($cat1->getChild as $cat2)
                                                    <li>{{ $cat2->name }}
                                                        <!-- Edit delete Button -->
                                                        <div class="category-manage">
                                                            <a href="#">Edit</a>
                                                            <a href="{{ route('product-category.destroy', $cat2->id) }}">Delete</a>
                                                        </div>
                                                        <!-- /Edit delete Button -->
                                                        <ul>
                                                            @foreach($cat2->getChild as $cat3)
                                                                <li>{{ $cat3->name }}
                                                                    <!-- Edit delete Button -->
                                                                    <div class="category-manage">
                                                                        <a href="#">Edit</a>
                                                                        <a href="{{ route('product-category.destroy', $cat3->id) }}">Delete</a>
                                                                    </div>
                                                                    <!-- /Edit delete Button -->
                                                                    <ul>
                                                                        @foreach($cat3->getChild as $cat4)
                                                                            <li>{{ $cat4->name }}
                                                                            <!-- Edit delete Button -->
                                                                                <div class="category-manage">
                                                                                    <a href="#">Edit</a>
                                                                                    <a href="{{ route('product-category.destroy', $cat4->id) }}">Delete</a>
                                                                                </div>
                                                                                <!-- /Edit delete Button -->
                                                                                <ul>
                                                                                    @foreach($cat4->getChild as $cat5)
                                                                                        <li>{{ $cat5->name }}
                                                                                            <!-- Edit delete Button -->
                                                                                            <div class="category-manage">
                                                                                                <a href="#">Edit</a>
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

@endsection
