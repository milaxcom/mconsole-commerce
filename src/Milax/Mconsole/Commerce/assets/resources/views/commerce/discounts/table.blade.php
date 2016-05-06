@if (count($discounts) == 0)
    {{ trans('mconsole::commerce.discounts.table.nodiscounts') }}
@else
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>{{ trans('mconsole::commerce.discounts.form.sum') }}</th>
                <th>{{ trans('mconsole::commerce.discounts.form.discount') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($discounts as $discount)
                <tr>
                    <td>{{ $discount['sum'] }}</td>
                    <td>{{ $discount['discount'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif