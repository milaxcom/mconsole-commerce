<?php

namespace Milax\Mconsole\Commerce\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Milax\Mconsole\Models\Language;
use Milax\Mconsole\Contracts\FormRenderer;
use Milax\Mconsole\Contracts\ListRenderer;
use Milax\Mconsole\Commerce\Contracts\Repositories\OrdersRepository;

class OrdersController extends Controller
{
    use \HasRedirects, \DoesNotHaveShow, \UseLayout;
    
    protected $model = 'Milax\Mconsole\Commerce\Models\Order';
    
    /**
     * Create new class instance
     */
    public function __construct(ListRenderer $list, FormRenderer $form, OrdersRepository $repository)
    {
        $this->redirectTo = mconsole_url('commerce/orders');
        $this->list = $list;
        $this->form = $form;
        $this->repository = $repository;
        
        $this->setCaption(trans('mconsole::commerce.orders.caption'));
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->list->removeDeleteAction()->setQuery($this->repository->index())->render(function ($item) {
            return [
                trans('mconsole::tables.id') => $item->id,
                trans('mconsole::commerce.orders.table.identifier') => $item->identifier,
                trans('mconsole::commerce.orders.table.status') => $item->status,
                trans('mconsole::commerce.orders.table.total') => currency_format($item->getTotal()),
                trans('mconsole::commerce.orders.table.delivery') => sprintf('%s: %s', $item->delivery_type->name, currency_format($item->delivery_type->cost)),
                trans('mconsole::commerce.orders.table.payment') => $item->payment_method->name,
            ];
        });
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = $this->repository->find($id);
        $this->setCaption(trans('mconsole::commerce.orders.order', [
            'identifier' => $order->identifier,
        ]));
        
        $status = [];
        
        collect(config('commerce.orders.status'))->each(function ($key) use (&$status) {
            $status[$key] = trans(sprintf('mconsole::commerce/custom.orders.status.%s', $key));
        });
        
        return $this->form->render('mconsole::commerce.orders.form', [
            'item' => $order,
            'status' => $status,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->repository->update($id, $request->all());
    }
}
