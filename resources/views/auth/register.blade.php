@extends('layouts.app')

@section('content')
<div class="container card-all">
    <!-- <div class="row justify-content-center">
        <div class="col-md-8"> -->
            <div class="card">
                <h1 class="login">会員登録</h1>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- 名前 -->
                        <div class="form-group row">
                            <div class="col-md-12 cp_iptxt">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="名前を入力" autofocus>
                                <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- メールアドレス -->
                        <div class="form-group row">
                            <div class="col-md-12 cp_iptxt">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="メールアドレスを入力">
                                <i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true"></i>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- パスワード -->
                        <div class="form-group row">
                            <div class="col-md-12 cp_iptxt">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="パスワードを入力">
                                <i class="fa fa-key fa-lg fa-fw" aria-hidden="true"></i>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- パスワード（確認用） -->
                        <div class="form-group row">
                            <div class="col-md-12 cp_iptxt">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="パスワードを入力（確認用）">
                                <i class="fa fa-key fa-lg fa-fw" aria-hidden="true"></i>
                            </div>
                        </div>

                        <!-- 登録ボタン -->
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary login">
                                    {{ __('登録') }}
                                </button>
                            </div>
                        </div>

                        <div class="col-md-12 ">
                            <a class="btn btn-link nav-link re-pass" href="/">戻る</a>
                        </div>                    
                    </form>
                </div>
            </div>
        <!-- </div> -->
    <!-- </div> -->
</div>
@endsection