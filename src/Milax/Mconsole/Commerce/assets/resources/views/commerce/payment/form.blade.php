@if (isset($item))
    {!! Form::model($item, ['method' => 'PUT', 'url' => mconsole_url(sprintf('commerce/payment/%s', $item->id))]) !!}
@else
    {!! Form::open(['method' => 'POST', 'url' => mconsole_url('commerce/payment')]) !!}
@endif

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
                                ])
                            @else
                                @include('mconsole::forms.select', [
                                    'label' => trans('mconsole::commerce.payment.form.type'),
                                    'name' => 'type',
                                    'options' => [
                                        'robokassa' => 'Robokassa',
                                        'yandexmoney' => 'Yandex.money',
                                    ],
                                ])
                            @endif
                            @include('mconsole::forms.text', [
                                'label' => trans('mconsole::commerce.payment.form.name'),
                                'name' => 'name',
                            ])
                            <div class="row">
                                <div class="col-sm-6">
                                    @include('mconsole::forms.text', [
                                        'label' => trans('mconsole::commerce.payment.form.commission'),
                                        'name' => 'commission',
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
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('mconsole::forms.textarea', [
                        'label' => trans('mconsole::commerce.payment.form.description'),
                        'name' => 'description',
                        'size' => '10x3',
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

{!! Form::close() !!}