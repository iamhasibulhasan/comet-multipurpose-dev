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
                                <li class="breadcrumb-item active">Edit Post</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Page Header -->


                <!-- Edit Post -->
                @php
                    // Categories selected checkbox[relation]
                    $cat_slug_array = [];
                    foreach ($edit_data ->categories as $cat){
                        array_push($cat_slug_array, $cat->slug);
                    }
                    // Tags selected checkbox[relation]
                    $tag_slug_array = [];
                    foreach ($edit_data ->tags as $tag){
                        array_push($tag_slug_array, $tag->slug);
                    }
                    // Post type
                    $post_format = json_decode($edit_data->featured);

                @endphp
                <div class="row">
                    @include('validate')
                    <div class="col-lg-12 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <h4 class="card-title">Edit Post</h4>
                            </div>
                            <div class="card-body">
                                <form method="PUT"  action="{{ route('post.update', $edit_data->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">

                                        <label class="col-lg-3 col-form-label">Post Format</label>
                                        <div class="col-lg-9">
                                            <select class="form-control" name="post_type" id="post_format">
                                                <option @if($post_format ->post_type == '') selected   @endif value="">-Select-</option>
                                                <option @if($post_format ->post_type == 'Image') selected   @endif  value="Image">Image</option>
                                                <option @if($post_format ->post_type == 'Gallery') selected   @endif  value="Gallery">Gallery</option>
                                                <option @if($post_format ->post_type == 'Video') selected   @endif  value="Video">Video</option>
                                                <option @if($post_format ->post_type == 'Audio') selected   @endif  value="Audio">Audio</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Post Title</label>
                                        <div class="col-lg-9">
                                            <input type="text" value="{{ $edit_data->title }}" name="post_title" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-3">Category</label>
                                        <div class="col-md-9">


                                            @foreach( $all_category as $category )
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" value="{{ $category->id }}" @if(in_array($category->slug, $cat_slug_array)) checked   @endif name="post_category[]"> {{ $category->name }}
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
                                                <input style="display: none;" name="post_image" type="file" id="post_featured_img">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-gallery">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Post gallery</label>
                                            <div class="col-lg-9">
                                                <div class="post-gallery-img"></div>
                                                <br>
                                                <label for="post_featured_img_gallery">
                                                    <img class="shadow" style="width: 80px; cursor: pointer;" src="{{ URL::to('admin/assets/img/img.png') }}" alt="">
                                                </label>
                                                <input style="display: none;" name="post_gallery[]" type="file" id="post_featured_img_gallery" multiple>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-video">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Post Video Link</label>
                                            <div class="col-lg-9">
                                                <input type="text" name="post_video" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="post-audio">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Post Audio Link</label>
                                            <div class="col-lg-9">
                                                <input type="text" name="post_audio" class="form-control">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Tag</label>
                                        <div class="col-lg-9">
                                            <select style="width: 100%;" name="tags[]" class="post_tag_select" id="" multiple="multiple">
                                                @foreach( $all_tag as $tag )
                                                    <option value="{{ $tag->id }}" @if(in_array($tag->slug, $tag_slug_array)) selected   @endif >{{ $tag->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label">Content</label>
                                        <div class="col-lg-9">
                                            <textarea name="post_content" id="post_content_editor" cols="30" rows="10">{{ $edit_data->content }}</textarea>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Edit Post</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- /Edit Post -->



            </div>
        </div>
        <!-- /Page Wrapper -->


    </div>
    <!-- /Main Wrapper -->

@endsection
