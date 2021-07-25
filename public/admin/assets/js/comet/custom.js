(function ($){
    $(document).ready(function (){


    //    Logout Features
        $(document).on('click', '#logout_btn', function (e){
            e.preventDefault();
            $('#logout_form').submit();
        });


    //    Category Status Update
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


    //    Delete Btn Message Category
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

    //    Edit Category Modal Show With Data
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

        //    Delete Btn Message Tag
        $(document).on('click', '#tag_delete_btn', function (){

            let conf = confirm('Are you sure?');
            if (conf == true){
                return true;
            }else {
                return false;
            }

        });







    });

})(jQuery)
