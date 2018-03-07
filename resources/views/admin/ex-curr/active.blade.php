@foreach (\App\Models\ExCurr::getActive() as $ex_curr)
    <div class="admin-statistic-cell mdc-card mdc-layout-grid__cell mdc-layout-grid__cell--span-3">
        <section class="mdc-card__media">
            <h1 class="mdc-card__title mdc-theme--text-secondary-on-primary">
                {{ $ex_curr->name }} {{ $ex_curr->curr->name }}
            </h1>
        </section>
        <section class="mdc-card__actions">
            <a href="{{ url('/admin/ex-curr/edit/' . $ex_curr->id) }}"
               class="mdc-button mdc-button--compact mdc-card__action
                                mdc-theme--text-secondary-on-primary">Изменить</a>
            <a href="{{ url('/admin/ex-curr/deactivate/' . $ex_curr->id) }}"
               class="mdc-button mdc-button--compact mdc-card__action
                                mdc-theme--text-secondary-on-primary">В архив</a>
        </section>
    </div>
@endforeach
