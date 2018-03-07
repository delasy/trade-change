@extends('layouts.admin')

@section('page-title', 'Редактирование валюты')

@section('content')
    @include('admin/form', [
        'title' => 'Редактирование валюты',
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
                        'value' => $curr->name
                     ],
                     'label' => [
                        'for' => 'name',
                        'class' => 'mdc-text-field__label',
                        'HTML' => 'Введите сокращение валюты'
                     ],
                     'div' => [
                        'class' => 'mdc-text-field__bottom-line'
                     ]
                ]
            ],
            'div2' => [
                'class' => 'mdc-text-field',
                'data-mdc-auto-init' => 'MDCTextField',
                'style' => 'width:100%',
                'HTML' => [
                    'input' => [
                        'name' => 'shortcut',
                        'required',
                        'class' => 'mdc-text-field__input',
                        'id' => 'shortcut',
                        'value' => $curr->shortcut
                     ],
                     'label' => [
                        'for' => 'shortcut',
                        'class' => 'mdc-text-field__label',
                        'HTML' => 'Введите сокращение валюты'
                     ]
                ]
            ],
            'div3' => [
                'class' => 'mdc-text-field',
                'data-mdc-auto-init' => 'MDCTextField',
                'style' => 'width:100%',
                'HTML' => [
                    'input' => [
                        'name' => 'full_name_1',
                        'required',
                        'class' => 'mdc-text-field__input',
                        'id' => 'full_name_1',
                        'value' => $curr->full_name_1
                     ],
                     'label' => [
                        'for' => 'full_name_1',
                        'class' => 'mdc-text-field__label',
                        'HTML' => 'Полное название в ед. числе'
                     ]
                ]
            ],
            'div4' => [
                'class' => 'mdc-text-field',
                'data-mdc-auto-init' => 'MDCTextField',
                'style' => 'width:100%',
                'HTML' => [
                    'input' => [
                        'name' => 'full_name_2',
                        'required',
                        'class' => 'mdc-text-field__input',
                        'id' => 'full_name_2',
                        'value' => $curr->full_name_2
                     ],
                     'label' => [
                        'for' => 'full_name_2',
                        'class' => 'mdc-text-field__label',
                        'HTML' => 'Полное название в числе двух'
                     ]
                ]
            ],
            'div5' => [
                'class' => 'mdc-text-field',
                'data-mdc-auto-init' => 'MDCTextField',
                'style' => 'width:100%',
                'HTML' => [
                    'input' => [
                        'name' => 'full_name_N',
                        'required',
                        'class' => 'mdc-text-field__input',
                        'id' => 'full_name_N',
                        'value' => $curr->full_name_N
                     ],
                     'label' => [
                        'for' => 'full_name_N',
                        'class' => 'mdc-text-field__label',
                        'HTML' => 'Полное название во мн. числе'
                     ]
                ]
            ],
            'div6' => [
                'class' => 'mdc-text-field',
                'data-mdc-auto-init' => 'MDCTextField',
                'style' => 'width:100%',
                'HTML' => [
                    'input' => [
                        'name' => 'out_text',
                        'required',
                        'class' => 'mdc-text-field__input',
                        'id' => 'out_text',
                        'value' => $curr->out_text
                     ],
                     'label' => [
                        'for' => 'out_text',
                        'class' => 'mdc-text-field__label',
                        'HTML' => 'Продолжить фразу: отдаёте в...'
                     ]
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
