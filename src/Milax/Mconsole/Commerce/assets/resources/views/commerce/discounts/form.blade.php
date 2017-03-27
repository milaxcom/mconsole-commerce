@if (isset($item))
    {!! Form::model($item, ['method' => 'PUT', 'url' => mconsole_url(sprintf('commerce/discounts/%s', $item->id))]) !!}
@else
    {!! Form::open(['method' => 'POST', 'url' => mconsole_url('commerce/discounts')]) !!}
@endif

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
                            ])
                        </div>
                        <div class="col-sm-6">
@include('mconsole::forms.select', [
    'type' => MconsoleFormSelectType::YesNo,
    'label' => trans('mconsole::commerce.discounts.form.accumulative'),
    'name' => 'accumulative',
])
                        </div>
                    </div>
                    @include('mconsole::forms.textarea', [
                        'label' => trans('mconsole::commerce.discounts.form.description'),
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
                                            'name' => null,
                                            'class' => 'discount-sum',
                                            'placeholder' => trans('mconsole::commerce.discounts.form.sum'),
                                        ])
                                    </div>
                                    <div class="col-sm-6">
                                        @include('mconsole::forms.text', [
                                            'label' => null,
                                            'name' => null,
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

{!! Form::close() !!}