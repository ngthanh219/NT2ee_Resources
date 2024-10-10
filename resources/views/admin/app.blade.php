<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản trị hệ thống</title>

    @include('admin.layout.css')
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            @include('admin.layout.sidebar')

            @include('admin.layout.header')

            <div class="right_col" role="main">
                @yield('index')
            </div>

            @include('admin.layout.footer')
        </div>
    </div>
</body>

@include('admin.layout.script')

</html>
