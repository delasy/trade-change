<div class="col-md-8">
    <h1>Обмен <span class="text-light">{{ $curr_out->name . ' ' . $curr_out->curr->name }}</span> на
        <span class="text-light">{{ $curr_in->name . ' ' . $curr_in->curr->name }}</span>
    </h1>

    <form autocomplete="off" method="POST" action="{{ route('exchange') }}">
        {{ csrf_field() }}
        <input type="hidden" name="out" id="PAGE_FORM_OUT_CURRENCY" value="{{ $curr_out->id }}">
        <input type="hidden" name="in" id="PAGE_FORM_IN_CURRENCY" value="{{ $curr_in->id }}">

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="row"><div class="col-md-12"><p class="alert-danger">{{ $error }}</p></div></div>
                @if ($loop->first)
                    @break
                @endif
            @endforeach
        @endif

        <div class="row">
            <div class="col-md-6 form-group tradechange-input with-image">
                <input type="number" class="form-control" id="sourceAmount" name="out_amount" required
                       max="{{ $curr_out->max_val }}" min="{{ $curr_out->min_val }}" step="any">
                <label for="sourceAmount">Отдаете в {{ $curr_out->curr->out_text }}</label>
                <img src="{{ asset($curr_out->img->getPath()) }}">
                <span class="help-block">Мин: -
                    {{ number_format($curr_out->min_val, $curr_out->ch_after_point, '.', ' ') }}
                    | Макс -
                    {{ number_format($curr_out->max_val, $curr_out->ch_after_point, '.', ' ') }}</span>
            </div>

            <div class="col-md-6 form-group tradechange-input with-image">
                <input type="number" class="form-control" id="targetAmount" name="in_amount" required
                       max="{{
                            floatval($curr_in->max_val) > floatval($curr_in->reserve)
                            ? $curr_in->reserve
                            : $curr_in->max_val
                       }}" min="0.0001" step="any">
                <label for="targetAmount">Получаете в {{ $curr_in->curr->out_text }}</label>
                <img src="{{ asset($curr_in->img->getPath()) }}">
                <span class="help-block">Резерв:
                    {{ number_format($curr_in->reserve, $curr_in->ch_after_point, '.', ' ') }}</span>
            </div>
        </div>

        @for ($i = 1; $i < 5; $i++)
            @if ($curr_out->{'field' . $i . '_id'} === NULL && $curr_in->{'field' . $i . '_id'} === NULL)
                @continue;
            @endif
            <div class="row">
                <div class="col-md-6">
                    @if ($curr_out->{'field' . $i . '_id'} !== NULL)
                        <div class="form-group tradechange-input">
                            <input type="text" class="form-control" title="{{ $curr_out->{'field' . $i}->name }}"
                                   id="ex_curr_out_field{{ $i }}"
                                   value="{{ old('ex_curr_out_field' . $i) }}"
                                   name="ex_curr_out_field{{ $i }}" required>
                            <label for="ex_curr_out_field{{ $i }}">{{ $curr_out->{'field' . $i}->name }}</label>
                            @if ($curr_out->{'field' . $i}->html_placeholder !== '')
                                <span class="help-block">
                                    Например: {{ $curr_out->{'field' . $i}->html_placeholder }}
                                </span>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="col-md-6">
                    @if ($curr_in->{'field' . $i . '_id'} !== NULL)
                        <div class="form-group tradechange-input">
                            <input type="text" class="form-control" title="{{ $curr_in->{'field' . $i}->name }}"
                                   id="ex_curr_in_field{{ $i }}"
                                   value="{{ old('ex_curr_in_field' . $i) }}"
                                   name="ex_curr_in_field{{ $i }}" required>
                            <label for="ex_curr_in_field{{ $i }}">{{ $curr_in->{'field' . $i}->name }}</label>
                            @if ($curr_in->{'field' . $i}->html_placeholder !== '')
                                <span class="help-block">
                                    Например: {{ $curr_in->{'field' . $i}->html_placeholder }}
                                </span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        @endfor

        <div class="row">
            <div class="col-md-6 form-group tradechange-input">
                <input type="email" class="form-control" id="user_email" name="user_email" required
                       value="{{ old('user_email') }}">
                <label for="user_email">Электронная почта</label>
                <span class="help-block">Например: test@test.com</span>
            </div>

            <div class="col-md-6 form-group tradechange-input">
                <input type="number" class="form-control" id="user_phone" name="user_phone" required
                       value="{{ old('user_phone') }}">
                <label for="user_phone">Номер телефона</label>
                <span class="help-block">Например: 79012345678</span>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <button class="col-md-12 tradechange-btn btn btn-primary button-loader">Следующий шаг</button>
                <a href="{{ url('/') }}" class="col-md-12 tradechange-link btn btn-link">Изменить направление</a>
            </div>
            <span class="col-md-6 text-help">
                Нажимая кнопку «Следующий шаг» вы подтверждаете свое согласие с
                <a href="{{ route('terms-of-service') }}" target="_blank">Правилами предоставления услуг сервиса
                    Trade-change</a>
            </span>
        </div>
    </form>
</div>

<script>
    window.PAGE_EXCHANGE_CURRENCIES = JSON.parse('@json($currs_json)');
</script>
