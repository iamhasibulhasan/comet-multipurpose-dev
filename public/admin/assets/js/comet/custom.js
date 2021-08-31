(function ($){
    $(document).ready(function (){


    // Load CK Editor
        CKEDITOR.replace('post_content_editor');

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
                        Swal.fire({
                            position: 'top-end',
                            title: "Inactive !",
                            text: "Status inactivate successful!",
                            icon: "warning",
                            showConfirmButton: false,
                            timer: 1500
                        }).then((value)=>{
                            location.reload();
                        });
                    }
                });
            }else{
                $.ajax({
                    url: 'category/status/active/' + id,
                    success:function (data){
                        Swal.fire({
                            position: 'top-end',
                            title: "Activate !",
                            text: "Status activate successful!",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
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
                        Swal.fire({
                            position: 'top-end',
                            title: "Inactive !",
                            text: "Status inactivate successful!",
                            icon: "warning",
                            showConfirmButton: false,
                            timer: 1500
                        }).then((value)=>{
                            location.reload();
                        });
                    }
                });
            }else{
                $.ajax({
                    url: 'tag/status/active/' + id,
                    success:function (data){


                        Swal.fire({
                            position: 'top-end',
                            title: "Activate !",
                            text: "Status activate successful!",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
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
            let img_gallery = '';

            console.log(e.target.files.length);
            for (let i=0; i < e.target.files.length; i++){
                let file_url = URL.createObjectURL(e.target.files[i]);
                img_gallery += '<img class="shadow" src="'+ file_url +'">';
            }
            $('.post-gallery-img').html(img_gallery);

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

        //   Post Status Update
        $(document).on('click', 'input.post-check', function (){

            let checked = $(this).attr('checked');
            let id = $(this).attr('status_id');

            if (checked == 'checked'){
                $.ajax({
                    url: 'post/status/inactive/' + id,
                    success:function (data){

                        Swal.fire({
                            position: 'top-end',
                            title: "Inactive !",
                            text: "Status inactivate successful!",
                            icon: "warning",
                            showConfirmButton: false,
                            timer: 1500
                        }).then((value)=>{
                            location.reload();
                        });
                    }
                });
            }else{
                $.ajax({
                    url: 'post/status/active/' + id,
                    success:function (data){

                        Swal.fire({
                            position: 'top-end',
                            title: "Activate !",
                            text: "Status activate successful!",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        }).then((value)=>{
                            location.reload();
                        });
                    }
                });
            }
        });

    //Blog Category Table Convert into Datatable
        $('#blog_cat_tbl').DataTable();



    //Product brand table
        $('#product_brand_tbl').DataTable({
            processing:true,
            serverSide:true,
            ajax: {
                url: 'brand'
            },
            columns:[
                {
                    data:'id',
                    name:'id'
                },
                {
                    data:'name',
                    name:'name'
                },
                {
                    data:'slug',
                    name:'slug'
                },
                {
                    data:'logo',
                    name:'logo',
                    render:function (data, type, full, meta){
                        return `<img style="height: 50px;width: 50px;" src="media/products/brands/${data}">`;
                    }
                },
                {
                    data:'status',
                    name:'status',
                    render:function (data, type, full, meta){
                        return `
                            <div class="status-toggle">
                                <input ${data == 1 ? 'checked="checked"':''} value="${data}" type="checkbox" status_id="${full.id}" id="brand_status_${full.id}" class="check brand-check">
                                <label for="brand_status_${full.id}" class="checktoggle">checkbox</label>
                            </div>
                         `;
                    }
                },
                {
                    data:'action',
                    name:'action'
                }
            ]
        });
        //Add product brand
        $(document).on('submit', '#product_brand_form', function (e){
            e.preventDefault();
            $.ajax({
                url:'brand',
                method:'POST',
                data:new FormData(this),
                contentType:false,
                processData:false,
                success:function (data){
                    $('#product_brand_form')[0].reset();
                    $('#add_new_brand_modal').modal('hide');
                    $('#product_brand_tbl').DataTable().ajax.reload();
                }

            });
        });

    //Product brand status
        $(document).on('change', 'input.brand-check', function (){
            let status_id = $(this).attr('status_id');
            $.ajax({
                url: 'brand-status/'+ status_id,
                success: function (data){
                    Swal.fire({
                        position: 'top-end',
                        title: data,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#product_brand_tbl').DataTable().ajax.reload();
                }
            });
        });

    //    Product brand delete
    $(document).on('click', 'a.brand-del', function (e){
        e.preventDefault();
        let id = $(this).attr('del-brand-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'brand-delete/'+ id,
                    success:function (data){
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: data+' has been deleted',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#product_brand_tbl').DataTable().ajax.reload();
                    }
                });

            }
        })

    });

    });

})(jQuery)
