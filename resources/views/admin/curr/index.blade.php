@extends('layouts.admin')

@section('page-title', 'Валюта')

@section('content')
    <nav class="mdc-tab-bar" style="margin-bottom:20px;">
        <a class="mdc-tab @if (!isset($deactive))mdc-tab--active @endif" href="{{ route('admin/curr') }}">Все</a>
        <a class="mdc-tab @if (isset($deactive))mdc-tab--active @endif" href="{{ route('admin/curr/deactivated') }}">
            Архивированные ({{ \App\Models\Curr::getDeactiveCount() }})
        </a>
        <span class="mdc-tab-bar__indicator"></span>
    </nav>

    <div class="mdc-layout-grid max-width">
        <div class="admin-statistic-grid mdc-layout-grid__inner">
            <div class="admin-statistic-cell mdc-card mdc-layout-grid__cell mdc-layout-grid__cell--span-3">
                <section class="mdc-card__media">
                    <h1 class="mdc-card__title mdc-theme--text-secondary-on-primary">Добавить валюту</h1>
                </section>
                <section class="mdc-card__actions">
                    <a href="{{ route('admin/curr/add') }}"
                       class="mdc-button mdc-button--compact mdc-card__action mdc-theme--text-secondary-on-primary">
                        Добавить
                    </a>
                </section>
            </div>

            @if (!isset($deactive))
                @include('admin/curr/active')
            @else
                @include('admin/curr/deactive')
            @endif
        </div>
    </div>
@endsection
