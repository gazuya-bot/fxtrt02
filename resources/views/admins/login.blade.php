@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <h1 class="login">管理者ログイン</h1>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.login') }}">
                        @csrf

                        <!-- メールアドレス -->
                        <div class="form-group row">
                            <div class="col-md-12 cp_iptxt">
                                <input id="email" type="email" class="login form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="メールアアドレス" autofocus>
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
                                <input id="password" type="password" class="login form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="パスワード">
                                <i class="fa fa-key fa-lg fa-fw" aria-hidden="true"></i>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- ログインボタン -->
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary login">
                                    {{ __('ログイン') }}
                                </button>
                            </div>
                        </div>

                        <!-- 会員登録 -->
                        <div class="col-md-12 ">
                            <a class="nav-link re-pass" href="{{ route('home') }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                管理者でない方はコチラ！
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
