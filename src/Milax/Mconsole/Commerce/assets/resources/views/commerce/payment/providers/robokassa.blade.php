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

@include('mconsole::forms.checkbox', [
    'label' => trans('mconsole::commerce.payment.robokassa.robochecks'),
    'name' => 'settings[robochecks]',
])

@include('mconsole::forms.select', [
    'label' => trans('mconsole::commerce.payment.robokassa.sno'),
    'name' => 'settings[sno]',
    'options' => [
        'osn' => 'osn - общая СН',
        'usn_income' => 'usn_income - упрощенная СН (доходы)',
        'usn_income_outcome' => 'usn_income_outcome - упрощенная СН (доходы минус расходы)',
        'envd' => 'envd - единый налог на вмененный доход',
        'esn' => 'esn - единый сельскохозяйственный налог',
        'patent' => 'patent - патентная СН',
    ],
])