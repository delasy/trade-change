<div class="col-md-8">
    <div>
        <div class="row transaction">
            <div>
                <div class="col-md-12">
                    <div class="info" style="margin-bottom:40px;">
                        <div class="h3">
                            <img src="{{ asset('images/alert.svg') }}" style="height:30px;">
                            Что если время закончилось, а оплатить не успел?
                        </div>

                        <div class="clearfix"></div>

                        <p>
                            В соответствии с
                            <a href="{{ route('terms-of-service') }}" target="_blank">Правилами предоставления услуг</a>
                            по истечении этого времени заявка будет отменена.<br>После нажатия на кнопку
                            «Оплатить» Вы будете автоматически перенаправлены на страницу оплаты платежной
                            системы, где, следуя простым указаниям, сможете совершить оплату.<br><br>
                            Успешно оплатили заявку — автоматически вернетесь назад. Обмен будет завершен.
                        </p>
                    </div>

                    <h1>
                        Ожидание оплаты по заявке
                        <span class="text-light">
                            №{{ $ex_order->id }} от
                            {{ \DateTime::createFromFormat('Y-m-d H:i:s', $ex_order->created_at)->format('Y-m-d') }}
                        </span>
                    </h1>

                    <br>

                    <p>
                        Для успешного завершения обмена необходимо оплатить
                        <strong class="text-important">
                            {{
                                number_format(
                                    $ex_order->ex_curr_out_sum,
                                    $ex_order->ex_curr_out->ch_after_point,
                                    '.',
                                    ' '
                                )
                            }}
                            {{ $ex_order->ex_curr_out->curr->name }}
                        </strong>
                        в платежной системе
                    </p>

                    <div>
                        Совершите перевод до окончания таймера
                        <div class="timer">13:05</div>
                    </div>

                    <hr>

                    <h2>Проверьте данные заявки:</h2>
                    <div>
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Курс обмена</label>
                                <div class="col-md-9">
                                    <p class="form-control-static">2.2121 ₽ : 1 UAH</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Отдаете</label>

                                <div class="col-md-9">
                                    <p class="form-control-static">
                                        <strong>999.51 RUB</strong>
                                    </p>
                                    <p class="help-block">Яндекс.Деньги 410013123446789</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Получаете</label>
                                <div class="col-md-9">
                                    <p class="form-control-static"><strong>452.06 UAH</strong></p>
                                    <p class="help-block">Приват24 UAH 1111222233334444</p>
                                </div>
                            </div>
                        </form>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-primary tradechange-btn button-loader full-width">
                                <div class="button-loader-spinner">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="30px"
                                         viewBox="0 0 24 30" xml:space="preserve">

                                        <rect x="0" y="10.3333" width="4" height="10.3333">
                                            <animate attributeName="height" attributeType="XML" values="5;21;5"
                                                     begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
                                            <animate attributeName="y" attributeType="XML" values="13; 5; 13"
                                                     begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
                                        </rect>

                                        <rect x="10" y="6.33333" width="4" height="18.3333">
                                            <animate attributeName="height" attributeType="XML" values="5;21;5"
                                                     begin="0.15s" dur="0.6s"
                                                     repeatCount="indefinite"></animate>
                                            <animate attributeName="y" attributeType="XML" values="13; 5; 13"
                                                     begin="0.15s" dur="0.6s"
                                                     repeatCount="indefinite"></animate>
                                        </rect>
                                        <rect x="20" y="7.66667" width="4" height="15.6667">
                                            <animate attributeName="height" attributeType="XML" values="5;21;5"
                                                     begin="0.3s" dur="0.6s"
                                                     repeatCount="indefinite"></animate>
                                            <animate attributeName="y" attributeType="XML" values="13; 5; 13"
                                                     begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>
                                        </rect>
                                    </svg>
                                </div>
                                <span class="button-loader-content">Оплатить</span>
                            </button>
                        </div>

                        <div class="col-md-6">
                            <button class="btn pull-right tradechange-btn button-cancel button-loader">
                                <div class="button-loader-spinner">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="30px"
                                         viewBox="0 0 24 30" xml:space="preserve">

                                        <rect x="0" y="10.3333" width="4" height="10.3333">
                                            <animate attributeName="height" attributeType="XML" values="5;21;5"
                                                     begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
                                            <animate attributeName="y" attributeType="XML" values="13; 5; 13"
                                                     begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
                                        </rect>

                                        <rect x="10" y="6.33333" width="4" height="18.3333">
                                            <animate attributeName="height" attributeType="XML" values="5;21;5"
                                                     begin="0.15s" dur="0.6s"
                                                     repeatCount="indefinite"></animate>
                                            <animate attributeName="y" attributeType="XML" values="13; 5; 13"
                                                     begin="0.15s" dur="0.6s"
                                                     repeatCount="indefinite"></animate>
                                        </rect>

                                        <rect x="20" y="7.66667" width="4" height="15.6667">
                                            <animate attributeName="height" attributeType="XML" values="5;21;5"
                                                     begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>
                                            <animate attributeName="y" attributeType="XML" values="13; 5; 13"
                                                     begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>
                                        </rect>
                                    </svg>
                                </div>

                                <div class="button-loader-content">Отказаться</div>
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
