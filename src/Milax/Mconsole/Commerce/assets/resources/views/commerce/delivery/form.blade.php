@if (isset($item))
    {!! Form::model($item, ['method' => 'PUT', 'route' => ['mconsole.commerce.delivery.update', $item->id]]) !!}
@else
    {!! Form::open(['method' => 'POST', 'route' => 'mconsole.commerce.delivery']) !!}
@endif

<div class="row">
    <div class="col-sm-7">
        <div class="portlet light">
            @include('mconsole::partials.portlet-title', [
                'back' => '/mconsole/commerce/delivery',
                'title' => trans('mconsole::commerce.delivery.tabs.main'),
            ])
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="row">
                        <div class="col-sm-6">
                            @include('mconsole::forms.text', [
                                'label' => trans('mconsole::commerce.delivery.form.name'),
                                'name' => 'name',
                            ])
                        </div>
                        <div class="col-sm-6">
                            @include('mconsole::forms.text', [
                                'label' => trans('mconsole::commerce.delivery.form.cost'),
                                'name' => 'cost',
                            ])
                        </div>
                    </div>
                    @include('mconsole::forms.textarea', [
                        'label' => trans('mconsole::commerce.delivery.form.description'),
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
</div>

{!! Form::close() !!}