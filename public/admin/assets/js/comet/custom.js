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







    });

})(jQuery)
