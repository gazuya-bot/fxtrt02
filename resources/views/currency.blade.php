@extends('adminlte::page')

@section('title', '通貨ペア管理')

@section('content_header')
    <h1>通貨ペア管理</h1>
@stop

@section('content')

<div class="user-box container-fluid">
    <form method="post" action="/currency_change" class="row">
    @csrf
        <!-- 取引数量 -->
        <div class="in-min col-12 row">
            <div class="col-8">
                <input type="text" class="in-ans form-control u_line" name="currency_pair" placeholder="通貨ペアを入力">
            </div>
            <!--  登録ボタン -->
            <div class="col-2">
                <input type="submit" class="btn btn-primary w-100 btn_submit" name="btn_submit_01" value="登録">
            </div>
            <!--  削除ボタン -->
            <div class="col-2">
                <input type="submit" class="btn btn-danger w-100 btn_submit" name="btn_submit_02" value="削除">
            </div>
        </div>
    </form>


    <div class="all-box col-12 row">
        @if(isset($currency_act))
        <div class="col-12 row">
            <h2 class="col-12">現在表示中</h2>
            @foreach($currency_act as $data)
                <div class="col-3 check_currency">{{ $data->currency }}</div>
                <div class="col-3"><button class="btn btn-warning w-75 btn_submit" onclick="currency_delete('{{ $data->id }}')"><i class="fas fa-eye-slash"></i></i></button></div>
            @endforeach
        </div>
        @endif
        
        @if(isset($currency_del))
        <div class="col-12 row">
            <h2 class="col-12">非表示中</h2>
                @foreach($currency_del as $data)
                    <div class="col-3 check_currency">{{ $data->currency }}</div>
                    <div class="col-3"><button class="btn btn-primary w-75 btn_submit" onclick="currency_change('{{ $data->id }}')"><i class="fas fa-eye"></i></button></div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

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

    <!-- 通貨非表示 -->
    <script>
    function currency_delete(id){
        var data_id = id
        if(window.confirm('非表示にしますか？')){
            // alert('非表示にしました。');
            // 画面遷移
            location.href = "/currency_del/" + data_id;
        }
    }
    </script>

    <!-- 通貨表示 -->
    <script>
    function currency_change(id){
        var data_id = id
        if(window.confirm('表示しますか？')){
            // alert('表示しました。');
            // 画面遷移
            location.href = "/currency_act/" + data_id;
        }
    }
    </script>


@stop