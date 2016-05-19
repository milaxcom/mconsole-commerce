@if (isset($item))
    {!! Form::model($item, ['method' => 'PUT', 'url' => mconsole_url(sprintf('commerce/categories/%s', $item->id))]) !!}
@else
    {!! Form::open(['method' => 'POST', 'url' => mconsole_url('commerce/categories')]) !!}
@endif

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
                    ])
    				@include('mconsole::forms.text', [
    					'label' => trans('mconsole::commerce.categories.form.slug'),
    					'name' => 'slug',
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
        @if (app('API')->options->getByKey('category_has_cover'))
            <div class="portlet light">
                @include('mconsole::partials.portlet-title', [
                    'title' => trans('mconsole::commerce.categories.form.cover'),
                ])
                <div class="portlet-body form">
                    @include('mconsole::forms.upload', [
                        'type' => MX_UPLOAD_TYPE_IMAGE,
                        'multiple' => false,
                        'group' => 'cover',
                        'preset' => 'commerce_category',
                        'id' => isset($item) ? $item->id : null,
                        'model' => 'Milax\Mconsole\Commerce\Models\Category;',
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
                        'value' => 0,
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
                    
                    @if ($item->children)
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

{!! Form::close() !!}