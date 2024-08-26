<form method="POST" action="{{ mconsole_url(isset($item) ? sprintf('commerce/brands/%s', $item->id) : 'commerce/brands') }}">
    @if (isset($item))@method('PUT')@endif
    @csrf

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
                        'value' => $item->name ?? null,
                    ])
    				@include('mconsole::forms.text', [
    					'label' => trans('mconsole::commerce.brands.form.slug'),
    					'name' => 'slug',
                        'value' => $item->slug ?? null,
    				])
    				@include('mconsole::forms.textarea', [
    					'label' => trans('mconsole::commerce.brands.form.description'),
    					'name' => 'description',
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