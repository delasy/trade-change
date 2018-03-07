<!DOCTYPE html>
<html class="mdc-typography">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="robots" content="noindex,nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin panel - @yield('page-title')</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&subset=cyrillic" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{ url('css/mdc.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
    <link rel="stylesheet" href="{{ url('css/admin.css') }}">
</head>
<body class="admin">

<div class="mdc-toolbar mdc-toolbar--fixed">
    <div class="mdc-toolbar__row">
        <section class="mdc-toolbar__section mdc-toolbar__section--align-start">
            <button class="admin-menu-toggle material-icons mdc-toolbar__menu-icon">menu</button>
            <span class="mdc-toolbar__title catalog-title">@yield('page-title')</span>
        </section>
    </div>
</div>

<aside class="mdc-temporary-drawer">
    <nav class="mdc-temporary-drawer__drawer">
        <header class="mdc-temporary-drawer__header">
            <div class="mdc-temporary-drawer__header-content mdc-theme--primary-bg mdc-theme--text-primary-on-primary">
                {{ Auth::user()->name }}
            </div>
        </header>
        <nav class="mdc-temporary-drawer__content mdc-list-group">
            <div class="mdc-list">
                <a class="mdc-list-item{{ App\Helpers\AppHelper::setActiveMenu(Request::path(), 'admin', false) }}"
                   href="{{ route('admin/index') }}">
                    <i class="material-icons mdc-list-item__start-detail" aria-hidden="true">dashboard</i>Панель
                    статистики
                </a>
            </div>

            <hr class="mdc-list-divider">

            <div class="mdc-list">
                <a class="mdc-list-item{{
                    App\Helpers\AppHelper::setActiveMenu(Request::path(), 'admin/curr', false)
                }}" href="{{ route('admin/curr') }}">
                    <i class="material-icons mdc-list-item__start-detail" aria-hidden="true">attach_money</i>Валюта
                </a>

                <a class="mdc-list-item{{
                   App\Helpers\AppHelper::setActiveMenu(Request::path(), 'admin/curr-input', false)
                }}" href="{{ route('admin/curr-input') }}">
                    <i class="material-icons mdc-list-item__start-detail" aria-hidden="true">input</i>
                    Поля валюты
                </a>

                <a class="mdc-list-item{{
                    App\Helpers\AppHelper::setActiveMenu(Request::path(), 'admin/ex-curr', false)
                }}" href="{{ route('admin/ex-curr') }}">
                    <i class="material-icons mdc-list-item__start-detail" aria-hidden="true">autorenew</i>
                    Обмен валюты
                </a>
            </div>

            <hr class="mdc-list-divider">

            <div class="mdc-list">
                <a class="mdc-list-item" href="{{ route('auth/signout') }}">
                    <i class="material-icons mdc-list-item__start-detail" aria-hidden="true">exit_to_app</i>
                    Выход
                </a>
            </div>
        </nav>
    </nav>
</aside>

<main class="admin-main mdc-toolbar-fixed-adjust">@yield('content')</main>

<script src="{{ url('js/mdc.min.js') }}"></script>
<script>mdc.autoInit();</script>
<script src="{{ url('js/admin.js') }}"></script>
</body>
</html>
