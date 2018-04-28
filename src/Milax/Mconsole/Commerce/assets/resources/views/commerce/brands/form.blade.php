@if (isset($item))
    {!! Form::model($item, ['method' => 'PUT', 'url' => mconsole_url(sprintf('commerce/brands/%s', $item->id))]) !!}
@else
    {!! Form::open(['method' => 'POST', 'url' => mconsole_url('commerce/brands')]) !!}
@endif

<div class="row">
	<div class="col-lg-7 col-md-6">
        <div class="portlet light">
            @include('mconsole::partials.portlet-title', [
                'back' => mconsole_url('commerce/brands'),
                'title' => trans('mconsole::commerce.brands.tabs.main'),
                'fullscreen' => true,
            ])
            <div class="portlet-body form">
    			<div class="form-body">
                    @include('mconsole::forms.text', [
                        'label' => trans('mconsole::commerce.brands.form.name'),
                        'name' => 'name',
                    ])
    				@include('mconsole::forms.text', [
    					'label' => trans('mconsole::commerce.brands.form.slug'),
    					'name' => 'slug',
    				])
    				@include('mconsole::forms.textarea', [
    					'label' => trans('mconsole::commerce.brands.form.description'),
    					'name' => 'description',
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