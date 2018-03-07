@extends('layouts.admin')

@section('page-title', 'Поля валюты')

@section('content')
    <div class="mdc-layout-grid max-width">
        <div class="admin-statistic-grid mdc-layout-grid__inner">
            <div class="admin-statistic-cell mdc-card mdc-layout-grid__cell mdc-layout-grid__cell--span-3">
                <section class="mdc-card__media">
                    <h1 class="mdc-card__title mdc-theme--text-secondary-on-primary">Добавить поле валюты</h1>
                </section>
                <section class="mdc-card__actions">
                    <a href="{{ route('admin/curr-input/add') }}"
                       class="mdc-button mdc-button--compact mdc-card__action mdc-theme--text-secondary-on-primary">
                        Добавить
                    </a>
                </section>
            </div>

            @foreach ($curr_inputs as $curr_input)
                <div class="admin-statistic-cell mdc-card mdc-layout-grid__cell mdc-layout-grid__cell--span-3">
                    <section class="mdc-card__media">
                        <h1 class="mdc-card__title mdc-theme--text-secondary-on-primary">
                            {{ $curr_input->name }}
                        </h1>
                    </section>
                    <section class="mdc-card__actions">
                        <a href="{{ url('/admin/curr-input/look/' . $curr_input->id) }}"
                           class="mdc-button mdc-button--compact mdc-card__action mdc-theme--text-secondary-on-primary">
                            Посмотреть
                        </a>
                    </section>
                </div>
            @endforeach
        </div>
    </div>
@endsection
