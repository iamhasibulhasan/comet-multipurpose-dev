(function ($){
    $(document).ready(function (){


    // Load CK Editor
        CKEDITOR.replace('post_content');

    //    Select 2 Load
        $('.post_tag_select').select2();

    //    Logout Features
        $(document).on('click', '#logout_btn', function (e){
            e.preventDefault();
            $('#logout_form').submit();
        });


    //    Post Category Status Update
        $(document).on('click', 'input.cat-check', function (){

            let checked = $(this).attr('checked');
            let id = $(this).attr('status_id');

            if (checked == 'checked'){
                $.ajax({
                    url: 'category/status/inactive/' + id,
                    success:function (data){
                        swal({
                            title: "Inactive !",
                            text: "Status inactivate successful!",
                            icon: "warning",
                        }).then((value)=>{
                            location.reload();
                        });
                    }
                });
            }else{
                $.ajax({
                    url: 'category/status/active/' + id,
                    success:function (data){
                        swal({
                            title: "Activate !",
                            text: "Status activate successful!",
                            icon: "success",
                        }).then((value)=>{
                            location.reload();
                        });
                    }
                });
            }
        });


    //    Post Delete Btn Message Category
        $(document).on('click', '#delete_btn', function (){

            let conf = confirm('Are you sure?');
            if (conf == true){
                return true;
            }else {
                return false;
            }
            /*swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this category!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Poof! Your category file has been deleted!", {
                            icon: "success",
                        });
                        return conf;
                    } else {
                        swal("Your category file is safe!");
                        return conf == false;
                    }
                });*/

        });

    //    Post Edit Category Modal Show With Data
        $(document).on('click', '.edit-category-btn', function (e){
            e.preventDefault();
            let id = $(this).attr('edit_id');

            $.ajax({
                url: 'category/' + id + '/edit',
                success: function (data){
                    $('#edit_category_modal form input[name = "name"]').val(data.name);
                    $('#edit_category_modal form input[name = "edit_id"]').val(data.id);
                    $('#edit_category_modal').modal('show');
                }
            });

        });

        //    Post Delete Btn Message Tag
        $(document).on('click', '#tag_delete_btn', function (){

            let conf = confirm('Are you sure?');
            if (conf == true){
                return true;
            }else {
                return false;
            }

        });

        //   Post Edit Tag Modal Show With Data
        $(document).on('click', '.edit-tag-btn', function (e){
            e.preventDefault();
            let id = $(this).attr('edit_id');
            // alert(id);

            $.ajax({
                url: 'tag/' + id + '/edit',
                success: function (data){
                    $('#edit_tag_modal form input[name = "name"]').val(data.name);
                    $('#edit_tag_modal form input[name = "edit_id"]').val(data.id);
                    $('#edit_tag_modal').modal('show');
                }
            });

        });

        //   Post Tag Status Update
        $(document).on('click', 'input.tag-check', function (){

            let checked = $(this).attr('checked');
            let id = $(this).attr('status_id');

            if (checked == 'checked'){
                $.ajax({
                    url: 'tag/status/inactive/' + id,
                    success:function (data){
                        swal({
                            title: "Inactive !",
                            text: "Status inactivate successful!",
                            icon: "warning",
                        }).then((value)=>{
                            location.reload();
                        });
                    }
                });
            }else{
                $.ajax({
                    url: 'tag/status/active/' + id,
                    success:function (data){
                        swal({
                            title: "Activate !",
                            text: "Status activate successful!",
                            icon: "success",
                        }).then((value)=>{
                            location.reload();
                        });
                    }
                });
            }
        });

    //Post Image Preview
        $('#post_featured_img').change(function (e){
            let img_url = URL.createObjectURL(e.target.files[0]);
            $('.post-featured-preview').attr('src', img_url);
            $('.post-featured-preview').attr('style', 'width:150px; height:150px;');
            // $('.post-featured-preview').attr('src', img_url);
        });

        //Post Image Preview Gallery
        $('#post_featured_img_gallery').change(function (e){
            let img_url_1 = URL.createObjectURL(e.target.files[0]);
            let img_url_2 = URL.createObjectURL(e.target.files[1]);
            let img_url_3 = URL.createObjectURL(e.target.files[2]);
            let img_url_4 = URL.createObjectURL(e.target.files[3]);

            $('.post-featured-preview-gallery_1').attr('src', img_url_1);
            $('.post-featured-preview-gallery_2').attr('src', img_url_2);
            $('.post-featured-preview-gallery_3').attr('src', img_url_3);
            $('.post-featured-preview-gallery_4').attr('src', img_url_4);

            $('.post-featured-preview-gallery_1').attr('style', 'width:150px; height:150px;');
            $('.post-featured-preview-gallery_2').attr('style', 'width:150px; height:150px;');
            $('.post-featured-preview-gallery_3').attr('style', 'width:150px; height:150px;');
            $('.post-featured-preview-gallery_4').attr('style', 'width:150px; height:150px;');
            
        });


        //    Blog Post [image, gallery, video, audio]
        $('#post_format').change(function (){
            let format = $(this).val();

            if ( format == 'Image' ){
                $('.post-image').show();
            }else {
                $('.post-image').hide();
            }
            if ( format == 'Gallery' ){
                $('.post-gallery').show();
            }else {
                $('.post-gallery').hide();
            }
            if ( format == 'Video' ){
                $('.post-video').show();
            }else {
                $('.post-video').hide();
            }
            if ( format == 'Audio' ){
                $('.post-audio').show();
            }else {
                $('.post-audio').hide();
            }

        });




    });

})(jQuery)
