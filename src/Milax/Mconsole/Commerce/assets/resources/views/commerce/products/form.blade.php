@if (isset($item))
    {!! Form::model($item, ['method' => 'PUT', 'url' => mconsole_url(sprintf('commerce/products/%s', $item->id))]) !!}
@else
    {!! Form::open(['method' => 'POST', 'url' => mconsole_url('commerce/products')]) !!}
@endif

<div class="row">
	<div class="col-lg-7 col-md-6">
        <div class="portlet light">
            @include('mconsole::partials.portlet-title', [
                'back' => mconsole_url('commerce/products'),
                'title' => trans('mconsole::commerce.products.tabs.main'),
                'fullscreen' => true,
            ])
            <div class="portlet-body form">
    			<div class="form-body">
    				@include('mconsole::forms.text', [
    					'label' => trans('mconsole::commerce.products.form.slug'),
    					'name' => 'slug',
    				])
    				@include('mconsole::forms.text', [
    					'label' => trans('mconsole::commerce.products.form.name'),
    					'name' => 'name',
    				])
    				@include('mconsole::forms.textarea', [
    					'label' => trans('mconsole::commerce.products.form.description'),
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
            @include('mconsole::partials.portlet-title', [
                'title' => trans('mconsole::commerce.products.form.inventory'),
            ])
            <div class="portlet-body form">
                <div class="row">
                    <div class="col-sm-6">
                        @include('mconsole::forms.text', [
                            'label' => trans('mconsole::commerce.products.form.article'),
                            'name' => 'article',
                        ])
                    </div>
                    <div class="col-sm-6">
                        @include('mconsole::forms.text', [
                            'label' => trans('mconsole::commerce.products.form.quantity'),
                            'name' => 'quantity',
                            'value' => 0,
                        ])
                    </div>
                    <div class="col-sm-6">
                        @include('mconsole::forms.text', [
                            'label' => trans('mconsole::commerce.products.form.price'),
                            'name' => 'price',
                            'value' => 0,
                        ])
                    </div>
                    <div class="col-sm-6">
                        @include('mconsole::forms.text', [
                            'label' => trans('mconsole::commerce.products.form.discount_price'),
                            'name' => 'discount_price',
                            'value' => 0,
                        ])
                    </div>
                    <div class="col-sm-6">
                        @include('mconsole::forms.text', [
                            'label' => trans('mconsole::commerce.products.form.increase_price'),
                            'name' => 'increase_price',
                            'value' => 0,
                        ])
                    </div>
                    <div class="col-sm-6">
                        @include('mconsole::forms.text', [
                            'label' => trans('mconsole::commerce.products.form.decrease_price'),
                            'name' => 'decrease_price',
                            'value' => 0,
                        ])
                    </div>
                </div>
                @include('mconsole::forms.checkboxes', [
                    'items' => [
                        [
                            'label' => trans('mconsole::commerce.products.form.in_stock'),
                            'name' => 'in_stock',
                        ],
                        [
                            'label' => trans('mconsole::commerce.products.form.of_stock'),
                            'name' => 'of_stock',
                        ],
                        [
                            'label' => trans('mconsole::commerce.products.form.on_request'),
                            'name' => 'on_request',
                        ],
                    ],
                ])
            </div>
        </div>
        
        @if (app('API')->options->getByKey('product_has_cover'))
            <div class="portlet light">
                @include('mconsole::partials.portlet-title', [
                    'title' => trans('mconsole::commerce.products.form.cover'),
                ])
                <div class="portlet-body form">
                    @include('mconsole::forms.upload', [
                        'type' => MX_UPLOAD_TYPE_IMAGE,
                        'multiple' => false,
                        'group' => 'cover',
                        'preset' => 'commerce_product_cover',
                        'id' => isset($item) ? $item->id : null,
                        'model' => 'Milax\Mconsole\Commerce\Models\Product',
                    ])
                </div>
            </div>
        @endif
        @if (app('API')->options->getByKey('product_has_gallery'))
            <div class="portlet light">
                @include('mconsole::partials.portlet-title', [
                    'title' => trans('mconsole::commerce.products.form.gallery'),
                ])
                <div class="portlet-body form">
                    @include('mconsole::forms.upload', [
                        'type' => MX_UPLOAD_TYPE_IMAGE,
                        'multiple' => true,
                        'group' => 'gallery',
                        'preset' => 'commerce_product_gallery',
                        'id' => isset($item) ? $item->id : null,
                        'model' => 'Milax\Mconsole\Commerce\Models\Product',
                    ])
                </div>
            </div>
        @endif
        <div class="portlet light">
            @include('mconsole::partials.portlet-title', [
                'title' => trans('mconsole::commerce.products.tabs.additional'),
            ])
            <div class="portlet-body form">
                @include('mconsole::forms.state')
            </div>
        </div>
    </div>
</div>

{!! Form::close() !!}