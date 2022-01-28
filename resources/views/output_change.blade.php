@extends('adminlte::page')

@section('title', '編集画面')

@section('content_header')
    <h1>編集画面</h1>
@stop

@section('content')

<div class="all-box container-fluid">
    <form method="POST" action="{{ route('input_change', ['id'=>$change_data->id]) }}" class="row" enctype="multipart/form-data">
    @csrf

        <!-- 左側 -->
        <div class="left-box col-md-6 row">
            <!-- 取引通貨 -->
            <div class="in-min col-12 row">
                <div class="col-3">取引通貨</div>
                <div class="col-9">
                    <select class="in-ans form-control u_line" id="trade_currency" name="trade_currency" value="{{old('trade_currency')}}">
                        <option value="{{ $change_data->trade_currency }}">{{ $change_data->trade_currency }}</option>
                        <option value="USDJPY">USD/JPY</option>
                        <option value="GBPUSD">GBP/USD</option>
                        <option value="GBPJPY">GBP/JPY</option>
                        <option value="EURUSD">EUR/USD</option>
                        <option value="EURJPY">EUR/JPY</option>
                    </select>
                </div>
                <div class="err-msg offset-3 col-9">
                    @if(!empty($errors->first('trade_currency')))
                        <p class="error_message">{{ $errors->first('trade_currency') }}</p>
                    @endif
                </div>
            </div>
            <!-- 取引数量 -->
            <div class="in-min col-12 row">
                <h3 class="col-3">取引数量</h3>
                <div class="col-9">
                    <input type="number" step="0.01" class="in-ans form-control u_line" name="trade_num" value="{{round($change_data->trade_num, 2)}}">
                </div>
                <div class="err-msg offset-3 col-9">
                    @if(!empty($errors->first('trade_num')))
                        <p class="error_message">{{ $errors->first('trade_num') }}</p>
                    @endif
                </div>
            </div>
            <!-- 売買 -->
            <div class="in-min col-12 row">
                <h3 class="col-3">売買</h3>
                <div class="col-9">
                    <select class="in-ans form-control u_line" name="buy_sell">
                        <option value="{{$change_data->buy_sell}}">{{$change_data->buy_sell}}</option>
                        <option value="buy" @if(old('buy_sell')=="buy")selected @endif>buy</option>
                        <option value="sell" @if(old('buy_sell')=="sell")selected @endif>sell</option>
                    </select>
                </div>
                <div class="err-msg offset-3 col-9">
                    @if(!empty($errors->first('buy_sell')))
                        <p class="error_message">{{ $errors->first('buy_sell') }}</p>
                    @endif
                </div>
            </div>
            <!-- 約定日時 -->
            <div class="in-min col-12 row">
                <h3 class="col-3">約定日時</h3>
                <div class="col-9">
                    <input type="datetime-local" class="in-ans form-control u_line" name="start_day" value="{!! date('Y-m-d\TH:i', strtotime($change_data->start_day)) !!}">
                </div>
                <div class="err-msg offset-3 col-9">
                    @if(!empty($errors->first('start_day')))
                        <p class="error_message">{{ $errors->first('start_day') }}</p>
                    @endif
                </div>
            </div>

            <!-- 決済日時 -->
            <div class="in-min col-12 row">
                <h3 class="col-3">決済日時</h3>
                <div class="col-9">
                    <input type="datetime-local" class="in-ans form-control u_line" name="end_day" value="{!! date('Y-m-d\TH:i', strtotime($change_data->end_day)) !!}">
                </div>
                <div class="err-msg offset-3 col-9">
                    @if(!empty($errors->first('end_day')))
                        <p class="error_message">{{ $errors->first('end_day') }}</p>
                    @endif
                </div>
            </div>

            <!-- 約定レート -->
            <div class="in-min col-12 row">
                <h3 class="col-3">約定レート</h3>
                <div class="col-9">
                    <input type="number" step="0.01" class="in-ans form-control u_line" name="start_rate" value="{{round($change_data->start_rate,2)}}">
                </div>    
                <div class="err-msg offset-3 col-9">
                    @if(!empty($errors->first('start_rate')))
                        <p class="error_message">{{ $errors->first('start_rate') }}</p>
                    @endif
                </div>
            </div>

            <!-- 決済レート -->
            <div class="in-min col-12 row">
                <h3 class="col-3">決済レート</h3>
                <div class="col-9">
                    <input type="number" step="0.01" class="in-ans form-control u_line" name="end_rate" value="{{round($change_data->end_rate,2)}}">
                </div>    
                <div class="err-msg offset-3 col-9">
                    @if(!empty($errors->first('end_rate')))
                        <p class="error_message">{{ $errors->first('end_rate') }}</p>
                    @endif
                </div>
            </div>

            <!-- 損益(pips) -->
            <div class="in-min col-12 row">
                <h3 class="col-3">損益(pips)</h3>
                <div class="col-9">
                    <input type="number" step="0.01" class="in-ans form-control u_line" name="profit_pips" value="{{round($change_data->profit_pips,2)}}">
                </div>
                <div class="err-msg offset-3 col-9">
                    @if(!empty($errors->first('profit_pips')))
                        <p class="error_message">{{ $errors->first('profit_pips') }}</p>
                    @endif
                </div>
            </div>

            <!--  損益(円) -->
            <div class="in-min col-12 row">
                <h3 class="col-3">損益(円)</h3>
                <div class="col-9">
                    <input type="number" class="in-ans form-control u_line" name="profit_yen" value="{{$change_data->profit_yen}}">
                </div>
                <div class="err-msg offset-3 col-9">
                    @if(!empty($errors->first('profit_yen')))
                        <p class="error_message">{{ $errors->first('profit_yen') }}</p>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- 右側 -->
        <div class="right-box col-md-6 row">
            <div class="r-box-title col-12 row">
                <!-- 画像01 -->
                <h3 class="in-bottom col-12">チャートイメージ&ensp;01</h3>
                <div class="col-12 row">
                    @if(isset($change_data->img_01))
                    <img class="col-sm-12 img_change" alt="登録なし" src="{{ asset('storage/img_user/' . $change_data->img_01) }}" />
                    @endif    
                    <div class="col-sm-12"><input id="myImage" type="file" class="in-ans form-control-file" name="img_01" value="{{ asset('storage/img_user/' . $change_data->img_01) }}" accept="image/*"></div>
                </div>
                <div class="err-msg offset-3 col-9">
                    @if(!empty($errors->first('img_01')))
                        <p class="error_message">{{ $errors->first('img_01') }}</p>
                    @endif
                </div>
            </div>
                
            <!-- 画像02 -->
            <div class="r-box-title col-12 row">
                <h3 class="in-bottom col-12">チャートイメージ&ensp;02</h3>
                <div class="col-12 row">
                    @if(isset($change_data->img_02))
                    <img class="col-sm-12 img_change" alt="登録なし" src="{{ asset('storage/img_user/' . $change_data->img_02) }}" />
                    @endif
                    <div class="col-sm-12"><input id="myImage" type="file" class="in-ans form-control-file img_change_btn" name="img_02" value="{{ asset('storage/img_user/' . $change_data->img_02) }}" accept="image/*"></div>
                </div>
                <div class="err-msg offset-3 col-9">
                    @if(!empty($errors->first('img_02')))
                        <p class="error_message">{{ $errors->first('img_02') }}</p>
                    @endif
                </div>
            </div>
            
            <!-- 備考 -->
            <div class="r-box-title u-box-title col-12">
                <h3 class="in-bottom">備考</h3>
                <div class="">
                    <textarea rows=7 class="in-ans form-control" name="remarks_tech">{{$change_data->remarks_tech}}</textarea>
                </div>
                <div class="err-msg offset-3 col-9">
                    @if(!empty($errors->first('remarks_tech')))
                        <p class="error_message">{{ $errors->first('remarks_tech') }}</p>
                    @endif
                </div>
            </div>

        <!--  完了ボタン -->
        <div class="in-btn col-6">
        <a href="/output"><button type="button" class="btn btn-secondary w-100 btn_submit">戻る</button></a>
        </div>
        <div class="in-btn col-6">
            <input type="submit" class="btn btn-primary w-100 btn_submit" name="btn_submit_01" value="登録">
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