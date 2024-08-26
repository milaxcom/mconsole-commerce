<form method="POST" action="{{ mconsole_url(isset($item) ? sprintf('commerce/delivery/%s', $item->id) : 'commerce/delivery') }}">
    @if (isset($item))@method('PUT')@endif
    @csrf

<div class="row">
    <div class="col-sm-7">
        <div class="portlet light">
            @include('mconsole::partials.portlet-title', [
                'back' => mconsole_url('commerce/delivery'),
                'title' => trans('mconsole::commerce.delivery.tabs.main'),
            ])
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="row">
                        <div class="col-sm-6">
                            @include('mconsole::forms.text', [
                                'label' => trans('mconsole::commerce.delivery.form.name'),
                                'name' => 'name',
                                'value' => $item->name ?? null,
                            ])
                        </div>
                        <div class="col-sm-6">
                            @include('mconsole::forms.text', [
                                'label' => trans('mconsole::commerce.delivery.form.cost'),
                                'name' => 'cost',
                                'value' => $item->cost ?? null,
                            ])
                        </div>
                    </div>
                    @include('mconsole::forms.textarea', [
                        'label' => trans('mconsole::commerce.delivery.form.description'),
                        'name' => 'description',
                        'size' => '10x3',
                        'value' => $item->description ?? null,
                    ])
                </div>
                <div class="form-actions">
                    @include('mconsole::forms.submit')
                </div>
            </div>
        </div>
    </div>
</div>

</form>