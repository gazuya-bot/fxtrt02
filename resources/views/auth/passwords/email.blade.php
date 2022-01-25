@extends('layouts.app')

@section('content')
<div class="container card-all">
    <div class="card">
        <h1 class="login pass-send">{{ __('form.register.pass_reset') }}</h1>
        <div class="card-body">

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                
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

                <!-- パスワード再設定ボタン -->
                <div class="form-group row mb-0">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary login">
                            {{ __('form.register.pass_reset_send') }}
                        </button>
                    </div>
                </div>   

                <!-- 戻るリンク -->
                <div class="col-md-12 ">
                    <a class="nav-link re-pass other-link" href="/">戻る</a>
                </div>    
            </form>
        </div>
    </div>
</div>
@endsection
