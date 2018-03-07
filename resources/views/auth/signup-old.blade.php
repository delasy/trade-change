@extends('layouts.app-old')

@section('content')
    <div class="container">
        <div class="row login">
            <div class="col-md-11 login-header">
                <h2>Регистрация</h2>
            </div>
            <div class="col-md-offset-4 col-md-8">
                <div class="row" @if (!$errors->has('name') && !$errors->has('email') && !$errors->has('password'))
                    style="display:none" @endif>
                    <div class="col-md-5">
                        @if ($errors->has('name'))
                            <p class="alert-danger">{{ $errors->first('name') }}</p>
                        @elseif ($errors->has('email'))
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
                                <form autocomplete="off" method="POST" action="{{ route('auth/signup') }}">
                                    {{ csrf_field() }}

                                    <div class="row">
                                        <div class="col-md-5 form-group
                                            tradechange-input{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <input type="text" class="form-control" maxlength="200" id="name"
                                                   name="name" value="{{ old('name') }}" required>
                                            <label for="name">Имя</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5 form-group
                                            tradechange-input{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <input type="email" class="form-control" maxlength="200" id="email"
                                                   name="email" required value="{{ old('email') }}">
                                            <label for="email">E-mail</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5 form-group
                                            tradechange-input{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <input type="password" class="form-control" maxlength="200" id="password"
                                                   name="password" required>
                                            <label for="password">Пароль</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5 form-group tradechange-input">
                                            <input type="password" class="form-control" maxlength="200"
                                                   id="password_confirmation" name="password_confirmation" required>
                                            <label for="password_confirmation">Подтверждение пароля</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- captcha -->
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <button type="submit" class="col-md-12 btn btn-primary btn-lg submit
                                                tradechange-btn button-loader">
                                                <span class="button-loader-content">Зарегистрироваться</span>
                                            </button>
                                            <a href="{{ route('auth/signin') }}" class="col-md-12 tradechange-link btn
                                                btn-link registration">Авторизация</a>
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
