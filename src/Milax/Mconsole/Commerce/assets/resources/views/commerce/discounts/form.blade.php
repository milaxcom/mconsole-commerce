<form method="POST" action="{{ mconsole_url(isset($item) ? sprintf('commerce/discounts/%s', $item->id) : 'commerce/discounts') }}">
    @if (isset($item))@method('PUT')@endif
    @csrf

<div id="discounts-editor" class="row">
    <div class="col-sm-6">
        <div class="portlet light">
            @include('mconsole::partials.portlet-title', [
                'back' => mconsole_url('commerce/discounts'),
                'title' => trans('mconsole::commerce.discounts.tabs.main'),
            ])
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="row">
                        <div class="col-sm-6">
                            @include('mconsole::forms.text', [
                                'label' => trans('mconsole::commerce.discounts.form.name'),
                                'name' => 'name',
                                'value' => $item->name ?? null,
                            ])
                        </div>
                        <div class="col-sm-6">
                            @include('mconsole::forms.select', [
                                'type' => MconsoleFormSelectType::YesNo,
                                'label' => trans('mconsole::commerce.discounts.form.accumulative'),
                                'name' => 'accumulative',
                                'value' => $item->accumulative ?? null,
                            ])
                        </div>
                    </div>
                    @include('mconsole::forms.textarea', [
                        'label' => trans('mconsole::commerce.discounts.form.description'),
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
    <div class="col-sm-6">
        <div class="portlet light">
            @include('mconsole::partials.portlet-title', [
                'title' => trans('mconsole::commerce.discounts.tabs.discounts'),
            ])
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="discount-template hide">
                                <div class="row">
                                    <div class="col-sm-6">
                                        @include('mconsole::forms.text', [
                                            'label' => null,
                                            'name' => 'sum',
                                            'class' => 'discount-sum',
                                            'placeholder' => trans('mconsole::commerce.discounts.form.sum'),
                                        ])
                                    </div>
                                    <div class="col-sm-6">
                                        @include('mconsole::forms.text', [
                                            'label' => null,
                                            'name' => 'discount_value',
                                            'class' => 'discount-value',
                                            'placeholder' => trans('mconsole::commerce.discounts.form.discount'),
                                        ])
                                    </div>
                                    <div class="col-xs-12 text-right"><a href="#" class="btn btn-xs btn-danger remove-discount">{{ trans('mconsole::commerce.discounts.form.remove') }}</a></div>
                                </div>
                            </div>
                            <div class="discounts"></div>
                            <div class="btn btn-sm blue append-discount">{{ trans('mconsole::commerce.discounts.form.append') }}</div>
                            @include('mconsole::forms.hidden', [
                                'name' => 'discounts',
                                'value' => isset($item) ? json_encode($item->discounts) : null,
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</form>