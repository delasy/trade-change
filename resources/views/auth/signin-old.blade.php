@extends('layouts.app-old')

@section('content')
    <div class="container">
        <div class="row login">
            <div class="col-md-11 login-header">
                <h2>Вход в личный кабинет</h2>
            </div>
            <div class="col-md-offset-4 col-md-8">
                <div class="row" @if (!$errors->has('email') && !$errors->has('password'))style="display:none"@endif>
                    <div class="col-md-5">
                        @if ($errors->has('email'))
                            <p class="alert-danger">{{ $errors->first('email') }}</p>
                        @elseif ($errors->has('password'))
                            <p class="alert-danger">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <div>
                                <form autocomplete="off" method="POST" action="{{ route('auth/signin') }}">
                                    {{ csrf_field() }}

                                    <div class="row">
                                        <div class="col-md-5 form-group
                                            tradechange-input{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <input type="email" class="form-control" maxlength="200" id="email"
                                                   name="email" required value="{{ old('email') }}"
                                                   autocomplete="new-email">
                                            <label for="email">E-mail</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5 form-group
                                            tradechange-input{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <input type="password" class="form-control" maxlength="200" id="password"
                                                   name="password" required autocomplete="new-password">
                                            <label for="password">Пароль</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- captcha -->
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5 form-group tradechange-checkbox">
                                            <input type="checkbox" id="remember"
                                                   name="remember"{{ old('remember') ? ' checked' : '' }}
                                                   class="css-checkbox">
                                            <label for="remember" class="checkbox">Запомнить меня</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <button type="submit" class="col-md-12 btn btn-primary btn-lg submit
                                                tradechange-btn button-loader">
                                                <span class="button-loader-content">Войти</span>
                                            </button>
                                            <a href="#" class="col-md-12 tradechange-link btn btn-link
                                            remind-password">Восстановить пароль</a>
                                            <a href="{{ route('auth/signup') }}" class="col-md-12 tradechange-link btn
                                            btn-link registration">Зарегистрироваться</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
