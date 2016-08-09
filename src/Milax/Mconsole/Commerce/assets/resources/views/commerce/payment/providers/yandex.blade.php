@include('mconsole::forms.text', [
    'label' => trans('mconsole::commerce.payment.robokassa.shop_id'),
    'name' => 'settings[shop_id]',
])

@include('mconsole::forms.text', [
    'label' => trans('mconsole::commerce.payment.robokassa.password'),
    'name' => 'settings[password]',
])