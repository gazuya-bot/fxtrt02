@extends('adminlte::page')

@section('title', 'ホーム画面')

@section('content_header')
    <!-- <h1>ホーム画面</h1> -->
@stop

@section('content')

<div class="home-box container-fluid">
    <div class="row">
        <!-- ユーザー設定 -->
        <div class="home-box-01 col-md-12 row">
            <div class="home-box-02 col-12 row">
                <div class="col-2 row">
                    <img class="home"src="{{ asset('img_default/FX-logo-03.svg') }}" alt="">
                </div>
                <div class="col-8 welcome-user">ようこそ &ensp;<span>{{ Auth::user()->name }}&thinsp;（&thinsp;ユーザーID&thinsp;:&thinsp;{{ Auth::user()->id }}&thinsp;）</span>&ensp;様</div>
                <a href="/user" class="col-2 welcome-user other-link"><i class="fas fa-user"></i></a>
            </div>
        </div>
        <!-- 時計 -->
        <div class="home-box-01 col-md-12 row">
            <div class="home-box-02 clock col-12">
                <p class="clock-date"></p>
                <p class="clock-time"></p>
            </div>
        </div>

        <!-- 左側 -->
        <div class="home-box-01 col-md-6 row">
            <!-- 約定日時 -->
            <div class="home-box-02 col-12 row">
                <h2 class="infomation-box col-12">回数・勝率</h2>
                <div class="col-6 infomation-box-02 info-title">前日トレード回数</div>
                <div class="col-6 infomation-box-02 info-title">前日勝率</div>
                <div class="col-6 infomation-box-03">{{$d_count}}<span class="home">&emsp;回</span></div>
                <div class="col-6 infomation-box-03">{!!floor($d_win_rate)!!}<span class="home">&emsp;%</span></div>
                <div class="col-6 infomation-box-02 info-title">週間トレード回数</div>
                <div class="col-6 infomation-box-02 info-title">週間勝率</div>
                <div class="col-6 infomation-box-03">{{$w_count}}<span class="home">&emsp;回</span></div>
                <div class="col-6 infomation-box-03">{!! floor($w_win_rate) !!}<span class="home">&emsp;%</span></div>
                <div class="col-6 infomation-box-02 info-title">月間トレード回数</div>
                <div class="col-6 infomation-box-02 info-title">月間勝率</div>
                <div class="col-6 infomation-box-03">{{$m_count}}<span class="home">&emsp;回</span></div>
                <div class="col-6 infomation-box-03">{!!floor($m_win_rate)!!}<span class="home">&emsp;%</span></div>
            </div>
        </div>

        <div class="home-box-01 col-md-6 row">
            <!-- 約定日時 -->
            <div class="home-box-02 col-12 row">
                <h2 class="infomation-box col-12">利益</h2>
                <div class="col-6 infomation-box-02 info-title">前日（pips）</div>
                <div class="col-6 infomation-box-02 info-title">前日（円）</div>
                <div class="col-6 infomation-box-03">{{$d_pips}}<span class="home">&emsp;pips</span></div>
                <div class="col-6 infomation-box-03">{{number_format($d_yen)}}<span class="home">&emsp;円</span></div>
                <div class="col-6 infomation-box-02 info-title">週間（pips）</div>
                <div class="col-6 infomation-box-02 info-title">週間（円）</div>
                <div class="col-6 infomation-box-03">{{$w_pips}}<span class="home">&emsp;pips</span></div>
                <div class="col-6 infomation-box-03">{{number_format($w_yen)}}<span class="home">&emsp;円</span></div>
                <div class="col-6 infomation-box-02 info-title">月間（pips）</div>
                <div class="col-6 infomation-box-02 info-title">月間（円）</div>
                <div class="col-6 infomation-box-03">{{$m_pips}}<span class="home">&emsp;pips</span></div>
                <div class="col-6 infomation-box-03">{{number_format($m_yen)}}<span class="home">&emsp;円</span></div>
            </div>
        </div>
        <div class="col-12 month_remarks">※&ensp;月間は直近３０日とする&ensp;/&ensp;統計は約定日で算出とする&ensp;/&ensp;勝率の小数点以下は切り捨てとする</div>
        
        <!-- グラフ（実装予定） -->
        <!-- <div class="home-box-01 col-sm-6 row">
            <div class="home-box-02 col-12 row">
            <h2 class="infomation-box col-12">トレード通貨比率（通年）</h2>
                <div class="col-12 graph-box">
                    <canvas id="mychart" class=""></canvas>
                </div>
            </div>
        </div> -->

        <!-- グラフ（実装予定） -->
        <!-- <div class="home-box-01 col-sm-6 row">
            <div class="home-box-02 col-12 row">
            <h2 class="infomation-box col-12">トレード通貨比率（通年）</h2>
                <div class="col-12 graph-box">
                    <canvas id="mychart" class=""></canvas>
                </div>
            </div>
        </div> -->

        <!-- お知らせ -->
        <div class="home-box-01 col-md-12 row">
            <div class="home-box-02 col-12 row">
                <h2 class="infomation-box_ col-12">お知らせ</h2>
                <div class="infomation-box-02 col-sm-3 info-title">2022年01月05日</div>
                <div class="infomation-box-02 col-sm-9">このツールをLaravelへ移行作業開始しました。</div>
                <div class="infomation-box-02 col-sm-3 info-title">2022年01月05日</div>
                <div class="infomation-box-02 col-sm-9">このツールをLaravelへ移行作業開始しました。</div>
                <div class="infomation-box-02 col-sm-3 info-title">2022年01月20日</div>
                <div class="infomation-box-02 col-sm-9">サーバへ公開しました</div>
            </div>
        </div>

        <!-- 実装予定機能 -->
        <div class="home-box-01 col-md-12 row">
            <div class="home-box-02 col-12 row">
                <h2 class="infomation-box_ col-12">実装予定</h2>
                <div class="infomation-box-02 col-sm-3 info-title">2022年02月10日</div>
                <div class="infomation-box-02 col-sm-9">グラフ表示による可視化の向上（一般ユーザー向け）</div>
                <div class="infomation-box-02 col-sm-3 info-title">2022年02月28日</div>
                <div class="infomation-box-02 col-sm-9">   ユーザー管理画面の追加（管理者向け）</div>
                <div class="infomation-box-02 col-sm-3 info-title">未定</div>
                <div class="infomation-box-02 col-sm-9">ユーザーアイコンの追加（一般ユーザー向け）</div>
                <div class="infomation-box-02 col-sm-3 info-title">未定</div>
                <div class="infomation-box-02 col-sm-9">時間足別の画像登録（一般ユーザー向け）</div>
            </div>
        </div>
        <div class="col-12 month_remarks">※&ensp;現在計画中のものであり、確約するものではありません</div>

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
    <!-- Page specific script -->
    <script>
        $(function () {
        bsCustomFileInput.init();
        });
    </script>
    <!-- Enterキー無効 -->
    <script src="{{ asset('/js/buysell.js') }}"></script>

    <script src="{{ asset('/js/clock.js') }}"></script>

    <!-- チャートjs -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js"
        integrity="sha512-VMsZqo0ar06BMtg0tPsdgRADvl0kDHpTbugCBBrL55KmucH6hP9zWdLIWY//OTfMnzz6xWQRxQqsUFefwHuHyg=="
        crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns@next/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
    <script>
var ctx = document.getElementById('mychart');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
        datasets: [{
        label: 'Red',
        data: [20, 35, 40, 30, 45, 35, 40],
        borderColor: '#f88',
        }, {
        label: 'Green',
        data: [20, 15, 30, 25, 30, 40, 35],
        borderColor: '#484',
        }, {
        label: 'Blue',
        data: [30, 25, 10, 5, 25, 30, 20],
        borderColor: '#48f',
        }],
    },
    options: {
        y: {
        min: 0,
        max: 60,
        },
    },
    });
    </script>
@stop