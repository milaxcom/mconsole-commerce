<form method="POST" action="{{ mconsole_url(isset($item) ? sprintf('commerce/categories/%s', $item->id) : 'commerce/categories') }}">
    @if (isset($item))@method('PUT')@endif
    @csrf

<div class="row">
	<div class="col-lg-7 col-md-6">
        <div class="portlet light">
            @include('mconsole::partials.portlet-title', [
                'back' => mconsole_url('commerce/categories'),
                'title' => trans('mconsole::commerce.categories.tabs.main'),
                'fullscreen' => true,
            ])
            <div class="portlet-body form">
    			<div class="form-body">
                    @include('mconsole::forms.text', [
                        'label' => trans('mconsole::commerce.categories.form.name'),
                        'name' => 'name',
                        'value' => $item->name ?? null,
                    ])
    				@include('mconsole::forms.text', [
    					'label' => trans('mconsole::commerce.categories.form.slug'),
    					'name' => 'slug',
                        'value' => $item->slug ?? null,
    				])
    				@include('mconsole::forms.textarea', [
    					'label' => trans('mconsole::commerce.categories.form.description'),
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
    <div class="col-lg-5 col-md-6">
        @if (app('API')->options->getByKey('commerce_category_has_cover'))
            <div class="portlet light">
                @include('mconsole::partials.portlet-title', [
                    'title' => trans('mconsole::commerce.categories.form.cover'),
                ])
                <div class="portlet-body form">
                    @include('mconsole::forms.upload', [
                        'type' => MconsoleUploadType::Image,
                        'multiple' => false,
                        'group' => 'cover',
                        'preset' => 'commerce_category',
                        'id' => isset($item) ? $item->id : null,
                        'model' => sprintf('Milax\Mconsole\Commerce\Models\%s', Category::class),
                    ])
                </div>
            </div>
        @endif
        <div class="portlet light">
            @include('mconsole::partials.portlet-title', [
                'title' => trans('mconsole::commerce.categories.tabs.additional'),
            ])
            <div class="portlet-body form">
                @if (count($categories) == 1)
                    @include('mconsole::forms.hidden', [
                        'name' => 'category_id',
                        'value' => 0,
                    ])
                @else
                    @include('mconsole::forms.select', [
                        'options' => $categories,
                        'label' => trans('mconsole::commerce.categories.form.category_id'),
                        'name' => 'category_id',
                        'value' => $item->category_id ?? null,
                        'class' => 'select2',
                    ])
                @endif
                @include('mconsole::forms.state')
            </div>
        </div>
        
        <div class="portlet light">
            @include('mconsole::partials.portlet-title', [
                'title' => trans('mconsole::commerce.categories.tabs.relationships'),
            ])
            @if (isset($item))
                <div class="portlet-body form">
                    @if ($item->parent)
                        <p>{{ trans('mconsole::commerce.categories.form.parent') }} — <a href="{{ mconsole_url(sprintf('commerce/categories/%s/edit', $item->parent->id)) }}">{{ $item->parent->name }}</a></p>
                    @endif
                    
                    @if ($item->children && count($item->children) > 0)
                        {{ trans('mconsole::commerce.categories.form.children') }}
                        <ul>
                            @foreach ($item->children as $child)
                                <li><a href="{{ mconsole_url(sprintf('commerce/categories/%s/edit', $child->id)) }}">{{ $child->name }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endif
        </div>
        
    </div>
</div>

</form>