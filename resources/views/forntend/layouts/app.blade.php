<!DOCTYPE html>
<html lang="en">


<head>
    @include('forntend.layouts.head')
</head>

<body>


{{--@include('forntend.layouts.partials.preloader')--}}
@include('forntend.layouts.header')
@include('forntend.layouts.page-header')

@section('main-content')
@show

@include('forntend.layouts.footer')


</body>


</html>
