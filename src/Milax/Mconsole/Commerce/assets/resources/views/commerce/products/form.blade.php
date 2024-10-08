<form method="POST" action="{{ mconsole_url(isset($item) ? sprintf('commerce/products/%s', $item->id) : 'commerce/products') }}">
    @if (isset($item))@method('PUT')@endif
    @csrf

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
                        'value' => $item->slug ?? null,
    				])
    				@include('mconsole::forms.text', [
    					'label' => trans('mconsole::commerce.products.form.name'),
    					'name' => 'name',
                        'value' => $item->name ?? null,
    				])
    				@include('mconsole::forms.textarea', [
    					'label' => trans('mconsole::commerce.products.form.description'),
    					'name' => 'description',
                        'value' => $item->description ?? null,
                        'size' => '50x5',
    				])
                    @if (count(Config::get('commerce.products.lists')) > 0)
                        <div class="row">
                            @foreach (Config::get('commerce.products.lists') as $listKey => $listName)
                                <div class="form-group col-sm-6">
                                	<label>{{ trans($listName) }}</label>
                                    @if (isset($item->lists->$listKey))
                                    	<textarea class="form-control" name="lists[{{ $listKey }}]" rows="10">{{ implode("\r\n", $item->lists->$listKey) }}</textarea>
                                    @else
                                        <textarea class="form-control" name="lists[{{ $listKey }}]" rows="10"></textarea>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                @if (count(Config::get('commerce.products.tables')) > 0)
                    @foreach (Config::get('commerce.products.tables') as $tableKey => $table)
                        <div class="portlet light">
                            @include('mconsole::partials.portlet-title', [
                                'title' => trans($table['name']),
                            ])
                            <div class="portlet-body form">
                                @foreach ($table['fields'] as $fieldKey => $value)
                                    <div class="form-group">
                                        <label>{{ trans($value) }}</label>
                                        @if (isset($item->tables) && isset($item->tables->$tableKey->$fieldKey))
                                            <input class="form-control" name="tables[{{ $tableKey }}][{{ $fieldKey }}]" type="text" value="{{ $item->tables->$tableKey->$fieldKey }}">
                                        @else
                                            <input class="form-control" name="tables[{{ $tableKey }}][{{ $fieldKey }}]" type="text">
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="form-actions">
                    @include('mconsole::forms.submit')
                </div>
            </div>
        </div>
	</div>
    <div class="col-lg-5 col-md-6">
        <div class="portlet light">
            @include('mconsole::partials.portlet-title', [
                'title' => trans('mconsole::commerce.products.tabs.additional'),
            ])
            <div class="portlet-body form">
                @if (count($categories) == 0)
                    <p>
                        {{ trans('mconsole::commerce.products.info.category')}}
                        <a href="{{ mconsole_url('commerce/categories/create') }}" class="btn green-jungle btn-xs">Create category</a>
                    </p>
                @else
                    @include('mconsole::commerce.products.categories', [
                        'label' => trans('mconsole::commerce.products.form.categories'),
                        'allCategories' => $categories,
                        'categories' => isset($item) ? $item->categories : [],
                        'name' => 'categories',
                    ])
                @endif
                @if (count($brands) == 0)
                    <p>
                        {{ trans('mconsole::commerce.products.info.brands')}}
                        <a href="{{ mconsole_url('commerce/brands/create') }}" class="btn green-jungle btn-xs">Create brand</a>
                    </p>
                @else
                    @include('mconsole::forms.select', [
                        'options' => $brands,
                        'label' => trans('mconsole::commerce.products.form.brand'),
                        'name' => 'brand_id',
                        'value' => isset($item) ? $item->brand_id : 0,
                        'class' => 'select2',
                    ])
                @endif
                @include('mconsole::forms.state')
                @include('mconsole::forms.checkbox', [
                    'name' => 'new',
                    'label' => trans('mconsole::commerce.products.form.new'),
                    'value' => $item->new ?? null,
                ])
            </div>
        </div>
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
                            'value' => isset($item) ? $item->article : '',
                        ])
                    </div>
                    <div class="col-sm-6">
                        @include('mconsole::forms.text', [
                            'label' => trans('mconsole::commerce.products.form.quantity'),
                            'name' => 'quantity',
                            'value' => isset($item) ? $item->quantity : 0,
                        ])
                    </div>
                    <div class="col-sm-6">
                        @include('mconsole::forms.text', [
                            'label' => trans('mconsole::commerce.products.form.price'),
                            'name' => 'price',
                            'value' => isset($item) ? $item->price : 0,
                        ])
                    </div>
                    <div class="col-sm-6">
                        @include('mconsole::forms.text', [
                            'label' => trans('mconsole::commerce.products.form.discount_price'),
                            'name' => 'discount_price',
                            'value' => 0,
                            'value' => isset($item) ? $item->discount_price : 0,
                        ])
                    </div>
                    <div class="col-sm-6">
                        @include('mconsole::forms.text', [
                            'label' => trans('mconsole::commerce.products.form.increase_price'),
                            'name' => 'increase_price',
                            'value' => 0,
                            'value' => isset($item) ? $item->increase_price : 0,
                        ])
                    </div>
                    <div class="col-sm-6">
                        @include('mconsole::forms.text', [
                            'label' => trans('mconsole::commerce.products.form.decrease_price'),
                            'name' => 'decrease_price',
                            'value' => 0,
                            'value' => isset($item) ? $item->decrease_price : 0,
                        ])
                    </div>
                </div>
                @include('mconsole::forms.checkboxes', [
                    'items' => [
                        [
                            'label' => trans('mconsole::commerce.products.form.in_stock'),
                            'name' => 'in_stock',
                            'checked' => true,
                            'value' => isset($item) ? $item->in_stock : null,
                        ],
                        [
                            'label' => trans('mconsole::commerce.products.form.of_stock'),
                            'name' => 'of_stock',
                            'value' => isset($item) ? $item->of_stock : null,
                        ],
                        [
                            'label' => trans('mconsole::commerce.products.form.on_request'),
                            'name' => 'on_request',
                            'value' => isset($item) ? $item->on_request : null,
                        ],
                    ],
                ])
            </div>
        </div>

        @if (app('API')->options->getByKey('commerce_product_has_cover'))
            <div class="portlet light">
                @include('mconsole::partials.portlet-title', [
                    'title' => trans('mconsole::commerce.products.form.cover'),
                ])
                <div class="portlet-body form">
                    @include('mconsole::forms.upload', [
                        'type' => MconsoleUploadType::Image,
                        'multiple' => false,
                        'group' => 'cover',
                        'preset' => 'commerce_product_cover',
                        'id' => isset($item) ? $item->id : null,
                        'model' => sprintf('Milax\Mconsole\Commerce\Models\%s', Product::class),
                    ])
                </div>
            </div>
        @endif
        @if (app('API')->options->getByKey('commerce_product_has_gallery'))
            <div class="portlet light">
                @include('mconsole::partials.portlet-title', [
                    'title' => trans('mconsole::commerce.products.form.gallery'),
                ])
                <div class="portlet-body form">
                    @include('mconsole::forms.upload', [
                        'type' => MconsoleUploadType::Image,
                        'multiple' => true,
                        'group' => 'gallery',
                        'preset' => 'commerce_product_gallery',
                        'id' => isset($item) ? $item->id : null,
                        'model' => sprintf('Milax\Mconsole\Commerce\Models\%s', Product::class),
                    ])
                </div>
            </div>
        @endif
    </div>
</div>

</form>