@extends('adminlte::page')

@section('title', '出力画面')

@section('content_header')
    <h1>出力画面</h1>
@stop

@section('content')

<div class="all-box container-fluid">
    <div class="row search-box">
        <!-- 検索 -->
        <form class="in-min col-12 row text-center" method="GET">
            <div class="col-9">
                <input value="{{request('search')}}" class="in-ans form-control" type="search" placeholder="検索キーワードを入力" name="search">
            </div>
            <div class="col-3">
                <input type="submit" value="検索" class="btn btn-secondary w-100">
            </div>
        </form>
    </div>
    
    @foreach($input_data as $data)
        <div class="section s_02">
            <div class="accordion_one">
                <div class="accordion_header">
                    <div>登録日：{{ $data->created_at }}　取引通貨：{{ $data->trade_currency }}</div>
                    <div class="i_box"><i class="one_i"></i></div>
                </div>
                <div class="accordion_inner container-fluid">
                    <div class="box_one row out_item_d">
                        <div class="col-12 row">
                            <div class="col-4 out_item">勝敗</div>
                            <div class="col-8 out_item">{{ $data->id }}</div>
                        </div>
                        <div class="col-12 row">
                            <div class="col-4 out_item">取引数量</div>
                            <div class="col-8 out_item">{{ $data->trade_num }}</div>
                        </div>
                        <div class="col-12 row">
                            <div class="col-4 out_item">売り買い</div>
                            <div class="col-8 out_item">{{ ($data->buy_sell) }}</div>
                        </div>
                        <div class="col-12 row">
                            <div class="col-4 out_item">約定日時</div>
                            <div class="col-8 out_item">{{ $data->start_day }}</div>
                        </div>
                        <div class="col-12 row">
                            <div class="col-4 out_item">約定レート</div>
                            <div class="col-8 out_item">{{ $data->start_rate }}</div>
                        </div>

                        <div class="col-12 row">
                            <div class="col-4 out_item">決済日時</div>
                            <div class="col-8 out_item">{{ $data->end_day }}</div>
                        </div>

                        <div class="col-12 row">
                            <div class="col-4 out_item">決済レート</div>
                            <div class="col-8 out_item">{{ $data->end_rate }}</div>
                        </div>

                        <div class="col-12 row">
                            <div class="col-4 out_item">損益（pips）</div>
                            <div class="col-8 out_item">{{ $data->profit_pips }}</div>
                        </div>
                        <div class="col-12 row">
                            <div class="col-4 out_item">損益（円）</div>
                            <div class="col-8 out_item">{{ $data->profit_yen }}</div>
                        </div>
                        @if(isset($data->remarks_tech))
                        <div class="col-12 row">
                            <div class="col-4 out_item">備考</div>
                            <div class="col-8 out_item">{{ $data->remarks_tech }}</div>
                        </div>
                        @endif

                        <div class="col-12 row">
                            @if(isset($data->img_01))
                            <div class="col-sm-6 out_item">
                                <img class="img_user" alt="登録なし" src="{{ asset('storage/img_user/' . $data->img_01) }}" />
                            </div>
                            @endif
                            @if(isset($data->img_02))
                            <div class="col-sm-6 out_item">
                                <img class="img_user" alt="登録なし" src="{{ asset('storage/img_user/' . $data->img_02) }}" />
                            </div>
                            @endif
                        </div>


                        <div class="in-btn col-6">
                            <button class="btn btn-primary w-100 btn_submit user-btn" onclick="data_change('{{ $data->id }}')">編集</button>
                        </div>
                        <div class="in-btn col-6">
                            <button class="btn btn-danger w-100 btn_submit user-btn" onclick="data_delete('{{ $data->id }}')">削除</button>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    @endforeach
    
    <div class="pagenation">{{ $input_data->appends(request()->query())->links() }}</div>
    <!-- <div class="pagenation">{{ $input_data->links('pagination::bootstrap-4') }}</div> -->
    
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
    <!-- Page specific script -->
    <script>
        $(function () {
        bsCustomFileInput.init();
        });
    </script>
    <!-- Enterキー無効 -->
    <script src="{{ asset('/js/buysell.js') }}"></script>
    <!-- アコーディオン -->
    <script src="{{ asset('/js/accordion.js') }}"></script>

    <!-- 投稿削除 -->
    <script>
    function data_delete(id){
        var data_id = id
        if(window.confirm('削除しますか？')){
            alert('削除しました。');
            // 画面遷移
            location.href = "/data_delete/" + data_id;
        }
    }
    </script>

    <!-- 投稿編集 -->
    <script>
    function data_change(id){
        var data_id = id
        // 画面遷移
        location.href = "/output_change/" + data_id;
    }
    </script>

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