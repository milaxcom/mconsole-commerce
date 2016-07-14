<div class="form-group">
    <label for="multiple" class="control-label">{{ $label }}</label>
    <select name="{{ $name }}[]" class="form-control tags-select" multiple data-lang-placeholder="{{ trans('mconsole::forms.commerce.products.categories.placeholder') }}">
        @foreach ($allCategories as $id => $category)
            @if (isset($categories) && count($categories) > 0 && $categories->where('id', $id)->count() > 0)
                <option data-color="#0088cc" value="{{ $id }}" selected="selected">{{ $category }}</option>
            @else
                <option data-color="#0088cc" value="{{ $id }}">{{ $category }}</option>
            @endif
        @endforeach
    </select>
</div>