<div class="form-group">
    <label class="control-label">{{ $label }}</label>
    <select name="brand_id" class="form-control tags-select" data-lang-placeholder="{{ trans('mconsole::forms.commerce.products.brand.placeholder') }}">
        <option data-color="#0088cc" value="0" selected="selected">{{ trans('mconsole::forms.options.notselected') }}</option>
        @foreach ($allBrands as $category)
            @if (isset($current) && $current == $category->id)
                <option data-color="#0088cc" value="{{ $category->id }}" selected="selected">{{ $category->name }}</option>
            @else
                <option data-color="#0088cc" value="{{ $category->id }}">{{ $category->name }}</option>
            @endif
        @endforeach
    </select>
</div>