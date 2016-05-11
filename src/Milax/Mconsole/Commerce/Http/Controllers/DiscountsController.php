<?php

namespace Milax\Mconsole\Commerce\Http\Controllers;

use App\Http\Controllers\Controller;
use Milax\Mconsole\Commerce\Http\Requests\DiscountsRequest;
use Milax\Mconsole\Contracts\ListRenderer;
use Milax\Mconsole\Contracts\FormRenderer;
use Milax\Mconsole\Contracts\Repository;

class DiscountsController extends Controller
{
    use \HasRedirects, \DoesNotHaveShow, \UseLayout;
    
    protected $model = '\Milax\Mconsole\Commerce\Models\Discount';
    
    /**
     * Create new instance
     */
    public function __construct(ListRenderer $list, FormRenderer $form, Repository $repository)
    {
        $this->setCaption(trans('mconsole::commerce.menu.discounts'));
        $this->list = $list;
        $this->form = $form;
        $this->repository = $repository;
        
        $this->redirectTo = mconsole_url('commerce/discounts');
        $this->form->addStyles([
            '/massets/modules/mconsole-commerce/css/commerce.css',
        ])->addScripts([
            '/massets/modules/mconsole-commerce/js/discounts-table.js',
            '/massets/modules/mconsole-commerce/js/commerce.js',
        ]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->list->setQuery($this->repository->index())->setAddAction('commerce/discounts/create')->render(function ($item) {
            return [
                '#' => $item->id,
                trans('mconsole::commerce.discounts.form.name') => $item->name,
                trans('mconsole::commerce.discounts.form.accumulative') => $item->accumulative ? trans('mconsole::forms.options.yesno.enabled') : trans('mconsole::forms.options.yesno.disabled'),
                trans('mconsole::commerce.discounts.form.discounts') => view('mconsole::commerce.discounts.table', [
                    'discounts' => $item->discounts,
                ]),
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
        return $this->form->render('mconsole::commerce.discounts.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscountsRequest $request)
    {
        $this->repository->create($this->serialize($request->all()));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->form->render('mconsole::commerce.discounts.form', [
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
    public function update(DiscountsRequest $request, $id)
    {
        $this->repository->update($id, $this->serialize($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    /**
     * Serialize JSON to array
     * 
     * @param  array $data [POST data]
     * @return array
     */
    protected function serialize($data)
    {
        $data['discounts'] = json_decode($data['discounts'], true);
        return $data;
    }
}
