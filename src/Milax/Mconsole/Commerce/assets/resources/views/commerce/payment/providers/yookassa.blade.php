@include('mconsole::forms.text', [
    'label' => trans('mconsole::commerce.payment.robokassa.shop_id'),
    'name' => 'settings[shop_id]',
    'value' => $item->settings->shop_id ?? null,
])

@include('mconsole::forms.text', [
    'label' => trans('mconsole::commerce.payment.robokassa.password'),
    'name' => 'settings[password]',
    'value' => $item->settings->password ?? null,
])