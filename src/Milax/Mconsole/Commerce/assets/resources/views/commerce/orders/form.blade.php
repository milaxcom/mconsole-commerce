@if (isset($item))
    {!! Form::model($item, ['method' => 'PUT', 'url' => mconsole_url(sprintf('commerce/orders/%s', $item->id))]) !!}
@else
    {!! Form::open(['method' => 'POST', 'url' => mconsole_url('commerce/orders')]) !!}
@endif

<div class="row">
	<div class="col-lg-7 col-md-6">
        <div class="portlet light">
            @include('mconsole::partials.portlet-title', [
                'back' => mconsole_url('commerce/orders'),
                'title' => trans('mconsole::commerce.orders.tabs.status'),
                'fullscreen' => true,
            ])
            <div class="portlet-body form">
    			<div class="form-body">
                    <div class="row">
                        <div class="col-xs-6">
                            @include('mconsole::forms.select', [
                                'name' => 'status',
                                'options' => $status,
                            ])
                        </div>
                        <div class="col-xs-6">
                            @include('mconsole::forms.submit', [
                                'text' => trans('mconsole::commerce.orders.form.change_status'),
                            ])
                        </div>
                    </div>
    			</div>
            </div>
        </div>
        <div class="portlet light">
            @include('mconsole::partials.portlet-title', [
                'title' => trans('mconsole::commerce.orders.tabs.cart'),
            ])
            <div class="portlet-body form">
    			<div class="form-body">
                    <div class="table">
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> {{ trans('mconsole::commerce.orders.cart.product') }} </th>
                                    <th> {{ trans('mconsole::commerce.orders.cart.quantity') }} </th>
                                    <th> {{ trans('mconsole::commerce.orders.cart.price') }} </th>
                                    <th> {{ trans('mconsole::commerce.orders.cart.total') }} </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($item->cart->cart as $product)
                                    <tr>
                                        <td> {{ $product->id }} </td>
                                        <td> {{ $product->name }} </td>
                                        <td> x{{ $product->quantity }} </td>
                                        <td> {{ currency_format($product->price) }} {{ config('commerce.currency.name') }}</td>
                                        <td> {{ currency_format($product->price * $product->quantity) }} {{ config('commerce.currency.name') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
    			</div>
            </div>
        </div>
	</div>
    <div class="col-lg-5 col-md-6">
        <div class="portlet light">
            @include('mconsole::partials.portlet-title', [
                'title' => trans('mconsole::commerce.orders.tabs.delivery'),
            ])
            <div class="portlet-body form">
                @foreach ($item->info as $key => $value)
                    <div class="row static-info">
                        <div class="col-md-4 name"> {{ trans(sprintf('mconsole::commerce/custom.orders.admin_fields.%s', $key)) }}: </div>
                        <div class="col-md-8 value"> {{ $value }}</div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="portlet light">
            @include('mconsole::partials.portlet-title', [
                'title' => trans('mconsole::commerce.orders.tabs.total'),
            ])
            <div class="portlet-body form">
                <div class="well">
                    @if ($item->payment_method)
                        <div class="row static-info align-reverse">
                            <div class="col-md-8 name"> Способ оплаты: </div>
                            <div class="col-md-4 value"> {{ $item->payment_method->name }} </div>
                        </div>
                    @endif
                    
                    @if ($item->promocode)
                        <div class="row static-info align-reverse">
                            <div class="col-md-8 name"> Скидка от стоимости товаров: </div>
                            <div class="col-md-4 value">
                                @if ($item->promocode->type == 'perc')
                                    {{ $item->promocode->amount }}%
                                @else
                                    {{ currency_format($item->promocode->amount) }} {{ config('commerce.currency.name') }}
                                @endif
                            </div>
                        </div>
                    @endif
                    
                    @if ($item->delivery_type)
                        <div class="row static-info align-reverse">
                            <div class="col-md-8 name"> Доставка ({{ $item->delivery_type->name }}): </div>
                            <div class="col-md-4 value"> {{ currency_format($item->delivery_type->cost) }} {{ config('commerce.currency.name') }}</div>
                        </div>
                    @endif
                    
                    <div class="row static-info align-reverse">
                        <div class="col-md-8 name"> Итого: </div>
                        <div class="col-md-4 value"> {{ currency_format($item->getTotal()) }} {{ config('commerce.currency.name') }}</div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

{!! Form::close() !!}