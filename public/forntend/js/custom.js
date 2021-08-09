(function ($){
    $(document).ready(function (){


    //    Comment Replay Box show
        $('a.comment_reply_btn').click(function (e){
            e.preventDefault();
            let cid = $(this).attr('c_id');
            $('.reply-box-' + cid).toggle();
        });



    });

})(jQuery)
