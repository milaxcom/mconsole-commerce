<?php

namespace Milax\Mconsole\Commerce\Http\Controllers;

use App\Http\Controllers\Controller;
use Milax\Mconsole\Commerce\Http\Requests\PaymentMethodRequest;
use Milax\Mconsole\Contracts\ListRenderer;
use Milax\Mconsole\Contracts\FormRenderer;
use Milax\Mconsole\Commerce\Contracts\Repositories\PaymentMethodsRepository;

class PaymentMethodsController extends Controller
{
    use \HasRedirects, \DoesNotHaveShow, \UseLayout;
    
    protected $model = '\Milax\Mconsole\Commerce\Models\PaymentMethod';
    
    /**
     * Create new instance
     */
    public function __construct(ListRenderer $list, FormRenderer $form, PaymentMethodsRepository $repository)
    {
        $this->setCaption(trans('mconsole::commerce.menu.payment'));
        $this->redirectTo = mconsole_url('commerce/payment');
        $this->list = $list;
        $this->form = $form;
        $this->repository = $repository;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->list->setQuery($this->repository->index())->setAddAction('commerce/payment/create')->render(function ($item) {
            $unit = ($item->commission_type == 'percent') ? '%' : ' y.e.';
            $item->commission = sprintf('%s%s', $item->commission, $unit);
            
            return [
                '#' => $item->id,
                trans('mconsole::commerce.payment.form.name') => $item->name,
                trans('mconsole::commerce.payment.form.commission') => $item->commission,
                trans('mconsole::commerce.payment.form.description') => $item->description,
            ];
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->form->render('mconsole::commerce.payment.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentMethodRequest $request)
    {
        $this->repository->create($request->all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->form->render('mconsole::commerce.payment.form', [
            'item' => $this->repository->find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentMethodRequest $request, $id)
    {
        $this->repository->update($id, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->destroy($id);
    }
}
