@extends('layouts.app-old')

@section('content')
    <div class="error-page page-not-found text-center">
        <p class="error-code">404</p>
        <p class="error-text">Страница не найдена</p>
        <a href="{{ url('/') }}" class="btn btn-button btn-primary tradechange-btn gotomain-button">На главную</a>
    </div>
@endsection
