<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <base href="{{ url('/') }}/">
    <meta name="referrer" content="origin">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="application-name" content="<?= App\Helpers\AppHelper::getMetaName() ?>">
    <meta name="apple-mobile-web-app-title" content="<?= App\Helpers\AppHelper::getMetaName() ?>">
    <meta name="msapplication-TileColor" content="black">
    <meta name="theme-color" content="black">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="msapplication-tap-highlight" content="no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title><?= App\Helpers\AppHelper::getMetaTitle() ?></title>
    <meta name="description" content="<?= App\Helpers\AppHelper::getMetaDescription() ?>">
    <meta name="keywords" content="<?= App\Helpers\AppHelper::getMetaKeywords() ?>">
    <meta property="og:description" content="<?= App\Helpers\AppHelper::getMetaDescription() ?>">
    <meta property="og:title" content="<?= App\Helpers\AppHelper::getMetaTitle() ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?= App\Helpers\AppHelper::getMetaName() ?>">
    <meta property="og:url" content="{{ url('/') }}/">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700&amp;subset=cyrillic"
          rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,400i,500,700,900&amp;subset=cyrillic"
          rel="stylesheet">
    <link href="{{ asset('css/bootstrap-old.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/style-old.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('favicon.ico') }}" rel="shortcut icon" type="image/x-icon">
    <link href="{{ asset('favicon.ico') }}" rel="icon" type="image/x-icon">
</head>
<body>
<div class="bg-page-content">
    <div class="tradechange-header">
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="logo">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('images/logo.png') }}" height="20">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6">
                                @guest
                                    <span class="slogan">
                                        <span>
                                            Ваш личный обмен электронных валют 24/7
                                            <span style="color:green">Online</span>
                                        </span>
                                    </span>
                                @endguest
                                @auth
                                    <div class="personal-area">
                                        <a href="{{ route('account/index') }}"
                                           class="btn btn-link tradechange-link
                                           @if (isset($account_active)) selected @endif">
                                            <i class="fa fa-align-left transform-270"></i>&nbsp;Личный кабинет
                                        </a>

                                        <a href="{{ route('account/settings') }}"
                                           class="btn btn-link tradechange-link
                                           @if (isset($settings_active)) selected @endif">
                                            <i class="fa fa-cog"></i>&nbsp;Настройки
                                        </a>
                                    </div>
                                @endauth
                            </div>
                            <div class="col-md-6">
                                @guest
                                    <div class="login pull-right">
                                        <a class="btn tradechange-btn" href="{{ route('auth/signin') }}">Авторизация</a>
                                    </div>
                                @endguest
                                @auth
                                    <div class="logout pull-right">
                                        <a href="{{ route('auth/signout') }}" class="btn tradechange-btn pull-right">
                                            Выход
                                        </a>
                                        @if (Auth::user()->id === intval(env('APP_MAIN_ADMIN_ID', 0)))
                                            <a href="{{ route('admin/index') }}" class="btn tradechange-btn pull-right"
                                               style="margin-right:5px;">Admin</a>
                                        @endif
                                        <div class="user-id pull-right">
                                            <a href="{{ route('account/index') }}">
                                                <i class="fa fa-user"></i>&nbsp;id{{ Auth::user()->id }}
                                            </a>
                                        </div>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main">@yield('content')</div>

    <div class="tradechange-menu">
        <div class="menu">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <a href="#" target="_blank" class="btn btn-link btn-support">
                            <img src="{{ asset('images/quest.svg') }}">&nbsp;Тех. поддержка
                        </a>
                    </div>
                    <div class="col-md-9">
                        <nav>
                            <ul class="nav navbar-nav">
                                <li><a href="{{ url('/') }}">Обмен</a></li>
                                <li><a href="#">Sell BTC</a></li>
                                <li><a href="{{ route('about-service') }}">О сервисе</a></li>
                                <li><a href="#">Тарифы</a></li>
                                <li><a href="{{ route('terms-of-service') }}">Правила</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tradechange-footer">
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        Все ваши заявки на покупку Крипто-Валют выполняються в ручном режиме. Срок выполнения Вашей
                        зависит от выбранного Вами направления, может составлять от 10 - 60 мин. Если для перевода
                        требуется верификации данных - внимательно заполняйте поля в личном кабинете.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ asset('js/app-old.js') }}"></script>
@stack('scripts')

</body>
</html>
