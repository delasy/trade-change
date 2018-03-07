@extends('layouts.admin')

@section('page-title', 'Редактирование обмена валюты')

@section('content')
    @include('admin/form', [
        'title' => 'Редактирование обмена валюты',
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
                        'value' => $curr->name
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
                        'value' => $curr->min_val,
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
                        'value' => $curr->max_val,
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
                        'value' => $curr->reserve,
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
                        'value' => $curr->ch_after_point,
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
                        'value' => $curr->ex_out_rate,
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
                        'value' => $curr->ex_in_rate,
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
                            \App\Models\Curr::getActive(),
                            'Выберите валюту',
                            $curr->curr_id,
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
                            \App\Models\CurrImg::getActive(),
                            'Выберите картинку валюты обмена',
                            $curr->curr_img_id,
                            'id',
                            'name'
                        )
                    ],
                    'div' => ['class' => 'mdc-select__bottom-line']
                ]
            ],
            'div4' => [
                'class' => 'mdc-select',
                'style' => 'width:49%;vertical-align:top;margin-right:2%',
                'if' => (intval($curr->field1_id) <= 0),
                'HTML' => [
                    'select' => [
                        'class' => 'mdc-select__surface',
                        'name' => 'field1_id',
                        'HTML' => App\Helpers\AppHelper::toSelectOptions(
                            \App\Models\CurrInput::getActive(),
                            'Выберите поле №1',
                            old('field1_id'),
                            'id',
                            'name'
                        )
                    ],
                    'div' => ['class' => 'mdc-select__bottom-line']
                ]
            ],
            'div94' => [
                'class' => 'mdc-text-field',
                'data-mdc-auto-init' => 'MDCTextField',
                'style' => 'width:49%;height:56px;margin:0;margin-right:2%',
                'if' => (intval($curr->field1_id) > 0),
                'HTML' => [
                    'input' => [
                        'class' => 'mdc-text-field__input',
                        'disabled',
                        'id' => 'field1_id',
                        'value' => $curr->field1 ? $curr->field1->name : 'Возникла ошибка',
                     ],
                     'label' => [
                        'for' => 'field1_id',
                        'class' => 'mdc-text-field__label',
                        'HTML' => 'Поле №1'
                     ],
                     'div' => ['class' => 'mdc-text-field__bottom-line']
                ]
            ],
            'div5' => [
                'class' => 'mdc-select',
                'style' => 'width:49%;vertical-align:top',
                'if' => (intval($curr->field2_id) <= 0),
                'HTML' => [
                    'select' => [
                        'class' => 'mdc-select__surface',
                        'name' => 'field2_id',
                        'HTML' => App\Helpers\AppHelper::toSelectOptions(
                            \App\Models\CurrInput::getActive(),
                            'Выберите поле №2',
                            old('field2_id'),
                            'id',
                            'name'
                        )
                    ],
                    'div' => ['class' => 'mdc-select__bottom-line']
                ]
            ],
            'div95' => [
                'class' => 'mdc-text-field',
                'data-mdc-auto-init' => 'MDCTextField',
                'style' => 'width:49%;height:56px;margin:0',
                'if' => (intval($curr->field2_id) > 0),
                'HTML' => [
                    'input' => [
                        'class' => 'mdc-text-field__input',
                        'disabled',
                        'id' => 'field2_id',
                        'value' => $curr->field2 ? $curr->field2->name : 'Возникла ошибка',
                     ],
                     'label' => [
                        'for' => 'field2_id',
                        'class' => 'mdc-text-field__label',
                        'HTML' => 'Поле №2'
                     ],
                     'div' => ['class' => 'mdc-text-field__bottom-line']
                ]
            ],
            'div6' => [
                'class' => 'mdc-select',
                'style' => 'width:49%;vertical-align:top;margin-right:2%',
                'if' => (intval($curr->field3_id) <= 0),
                'HTML' => [
                    'select' => [
                        'class' => 'mdc-select__surface',
                        'name' => 'field3_id',
                        'HTML' => App\Helpers\AppHelper::toSelectOptions(
                            \App\Models\CurrInput::getActive(),
                            'Выберите поле №3',
                            old('field3_id'),
                            'id',
                            'name'
                        )
                    ],
                    'div' => ['class' => 'mdc-select__bottom-line']
                ]
            ],
            'div96' => [
                'class' => 'mdc-text-field',
                'data-mdc-auto-init' => 'MDCTextField',
                'style' => 'width:49%;height:56px;margin:0;margin-right:2%',
                'if' => (intval($curr->field3_id) > 0),
                'HTML' => [
                    'input' => [
                        'class' => 'mdc-text-field__input',
                        'disabled',
                        'id' => 'field3_id',
                        'value' => $curr->field3 ? $curr->field3->name : 'Возникла ошибка',
                     ],
                     'label' => [
                        'for' => 'field3_id',
                        'class' => 'mdc-text-field__label',
                        'HTML' => 'Поле №3'
                     ],
                     'div' => ['class' => 'mdc-text-field__bottom-line']
                ]
            ],
            'div7' => [
                'class' => 'mdc-select',
                'style' => 'width:49%;vertical-align:top',
                'if' => (intval($curr->field4_id) <= 0),
                'HTML' => [
                    'select' => [
                        'class' => 'mdc-select__surface',
                        'name' => 'field4_id',
                        'HTML' => App\Helpers\AppHelper::toSelectOptions(
                            \App\Models\CurrInput::getActive(),
                            'Выберите поле №4',
                            old('field4_id'),
                            'id',
                            'name'
                        )
                    ],
                    'div' => ['class' => 'mdc-select__bottom-line']
                ]
            ],
            'div97' => [
                'class' => 'mdc-text-field',
                'data-mdc-auto-init' => 'MDCTextField',
                'style' => 'width:49%;height:56px;margin:0',
                'if' => (intval($curr->field4_id) > 0),
                'HTML' => [
                    'input' => [
                        'class' => 'mdc-text-field__input',
                        'disabled',
                        'id' => 'field4_id',
                        'value' => $curr->field4 ? $curr->field4->name : 'Возникла ошибка',
                     ],
                     'label' => [
                        'for' => 'field4_id',
                        'class' => 'mdc-text-field__label',
                        'HTML' => 'Поле №4'
                     ],
                     'div' => ['class' => 'mdc-text-field__bottom-line']
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

    <nav class="mdc-tab-bar" style="margin:30px auto 20px;" id="ex_currs_in">
        <a class="mdc-tab @if (!isset($deactive))mdc-tab--active @endif"
           href="{{ url('admin/ex-curr/edit/' . $curr->id) }}#ex_currs_in">Все</a>
        <a class="mdc-tab @if (isset($deactive))mdc-tab--active @endif"
           href="{{ url('admin/ex-curr/edit/' . $curr->id . '/deactivated') }}#ex_currs_in">
            Архивированные ({{ \App\Models\ExCurrIn::getDeactiveCount($curr->id) }})
        </a>
        <span class="mdc-tab-bar__indicator"></span>
    </nav>

    <div class="mdc-layout-grid max-width" style="margin-top:20px;">
        <div class="admin-statistic-grid mdc-layout-grid__inner">
            <div class="admin-statistic-cell mdc-card mdc-layout-grid__cell mdc-layout-grid__cell--span-3">
                <section class="mdc-card__media">
                    <h1 class="mdc-card__title mdc-theme--text-secondary-on-primary">Валюта получения</h1>
                </section>
                <section class="mdc-card__actions">
                    <a href="{{ url('/admin/ex-curr/in/add/' . $curr->id) }}"
                       class="mdc-button mdc-button--compact mdc-card__action
                            mdc-theme--text-secondary-on-primary">Добавить</a>
                </section>
            </div>

            @if (!\App\Models\ExCurrIn::getAnyCount($curr->id) && !isset($deactive))
                <div class="admin-statistic-cell mdc-card mdc-layout-grid__cell mdc-layout-grid__cell--span-3">
                    <section class="mdc-card__media">
                        <h1 class="mdc-card__title mdc-theme--text-secondary-on-primary">Валюта получения</h1>
                    </section>
                    <section class="mdc-card__actions">
                        <a href="{{ url('/admin/ex-curr/in/add-all/' . $curr->id) }}"
                           class="mdc-button mdc-button--compact mdc-card__action
                           mdc-theme--text-secondary-on-primary">Добавить все</a>
                    </section>
                </div>
            @endif

            @if (!isset($deactive))
                @include('admin/ex-curr/active-in')
            @else
                @include('admin/ex-curr/deactive-in')
            @endif
        </div>
    </div>
@endsection
