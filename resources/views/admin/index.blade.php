@extends('layouts.admin')

@section('page-title', 'Панель статистики')

@section('content')
    <div class="mdc-layout-grid max-width">
        <div class="admin-statistic-grid mdc-layout-grid__inner">
            @foreach ($boxes as $box_title => $box_value)
                <div class="admin-statistic-cell mdc-elevation--z3 mdc-layout-grid__cell mdc-layout-grid__cell--span-3">
                    <h2 class="mdc-typography--body1 m-b-16">{!! $box_title !!}</h2>
                    <h1 class="mdc-typography--display1">{{ $box_value }}</h1>
                </div>
            @endforeach
        </div>
    </div>
@endsection
