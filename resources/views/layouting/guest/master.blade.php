<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouting.guest._partials.headers')
</head>

<body>
    @include('layouting.guest._partials.navbar')
    @yield('content')
    @include('layouting.guest._partials.footer')
    @include('layouting.guest._partials.scripts')

</body>

</html>

