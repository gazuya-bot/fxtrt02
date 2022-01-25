@extends('layouts.app')

@section('content')
<div class="container  card-all">
    <div class="card">
        <h1 class="login">パスワード再設定</h1>
            <div class="card-body">                    
                <form method="POST" action="/password/reset">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- メールアドレス -->
                    <div class="form-group row">
                        <div class="col-md-12 cp_iptxt">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email }}" required autocomplete="email" placeholder="メールアドレスを入力" autofocus>
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

                    <!-- パスワード再設定 -->
                    <div class="form-group row">
                        <div class="col-md-12 cp_iptxt">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="パスワードを入力（確認用）">
                            <i class="fa fa-key fa-lg fa-fw" aria-hidden="true"></i>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('form.register.pass_change') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
