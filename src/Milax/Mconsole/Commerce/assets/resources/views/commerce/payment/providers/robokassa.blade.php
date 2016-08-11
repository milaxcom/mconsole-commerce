@include('mconsole::forms.text', [
    'label' => trans('mconsole::commerce.payment.robokassa.login'),
    'name' => 'settings[login]',
])

@include('mconsole::forms.text', [
    'label' => trans('mconsole::commerce.payment.robokassa.password1'),
    'name' => 'settings[password1]',
])

@include('mconsole::forms.text', [
    'label' => trans('mconsole::commerce.payment.robokassa.password2'),
    'name' => 'settings[password2]',
])