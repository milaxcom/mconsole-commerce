<form method="POST" action="{{ mconsole_url(isset($item) ? sprintf('commerce/payment/%s', $item->id) : 'commerce/payment') }}">
    @if (isset($item))@method('PUT')@endif
    @csrf

<div class="row">
    <div class="col-sm-7">
        <div class="portlet light">
            @include('mconsole::partials.portlet-title', [
                'back' => mconsole_url('commerce/payment'),
                'title' => trans('mconsole::commerce.payment.tabs.main'),
            ])
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="row">
                        <div class="col-sm-6">
                            @if(isset($item))
                                @include('mconsole::forms.hidden', [
                                    'name' => 'type',
                                    'value' => $item->type ?? null,
                                ])
                            @else
                                @include('mconsole::forms.select', [
                                    'label' => trans('mconsole::commerce.payment.form.type'),
                                    'name' => 'type',
                                    'options' => [
                                        'robokassa' => 'Robokassa',
                                        'yookassa' => 'Yookassa',
                                    ],
                                    'value' => $item->type ?? null,
                                ])
                            @endif
                            @include('mconsole::forms.text', [
                                'label' => trans('mconsole::commerce.payment.form.name'),
                                'name' => 'name',
                                'value' => $item->name ?? null,
                            ])
                            <div class="row">
                                <div class="col-sm-6">
                                    @include('mconsole::forms.text', [
                                        'label' => trans('mconsole::commerce.payment.form.commission'),
                                        'name' => 'commission',
                                        'value' => $item->commission ?? null,
                                    ])
                                </div>
                                <div class="col-sm-6">
                                    @include('mconsole::forms.select', [
                                        'label' => trans('mconsole::commerce.payment.form.commission_type'),
                                        'name' => 'commission_type',
                                        'options' => [
                                            'percent' => '%',
                                            'currency' => 'currency',
                                        ],
                                        'value' => $item->commission_type ?? null,
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('mconsole::forms.textarea', [
                        'label' => trans('mconsole::commerce.payment.form.description'),
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
    @if(isset($item))
        <div class="col-sm-5">
            <div class="portlet light">
                @include('mconsole::partials.portlet-title', [
                    'title' => trans('mconsole::commerce.payment.tabs.settings'),
                ])
                <div class="portlet-body form">
                    <div class="form-body">
                        @include(sprintf('mconsole::commerce.payment.providers.%s', $item->type))
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

</form>