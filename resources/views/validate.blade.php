<script>

@if($errors->any())
    swal('Error', '{{ $errors->first() }}', 'warning');
@endif

@if( Session::has('success') )
    swal('Successful', '{{ Session::get('success') }}', 'success');
@endif

{{--@if( Session::has('confirm') )

    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this category!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
            if (willDelete) {
                swal("Poof! Your category has been deleted!", {
                    icon: "success",
                });
            } else {
                swal("Your category is safe!");
            }
        });

@endif--}}

</script>
