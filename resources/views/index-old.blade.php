@extends('layouts.app-old')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="exchange-progress">
                    <li>
                        @if ($step === 1)
                            <div class="exchange-progress-step">
                                <div class="exchange-progress-step active">
                                    <img src="{{ asset('images/step-cycle-active.svg') }}">
                                    <span>1</span>
                                    <div>Выберите направление обмена</div>
                                </div>
                            </div>
                        @else
                            <div class="exchange-progress-step done">
                                <img src="{{ asset('images/step-cycle-done.svg') }}">
                                <span><img src="{{ asset('images/step-check.svg') }}"></span>
                                <div>Выберите направление обмена</div>
                            </div>
                        @endif
                    </li>
                    <li>
                        @if ($step < 2)
                            <div class="exchange-progress-step">
                                <div class="exchange-progress-step text-muted">
                                    <img src="{{ asset('images/step-cycle-inactive.svg') }}">
                                    <span>2</span>
                                    <div>Платежная информация</div>
                                </div>
                            </div>
                        @elseif ($step === 2)
                            <div class="exchange-progress-step">
                                <div class="exchange-progress-step active">
                                    <img src="{{ asset('images/step-cycle-active.svg') }}">
                                    <span>2</span>
                                    <div>Платежная информация</div>
                                </div>
                            </div>
                        @elseif ($step > 2)
                            <div class="exchange-progress-step done">
                                <img src="{{ asset('images/step-cycle-done.svg') }}">
                                <span><img src="{{ asset('images/step-check.svg') }}"></span>
                                <div>Платежная информация</div>
                            </div>
                        @endif
                    </li>
                    <li>
                        @if ($step < 3)
                            <div class="exchange-progress-step">
                                <div class="exchange-progress-step text-muted">
                                    <img src="{{ asset('images/step-cycle-inactive.svg') }}">
                                    <span>3</span>
                                    <div>Подтверждение, оплата</div>
                                </div>
                            </div>
                        @elseif ($step === 3)
                            <div class="exchange-progress-step">
                                <div class="exchange-progress-step active">
                                    <img src="{{ asset('images/step-cycle-active.svg') }}">
                                    <span>3</span>
                                    @if (isset($with_ex_order))
                                        <div>Формирование заказа</div>
                                    @else
                                        <div>Подтверждение, оплата</div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </li>
                </ul>
            </div>

            <div class="col-md-9">
                <div class="row">
                    @if ($step === 1)
                        @include ('index-step1-old')
                    @elseif ($step === 2)
                        @include ('index-step2-old')
                    @elseif ($step === 3 && isset($with_ex_order))
                        @include ('index-step2_3-old')
                    @elseif ($step === 3)
                        @include ('index-step3-old')
                    @endif

                    <div class="col-md-offset-1 col-md-3">
                        <div class="tradechange-statistics">
                            <ul class="statistics">
                                <li>
                                    <div class="value">0$</div>
                                    <div class="text-muted name">Оборот за 24 часа</div>
                                </li>
                                <li>
                                    <div class="value">{{ \App\Models\ExCurr::getReserves() }}</div>
                                    <div class="text-muted name">Резервы</div>
                                </li>
                                <li>
                                    <div class="value">2017</div>
                                    <div class="text-muted name">Год основания</div>
                                </li>
                            </ul>
                        </div>
                        <br>

                        <!--<a href="#" target="_blank">Отзывы на Bestchange</a>-->

                        <div class="last-exchanges">
                            <h4>Последние обмены</h4>
                            <div class="tradechange-transactions">
                                <div class="exchanges-container">
                                    <div class="exchange exchange-first">
                                        <div class="icons">
                                            <img src="{{ asset('images/currency/ripple.svg') }}">
                                            <span>→</span>
                                            <img src="{{ asset('images/currency/privat24.svg') }}">
                                        </div>
                                        <div class="rate">404.64 ₽ = 179.71 UAH</div>
                                        <div class="datetime">19.12.2017 17:15</div>
                                    </div>
                                    <div class="exchange exchange-second">
                                        <div class="icons">
                                            <img src="{{ asset('images/currency/ripple.svg') }}">
                                            <span>→</span>
                                            <img src="{{ asset('images/currency/privat24.svg') }}">
                                        </div>
                                        <div class="rate">4 $ = 109.43 UAH</div>
                                        <div class="datetime">19.12.2017 17:13</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
