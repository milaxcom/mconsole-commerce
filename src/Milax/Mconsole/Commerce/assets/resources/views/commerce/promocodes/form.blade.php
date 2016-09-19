@if (isset($item))
    {!! Form::model($item, ['method' => 'PUT', 'url' => mconsole_url(sprintf('commerce/promocodes/%s', $item->id))]) !!}
@else
    {!! Form::open(['method' => 'POST', 'url' => mconsole_url('commerce/promocodes')]) !!}
@endif

<div class="row">
	<div class="col-lg-7 col-md-6">
        <div class="portlet light">
            @include('mconsole::partials.portlet-title', [
                'back' => mconsole_url('commerce/promocodes'),
                'title' => trans('mconsole::commerce.promocodes.tabs.main'),
                'fullscreen' => true,
            ])
            <div class="portlet-body form">
    			<div class="form-body">
                    @if (isset($item))
                        <div class="form-group">
                            <label>{{ trans('mconsole::commerce.promocodes.form.code') }}</label>
                            <div><code>{{ $item->code }}</code></div>
                            <input type="hidden" name="code" value="{{ $item->code }}" />
                        </div>
                    @else
                        @include('mconsole::forms.text', [
                            'label' => trans('mconsole::commerce.promocodes.form.code'),
                            'name' => 'code',
                        ])
                    @endif
                    <div class="row">
                        <div class="col-xs-6">
                            @include('mconsole::forms.select', [
                                'label' => trans('mconsole::commerce.promocodes.form.type'),
                                'name' => 'type',
                                'options' => [
                                    'perc' => trans('mconsole::commerce.promocodes.type.percent'),
                                    'amount' => trans('mconsole::commerce.promocodes.type.amount'),
                                ],
                            ])
                        </div>
                        <div class="col-xs-6">
                            @include('mconsole::forms.text', [
                                'label' => trans('mconsole::commerce.promocodes.form.amount'),
                                'name' => 'amount',
                            ])
                        </div>
                    </div>
    			</div>
                <div class="form-actions">
                    @include('mconsole::forms.submit')
                </div>
            </div>
        </div>
	</div>
    <div class="col-lg-5 col-md-6">
        
        <div class="portlet light">
            @include('mconsole::partials.portlet-title', [
                'title' => trans('mconsole::commerce.promocodes.tabs.additional'),
            ])
            <div class="portlet-body form">
                @include('mconsole::forms.checkbox', [
                    'label' => trans('mconsole::commerce.promocodes.form.one_off'),
                    'name' => 'one_off',
                ])
                @include('mconsole::forms.datetime', [
                    'label' => trans('mconsole::commerce.promocodes.form.started_at'),
                    'name' => 'started_at',
                ])
                @include('mconsole::forms.datetime', [
                    'label' => trans('mconsole::commerce.promocodes.form.expired_at'),
                    'name' => 'expired_at',
                ])
            </div>
        </div>
        
    </div>
</div>

{!! Form::close() !!}