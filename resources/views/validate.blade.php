<script>

@if($errors->any())
    swal('Error', '{{ $errors->first() }}', 'warning');
@endif

@if( Session::has('success') )
    swal('Successful', '{{ Session::get('success') }}', 'success');
@endif

</script>
