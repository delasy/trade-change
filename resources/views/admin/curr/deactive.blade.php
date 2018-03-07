@foreach (\App\Models\Curr::getDeactive() as $curr)
    <div class="admin-statistic-cell mdc-card mdc-layout-grid__cell mdc-layout-grid__cell--span-3">
        <section class="mdc-card__media">
            <h1 class="mdc-card__title mdc-theme--text-secondary-on-primary">{{ $curr->name }}</h1>
        </section>
        <section class="mdc-card__actions">
            <a href="{{ url('/admin/curr/activate/' . $curr->id) }}"
               class="mdc-button mdc-button--compact mdc-card__action mdc-theme--text-secondary-on-primary">
                Из архива
            </a>
        </section>
    </div>
@endforeach
