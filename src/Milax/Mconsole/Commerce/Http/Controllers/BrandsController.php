<?php

namespace Milax\Mconsole\Commerce\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Milax\Mconsole\Models\Language;
use Milax\Mconsole\Contracts\FormRenderer;
use Milax\Mconsole\Contracts\ListRenderer;
use Milax\Mconsole\Commerce\Models\Brand;

class BrandsController extends Controller
{
    use \HasRedirects, \DoesNotHaveShow, \UseLayout;
    
    protected $model = 'Milax\Mconsole\Commerce\Models\Brand';
    
    /**
     * Create new class instance
     */
    public function __construct(ListRenderer $list, FormRenderer $form)
    {
        $this->redirectTo = mconsole_url('commerce/brands');
        $this->list = $list;
        $this->form = $form;
        
        $this->setCaption(trans('mconsole::commerce.brands.caption'));
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->list->setQuery(Brand::query()->withCount('products'))->setAddAction('commerce/brands/create')->render(function ($item) {
            return [
                trans('mconsole::tables.state') => view('mconsole::indicators.state', $item),
                trans('mconsole::tables.id') => $item->id,
                trans('mconsole::commerce.brands.table.updated') => $item->updated_at->format('m.d.Y'),
                trans('mconsole::commerce.brands.table.slug') => $item->slug,
                trans('mconsole::commerce.brands.table.name') => $item->name,
                trans('mconsole::commerce.brands.table.products') => $item->products_count,
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
        return $this->form->render('mconsole::commerce.brands.form', [
            'languages' => Language::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Brand::create($request->all());
        
        $this->redirect();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->form->render('mconsole::commerce.brands.form', [
            'item' => Brand::find($id),
            'languages' => Language::all(),
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
        $brand = Brand::findOrFail($id);
        $brand->update($request->all());
        
        $this->redirect();
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
        
        $this->redirect();
    }
}
