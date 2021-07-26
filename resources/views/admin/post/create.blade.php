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
                                <li class="breadcrumb-item active">Post</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->


                <!-- Add New Post -->

                <div class="row">
                    <div class="col-lg-12 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <h4 class="card-title">Add New Post</h4>
                            </div>
                            <div class="card-body">
                                <form action="#">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Post Format</label>
                                        <div class="col-lg-9">
                                            <select class="form-control" name="" id="post_format">
                                                <option value="">-Select-</option>
                                                <option value="Image">Image</option>
                                                <option value="Gallery">Gallery</option>
                                                <option value="Video">Video</option>
                                                <option value="Audio">Audio</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Post Title</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Category</label>
                                        <div class="col-md-9">

                                            @foreach( $all_category as $category )
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value="{{ $category->id }}" name="category[]"> {{ $category->name }}
                                                    </label>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>


                                    <div class="post-image">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Post image</label>
                                            <div class="col-lg-9">
                                                <img style="" alt="" class="post-featured-preview"><br>
                                                <label for="post_featured_img">
                                                    <img class="" style="width: 80px; cursor: pointer;" src="{{ URL::to('admin/assets/img/img.png') }}" alt="">
                                                </label>
                                                <input style="display: none;" type="file" id="post_featured_img">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-gallery">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Post gallery</label>
                                            <div class="col-lg-9">
                                                <img style="" alt="" class="post-featured-preview-gallery_1">
                                                <img style="" alt="" class="post-featured-preview-gallery_2">
                                                <img style="" alt="" class="post-featured-preview-gallery_3">
                                                <img style="" alt="" class="post-featured-preview-gallery_4">

                                                <br>
                                                <label for="post_featured_img_gallery">
                                                    <img class="" style="width: 80px; cursor: pointer;" src="{{ URL::to('admin/assets/img/img.png') }}" alt="">
                                                </label>
                                                <input style="display: none;" type="file" id="post_featured_img_gallery" multiple>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-video">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Post Video Link</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div><div class="post-audio">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Post Audio Link</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Tag</label>
                                        <div class="col-lg-9">
                                            <select style="width: 100%;" name="" class="post_tag_select" id="" multiple="multiple">
                                                @foreach( $all_tag as $tag )
                                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Content</label>
                                        <div class="col-lg-9">
                                            <textarea name="" id="post_content" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- /Add New Post -->



            </div>
        </div>
        <!-- /Page Wrapper -->


    </div>
    <!-- /Main Wrapper -->

@endsection
