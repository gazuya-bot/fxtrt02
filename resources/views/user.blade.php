@extends('adminlte::page')

@section('title', 'ユーザー設定')

@section('content_header')
    <h1>ユーザー設定</h1>
@stop

@section('content')

<main class="mt-4">
    @yield('content')
</main>

<div class="user-box container-fluid">
    <form method="post" action="/user_change" class="row" enctype="multipart/form-data">
    @csrf
        <!-- 左側 -->
        <div class="left-box col-md-12 row">
            <!-- 登録日 -->
            <h3 class="col-3 in-min">登録日</h3>
            <div class="col-9 in-min "><p class="u_line_non">{{ Auth::user()->created_at }}</p></div>
            <!-- ユーザーID -->
            <h3 class="col-3 in-min">ID</h3>
            <div class="col-9 in-min"><p class="u_line_non">{{ Auth::user()->id }}</p></div>
            <!-- ユーザー名 -->
            <h3 class="col-3 in-min">名前</h3>
            <div class="col-9 in-min"><input value="{{ Auth::user()->name }}" type="text" class="in-ans form-control u_line" name="name"></div>
            <!-- メールアドレス -->
            <h3 class="col-3 in-min">メール</h3>
            <div class="col-9 in-min"><input value="{{ Auth::user()->email }}" type="" class="in-ans form-control u_line" name="email"></div>
        
            <!--  変更ボタン -->
            <div class="in-btn offset-1 col-11">
                <input type="submit" class="btn btn-primary w-100 btn_submit" name="btn_submit" value="変更">
            </div>
        </div>
    </form>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{asset('css/add_style.css')}}">
    <!-- googlefont -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kosugi+Maru&family=Train+One&display=swap" rel="stylesheet">
@stop

@section('js')
    <!-- jQuery -->
    <script src="http://localhost/MOT/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="http://localhost/MOT/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="http://localhost/MOT/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="http://localhost/MOT/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="http://localhost/MOT/js/demo.js"></script>
    <!-- Enterキー無効 -->
    <script src="{{ asset('/js/buysell.js') }}"></script>

    <!-- フラッシュメッセージ（toastr） -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- フラッシュメッセージ -->
    <script>
        toastr.options = {
            "positionClass": "toast-top-right",
            "timeOut": "5000",
            "closeButton": true,
            "progressBar": true, 
        };
        // 成功（ユーザー設定変更成功）
        @if (session('msg_success'))
            $(function () {
                    toastr.success('{{ session('msg_success') }}');
            });
        @endif
        // 警告（ユーザー設定変更警告）
        @if (session('msg_warning'))
            $(function () {
                toastr.warning('{{ session('msg_warning') }}');
            });
        @endif
    </script>
@stop