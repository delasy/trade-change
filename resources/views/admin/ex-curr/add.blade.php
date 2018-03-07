@extends('layouts.admin')

@section('page-title', 'Добавление обмена валюты')

@section('content')
    @include('admin/form', [
        'title' => 'Добавление обмена валюты',
        'content' => [
            'raw' => csrf_field(),
            'div' => [
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
                        'HTML' => 'Введите название обмена валюты'
                     ],
                     'div' => ['class' => 'mdc-text-field__bottom-line']
                ]
            ],
            'div100' => [
                'class' => 'mdc-text-field',
                'data-mdc-auto-init' => 'MDCTextField',
                'style' => 'width:49%;margin-right:2%',
                'HTML' => [
                    'input' => [
                        'name' => 'min_val',
                        'required',
                        'class' => 'mdc-text-field__input',
                        'id' => 'min_val',
                        'value' => old('min_val'),
                        'type' => 'number',
                        'step' => 'any'
                     ],
                     'label' => [
                        'for' => 'min_val',
                        'class' => 'mdc-text-field__label',
                        'HTML' => 'Введите мин. кол-во валюты'
                     ],
                     'div' => ['class' => 'mdc-text-field__bottom-line']
                ]
            ],
            'div101' => [
                'class' => 'mdc-text-field',
                'data-mdc-auto-init' => 'MDCTextField',
                'style' => 'width:49%',
                'HTML' => [
                    'input' => [
                        'name' => 'max_val',
                        'required',
                        'class' => 'mdc-text-field__input',
                        'id' => 'max_val',
                        'value' => old('max_val'),
                        'type' => 'number',
                        'step' => 'any'
                     ],
                     'label' => [
                        'for' => 'max_val',
                        'class' => 'mdc-text-field__label',
                        'HTML' => 'Введите макс. кол-во валюты'
                     ],
                     'div' => ['class' => 'mdc-text-field__bottom-line']
                ]
            ],
            'div102' => [
                'class' => 'mdc-text-field',
                'data-mdc-auto-init' => 'MDCTextField',
                'style' => 'width:49%;margin-right:2%',
                'HTML' => [
                    'input' => [
                        'name' => 'reserve',
                        'required',
                        'class' => 'mdc-text-field__input',
                        'id' => 'reserve',
                        'value' => old('reserve'),
                        'type' => 'number',
                        'step' => 'any'
                     ],
                     'label' => [
                        'for' => 'reserve',
                        'class' => 'mdc-text-field__label',
                        'HTML' => 'Укажите резерв валюты'
                     ],
                     'div' => ['class' => 'mdc-text-field__bottom-line']
                ]
            ],
            'div1021' => [
                'class' => 'mdc-text-field',
                'data-mdc-auto-init' => 'MDCTextField',
                'style' => 'width:49%',
                'HTML' => [
                    'input' => [
                        'name' => 'ch_after_point',
                        'required',
                        'class' => 'mdc-text-field__input',
                        'id' => 'ch_after_point',
                        'value' => old('ch_after_point'),
                        'type' => 'number',
                        'step' => 'any'
                     ],
                     'label' => [
                        'for' => 'ch_after_point',
                        'class' => 'mdc-text-field__label',
                        'HTML' => 'Знаков после запятой'
                     ],
                     'div' => ['class' => 'mdc-text-field__bottom-line']
                ]
            ],
            'div103' => [
                'class' => 'mdc-text-field',
                'data-mdc-auto-init' => 'MDCTextField',
                'style' => 'width:49%;margin-right:2%',
                'HTML' => [
                    'input' => [
                        'name' => 'ex_out_rate',
                        'required',
                        'class' => 'mdc-text-field__input',
                        'id' => 'ex_out_rate',
                        'value' => old('ex_out_rate'),
                        'type' => 'number',
                        'step' => 'any'
                     ],
                     'label' => [
                        'for' => 'ex_out_rate',
                        'class' => 'mdc-text-field__label',
                        'HTML' => 'Укажите курс продажи'
                     ],
                     'div' => ['class' => 'mdc-text-field__bottom-line']
                ]
            ],
            'div104' => [
                'class' => 'mdc-text-field',
                'data-mdc-auto-init' => 'MDCTextField',
                'style' => 'width:49%',
                'HTML' => [
                    'input' => [
                        'name' => 'ex_in_rate',
                        'required',
                        'class' => 'mdc-text-field__input',
                        'id' => 'ex_in_rate',
                        'value' => old('ex_in_rate'),
                        'type' => 'number',
                        'step' => 'any'
                     ],
                     'label' => [
                        'for' => 'ex_in_rate',
                        'class' => 'mdc-text-field__label',
                        'HTML' => 'Укажите курс покупки'
                     ],
                     'div' => ['class' => 'mdc-text-field__bottom-line']
                ]
            ],
            'div2' => [
                'class' => 'mdc-select',
                'style' => 'width:100%',
                'HTML' => [
                    'select' => [
                        'class' => 'mdc-select__surface',
                        'required',
                        'name' => 'curr_id',
                        'HTML' => App\Helpers\AppHelper::toSelectOptions(
                            $currs,
                            'Выберите валюту',
                            old('curr_id'),
                            'id',
                            'name'
                        )
                    ],
                    'div' => ['class' => 'mdc-select__bottom-line']
                ]
            ],
            'div3' => [
                'class' => 'mdc-select',
                'style' => 'width:100%',
                'HTML' => [
                    'select' => [
                        'class' => 'mdc-select__surface',
                        'required',
                        'name' => 'curr_img_id',
                        'HTML' => App\Helpers\AppHelper::toSelectOptions(
                            $currs_imgs,
                            'Выберите картинку валюты обмена',
                            old('curr_img_id'),
                            'id',
                            'name'
                        )
                    ],
                    'div' => ['class' => 'mdc-select__bottom-line']
                ]
            ],
            'div4' => [
                'class' => 'mdc-select',
                'style' => 'width:49%;margin-right:2%',
                'HTML' => [
                    'select' => [
                        'class' => 'mdc-select__surface',
                        'name' => 'field1_id',
                        'HTML' => App\Helpers\AppHelper::toSelectOptions(
                            $currs_inputs,
                            'Выберите поле №1',
                            old('field1_id'),
                            'id',
                            'name'
                        )
                    ],
                    'div' => ['class' => 'mdc-select__bottom-line']
                ]
            ],
            'div5' => [
                'class' => 'mdc-select',
                'style' => 'width:49%',
                'HTML' => [
                    'select' => [
                        'class' => 'mdc-select__surface',
                        'name' => 'field2_id',
                        'HTML' => App\Helpers\AppHelper::toSelectOptions(
                            $currs_inputs,
                            'Выберите поле №2',
                            old('field2_id'),
                            'id',
                            'name'
                        )
                    ],
                    'div' => ['class' => 'mdc-select__bottom-line']
                ]
            ],
            'div6' => [
                'class' => 'mdc-select',
                'style' => 'width:49%;margin-right:2%',
                'HTML' => [
                    'select' => [
                        'class' => 'mdc-select__surface',
                        'name' => 'field3_id',
                        'HTML' => App\Helpers\AppHelper::toSelectOptions(
                            $currs_inputs,
                            'Выберите поле №3',
                            old('field3_id'),
                            'id',
                            'name'
                        )
                    ],
                    'div' => ['class' => 'mdc-select__bottom-line']
                ]
            ],
            'div7' => [
                'class' => 'mdc-select',
                'style' => 'width:49%',
                'HTML' => [
                    'select' => [
                        'class' => 'mdc-select__surface',
                        'name' => 'field4_id',
                        'HTML' => App\Helpers\AppHelper::toSelectOptions(
                            $currs_inputs,
                            'Выберите поле №4',
                            old('field4_id'),
                            'id',
                            'name'
                        )
                    ],
                    'div' => ['class' => 'mdc-select__bottom-line']
                ]
            ],
            'p' => [
                'style' => 'color:red;margin-top:10px',
                'HTML' => 'Будьте внимательны при выборе полей валюты. После сохранения их изменить уже нельзя.'
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
