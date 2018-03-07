<form method="POST">
    <div class="mdc-layout-grid max-width">
        <div class="mdc-layout-grid__inner">
            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-3"></div>
            <div class="admin-form-card mdc-card mdc-layout-grid__cell mdc-layout-grid__cell--span-6">
                <section class="mdc-card__primary">
                    <h1 class="mdc-card__title mdc-card__title--large">
                        {!! App\Helpers\AppHelper::toHTML($title, $errors) !!}
                    </h1>
                </section>

                @if ($errors->has('backend_error'))
                    <section class="mdc-card__supporting-text" style="color:red">
                        {!! $errors->first('backend_error') !!}
                    </section>
                @endif

                <section class="mdc-card__supporting-text">
                    {!! App\Helpers\AppHelper::toHTML($content, $errors) !!}
                </section>

                <section class="mdc-card__actions">
                    {!! App\Helpers\AppHelper::toHTML($footer, $errors) !!}
                </section>
            </div>
            <div class="mdc-layout-grid__cell mdc-layout-grid__cell--span-3"></div>
        </div>
    </div>
</form>
