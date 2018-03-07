<div class="col-md-8 select-direction">
    <div class="row">
        <form method="GET" action="{{ route('exchange') }}" id="PAGE_STEP1_FORM">
            <input type="hidden" name="out" id="PAGE_FORM_OUT_CURRENCY" value="">
            <input type="hidden" name="in" id="PAGE_FORM_IN_CURRENCY" value="">
        </form>
        <div class="col-md-6">
            <h1 class="top-slide-animation-header">Отдаете</h1>
            <ul class="currencies source-currencies">
                @foreach ($ex_currs as $ex_curr)
                    <li class="currency top-slide-animation app-index-out-currencies"
                        id="PAGE_CURRENCY_{{ $ex_curr['id'] }}"
                        onclick="f_CHANGE_PAGE_OUT({{ $ex_curr['id'] }});">
                        <span class="background"></span>
                        <span class="ico"><img src="{{ asset($ex_curr['img']) }}"></span>
                        <span class="ps-name">{{ $ex_curr['full_name'] }}</span>
                        <span class="chevron-right">
                            <img src="{{ asset('images/chevron-right.svg') }}">
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-6">
            <h1 class="top-slide-animation-header">Получаете</h1>
            <ul class="currencies source-currencies" id="PAGE_STEP1_CURRENCY_OUT"></ul>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window.PAGE_CURRENCIES = JSON.parse('@json($ex_currs_json)');
        f_CHANGE_PAGE_OUT({{ $first_ex_curr }});
    </script>
@endpush
