@extends('layouts.admin')

@section('page-title', 'Просмотр поля валюты')

@section('content')
    @include('admin/form', [
        'title' => 'Просмотр поля валюты',
        'content' => [
            'raw' => csrf_field(),
            'div1' => [
                'class' => 'mdc-text-field',
                'data-mdc-auto-init' => 'MDCTextField',
                'style' => 'width:100%',
                'HTML' => [
                    'input' => [
                        'disabled',
                        'class' => 'mdc-text-field__input',
                        'id' => 'name',
                        'value' => $curr_input->name
                     ],
                     'label' => [
                        'for' => 'name',
                        'class' => 'mdc-text-field__label',
                        'HTML' => 'Название поля'
                     ]
                ]
            ],
            'div4' => [
                'class' => 'mdc-text-field',
                'data-mdc-auto-init' => 'MDCTextField',
                'style' => 'width:100%',
                'HTML' => [
                    'input' => [
                        'disabled',
                        'class' => 'mdc-text-field__input',
                        'id' => 'html_placeholder',
                        'value' => $curr_input->html_placeholder
                     ],
                     'label' => [
                        'for' => 'html_placeholder',
                        'class' => 'mdc-text-field__label',
                        'HTML' => 'Пример поля'
                     ]
                ]
            ],
        ],
        'footer' => [
            'button' => [
                'type' => 'button',
                'class' => 'mdc-button mdc-button--compact mdc-card__action mdc-theme--text-primary-on-secondary '
                    . 'mdc-theme--secondary-bg',
                'HTML' => 'Назад',
                'onclick' => 'window.history.back()'
            ]
        ],
        'errors' => $errors
    ])
@endsection
