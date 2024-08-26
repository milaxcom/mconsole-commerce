@include('mconsole::forms.text', [
    'label' => trans('mconsole::commerce.payment.robokassa.login'),
    'name' => 'settings[login]',
    'value' => $item->settings->login ?? null,
])

@include('mconsole::forms.text', [
    'label' => trans('mconsole::commerce.payment.robokassa.password1'),
    'name' => 'settings[password1]',
    'value' => $item->settings->password1 ?? null,
])

@include('mconsole::forms.text', [
    'label' => trans('mconsole::commerce.payment.robokassa.password2'),
    'name' => 'settings[password2]',
    'value' => $item->settings->password2 ?? null,
])

@include('mconsole::forms.checkbox', [
    'label' => trans('mconsole::commerce.payment.robokassa.robochecks'),
    'name' => 'settings[robochecks]',
    'value' => $item->settings->robochecks ?? null,
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
    'value' => $item->settings->sno ?? null,
    'checked' => null,
])