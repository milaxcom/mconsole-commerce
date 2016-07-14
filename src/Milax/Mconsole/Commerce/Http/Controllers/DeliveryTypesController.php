<?php

namespace Milax\Mconsole\Commerce\Http\Controllers;

use App\Http\Controllers\Controller;
use Milax\Mconsole\Commerce\Http\Requests\DeliveryTypeRequest;
use Milax\Mconsole\Contracts\ListRenderer;
use Milax\Mconsole\Contracts\FormRenderer;
use Milax\Mconsole\Commerce\Contracts\Repositories\DeliveryTypesRepository;

class DeliveryTypesController extends Controller
{
    use \HasRedirects, \DoesNotHaveShow, \UseLayout;
    
    protected $model = '\Milax\Mconsole\Commerce\Models\DeliveryType';
    
    /**
     * Create new instance
     */
    public function __construct(ListRenderer $list, FormRenderer $form, DeliveryTypesRepository $repository)
    {
        $this->setCaption(trans('mconsole::commerce.menu.delivery'));
        $this->redirectTo = mconsole_url('commerce/delivery');
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
        return $this->list->setQuery($this->repository->index())->setAddAction('commerce/delivery/create')->render(function ($item) {
            return [
                '#' => $item->id,
                trans('mconsole::commerce.delivery.form.name') => $item->name,
                trans('mconsole::commerce.delivery.form.cost') => $item->cost,
                trans('mconsole::commerce.delivery.form.description') => $item->description,
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
        return $this->form->render('mconsole::commerce.delivery.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeliveryTypeRequest $request)
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
        return $this->form->render('mconsole::commerce.delivery.form', [
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
    public function update(DeliveryTypeRequest $request, $id)
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
