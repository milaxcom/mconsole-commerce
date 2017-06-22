<?php

namespace Milax\Mconsole\Commerce\Http\Controllers;

use App\Http\Controllers\Controller;
use Milax\Mconsole\Commerce\Http\Requests\PromocodeRequest;
use Milax\Mconsole\Contracts\ListRenderer;
use Milax\Mconsole\Contracts\FormRenderer;
use Milax\Mconsole\Commerce\Contracts\Repositories\PromocodesRepository;

class PromocodesController extends Controller
{
    use \HasRedirects, \DoesNotHaveShow, \UseLayout;
    
    protected $model = '\Milax\Mconsole\Commerce\Models\Promocode';
    
    /**
     * Create new instance
     */
    public function __construct(ListRenderer $list, FormRenderer $form, PromocodesRepository $repository)
    {
        $this->setCaption(trans('mconsole::commerce.menu.promocodes'));
        $this->list = $list;
        $this->form = $form;
        $this->repository = $repository;
        
        $this->redirectTo = mconsole_url('commerce/promocodes');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->list->setQuery($this->repository->index())->setAddAction('commerce/promocodes/create')->render(function ($item) {
            return [
                trans('mconsole::tables.id') => $item->id,
                null => view('mconsole::indicators.state', [
                    'enabled' => $item->enabled(),
                ]),
                trans('mconsole::commerce.promocodes.form.code') => sprintf('<code>%s</code>', $item->code),
                trans('mconsole::commerce.promocodes.form.discount') => $item->type == 'perc' ? sprintf('%s%%', $item->amount) : currency_format($item->amount) . ' руб.',
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
        return $this->form->render('mconsole::commerce.promocodes.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PromocodeRequest $request)
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
        return $this->form->render('mconsole::commerce.promocodes.form', [
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
    public function update(PromocodeRequest $request, $id)
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
