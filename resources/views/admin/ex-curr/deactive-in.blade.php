@foreach (\App\Models\ExCurrIn::getDeactive($curr->id) as $ex_curr_in)
    <div class="admin-statistic-cell mdc-card mdc-layout-grid__cell mdc-layout-grid__cell--span-3">
        <section class="mdc-card__media">
            <h1 class="mdc-card__title mdc-theme--text-secondary-on-primary">
                {{ $ex_curr_in->ex_curr_in->name }} {{ $ex_curr_in->ex_curr_in->curr->name }}
            </h1>
        </section>
        <section class="mdc-card__actions">
            <a href="{{ url('/admin/ex-curr/in/activate/' . $ex_curr_in->id) }}"
               class="mdc-button mdc-button--compact mdc-card__action
                    mdc-theme--text-secondary-on-primary">Из архива</a>
        </section>
    </div>
@endforeach
