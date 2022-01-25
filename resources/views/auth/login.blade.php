@extends('layouts.app')

@section('content')
<div class="container card-all">
    <div class="card">
        <h1 class="login">ログイン</h1>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
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

                <!-- ログイン維持 -->
                <div class="form-group row keep-login">
                    <div class="col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('form.register.keep_login') }}
                            </label>
                        </div>
                    </div>
                </div>

                <!-- ログインボタン -->
                <div class="form-group row mb-0">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary login">
                            {{ __('form.register.login') }}
                        </button>
                    </div>
                </div>

                <!-- 会員登録 -->
                <div class="col-md-12 ">
                    @guest
                        @if (Route::has('register'))
                                <a class="nav-link re-pass other-link" href="{{ route('register') }}">{{ __('form.register.sign_up') }}</a>
                        @endif
                    @else
                        <a id="navbarDropdown" class="nav-link dropdown-toggle re-pass" href="{{ route('home') }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item re-pass" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                {{ __('form.register.logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    @endguest

                    @if (Route::has('password.request'))
                        <a class="nav-link other-link" href="{{ route('password.request') }}">
                            {{ __('form.register.pass_reset_change') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
