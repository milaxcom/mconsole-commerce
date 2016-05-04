@if (isset($item))
    {!! Form::model($item, ['method' => 'PUT', 'route' => ['mconsole.commerce.categories.update', $item->id]]) !!}
@else
    {!! Form::open(['method' => 'POST', 'route' => 'mconsole.commerce.categories.store']) !!}
@endif

<div class="row">
	<div class="col-lg-7 col-md-6">
        <div class="portlet light">
            @include('mconsole::partials.portlet-title', [
                'back' => '/mconsole/commerce/categories',
                'title' => trans('mconsole::commerce.categories.tabs.main'),
                'fullscreen' => true,
            ])
            <div class="portlet-body form">
                
                @if (isset($item))
                    @include('mconsole::partials.note', [
                        'title' => trans('mconsole::commerce.categories.info.title'),
                        'text' => trans('mconsole::commerce.categories.info.text'),
                    ])
                @endif
                
    			<div class="form-body">
    				@include('mconsole::forms.text', [
    					'label' => trans('mconsole::commerce.categories.form.slug'),
    					'name' => 'slug',
    				])
    				@include('mconsole::forms.text', [
    					'label' => trans('mconsole::commerce.categories.form.name'),
    					'name' => 'name',
    				])
    				@include('mconsole::forms.textarea', [
    					'label' => trans('mconsole::commerce.categories.form.description'),
    					'name' => 'description',
    				])
    			</div>
                <div class="form-actions">
                    @include('mconsole::forms.submit')
                </div>
            </div>
        </div>
	</div>
    <div class="col-lg-5 col-md-6">
        
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue sbold uppercase">{{ trans('mconsole::commerce.categories.tabs.additional') }}</span>
                </div>
            </div>
            <div class="portlet-body form">
                @include('mconsole::forms.state')
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}