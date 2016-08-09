@include('mconsole::forms.text', [
    'label' => trans('mconsole::commerce.payment.robokassa.login'),
    'name' => 'settings[login]',
])

@include('mconsole::forms.text', [
    'label' => trans('mconsole::commerce.payment.robokassa.password'),
    'name' => 'settings[password]',
])