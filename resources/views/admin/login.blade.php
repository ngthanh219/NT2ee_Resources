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

<body class="login">
    <div>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <h1>{{ $pageName }}</h1>
                        <div>
                            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" />
                        </div>
                        <div>
                            <input type="password" name="password" class="form-control" placeholder="Mật khẩu" value="{{ old('password') }}" />
                        </div>
                        
                        @if ($errors->has('email'))
                            <div class="error-text">{{ $errors->first('email') }}</div>
                        @endif
                        
                        @if ($errors->has('password'))
                            <div class="error-text">{{ $errors->first('password') }}</div>
                        @endif
                        
                        @if ($errors->has('password'))
                            <div class="error-text">{{ $errors->first('password') }}</div>
                        @endif

                        <div>
                            <button type="submit" class="btn btn-primary submit">Đăng nhập</button>
                        </div>

                        <div class="clearfix"></div>
                    </form>
                </section>
            </div>
        </div>
    </div>
    
    @include('admin.layout.noti')
</body>

</html>