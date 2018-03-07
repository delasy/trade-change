@extends('layouts.admin')

@section('page-title', 'Добавление валюты получения')

@section('content')
    @include('admin/form', [
        'title' => 'Добавление валюты получения',
        'content' => [
            'raw' => csrf_field(),
            'div' => [
                'class' => 'mdc-select',
                'style' => 'width:100%',
                'HTML' => [
                    'select' => [
                        'class' => 'mdc-select__surface',
                        'required',
                        'name' => 'ex_curr_in_id',
                        'HTML' => App\Helpers\AppHelper::toSelectOptions(
                            $ex_currs,
                            'Выберите валюту получения',
                            old('ex_curr_in_id'),
                            'id',
                            function ($param) {
                                return $param->name . ' ' . $param->curr->name;
                            }
                        )
                    ],
                    'div' => ['class' => 'mdc-select__bottom-line']
                ]
            ]
        ],
        'footer' => [
            'button' => [
                'type' => 'submit',
                'class' => 'mdc-button mdc-button--compact mdc-card__action mdc-theme--text-primary-on-secondary '
                    . 'mdc-theme--secondary-bg',
                'HTML' => 'Сохранить'
            ]
        ],
        'errors' => $errors
    ])
@endsection
