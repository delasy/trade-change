@extends('layouts.admin')

@section('page-title', 'Добавление поля валюты')

@section('content')
    @include('admin/form', [
        'title' => 'Добавление поля валюты',
        'content' => [
            'raw' => csrf_field(),
            'div1' => [
                'class' => 'mdc-text-field',
                'data-mdc-auto-init' => 'MDCTextField',
                'style' => 'width:100%',
                'HTML' => [
                    'input' => [
                        'name' => 'name',
                        'required',
                        'class' => 'mdc-text-field__input',
                        'id' => 'name',
                        'value' => old('name')
                     ],
                     'label' => [
                        'for' => 'name',
                        'class' => 'mdc-text-field__label',
                        'HTML' => 'Введите название поля'
                     ]
                ]
            ],
            'div4' => [
                'class' => 'mdc-text-field',
                'data-mdc-auto-init' => 'MDCTextField',
                'style' => 'width:100%',
                'HTML' => [
                    'input' => [
                        'name' => 'html_placeholder',
                        'required',
                        'class' => 'mdc-text-field__input',
                        'id' => 'html_placeholder',
                        'value' => old('html_placeholder')
                     ],
                     'label' => [
                        'for' => 'html_placeholder',
                        'class' => 'mdc-text-field__label',
                        'HTML' => 'Введите пример поля'
                     ]
                ]
            ],
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
