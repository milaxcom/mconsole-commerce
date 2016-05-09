<?php

namespace Milax\Mconsole\Commerce\Http\Controllers;

use App\Http\Controllers\Controller;
use Milax\Mconsole\Commerce\Http\Requests\CategoryRequest;
use Milax\Mconsole\Commerce\Models\Category;
use Milax\Mconsole\Models\Language;
use Milax\Mconsole\Contracts\FormRenderer;
use Milax\Mconsole\Contracts\ListRenderer;
use Milax\Mconsole\Contracts\Repository;

class CategoriesController extends Controller
{
    use \HasRedirects, \DoesNotHaveShow;
    
    protected $model = 'Milax\Mconsole\Commerce\Models\Category';
    
    /**
     * Create new class instance
     */
    public function __construct(ListRenderer $list, FormRenderer $form, Repository $repository)
    {
        $this->redirectTo = mconsole_url('commerce/categories');
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
        return $this->list->setQuery($this->repository->index())->setAddAction('commerce/categories/create')->render(function ($item) {
            return [
                '#' => $item->id,
                trans('mconsole::commerce.categories.table.updated') => $item->updated_at->format('m.d.Y'),
                trans('mconsole::commerce.categories.table.slug') => $item->slug,
                trans('mconsole::commerce.categories.table.name') => $item->name,
                trans('mconsole::tables.state.name') => view('mconsole::indicators.state', $item),
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
        return $this->form->render('mconsole::commerce.categories.form', [
            'languages' => Language::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = $this->repository->create($request->all());
        
        $this->handleUploads($category);
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
        return $this->form->render('mconsole::commerce.categories.form', [
            'item' => Category::find($id),
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
    public function update(CategoryRequest $request, $id)
    {
        $category = $this->repository->find($id);
        
        $this->handleUploads($category);
        
        $category->update($request->all());
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
    
    /**
     * Handle files upload
     *
     * @param Milax\Mconsole\Commerce\Models\Category $object [Category object]
     * @return void
     */
    protected function handleUploads($object)
    {
        // Images processing
        app('API')->uploads->handle(function ($uploads) use (&$object) {
            app('API')->uploads->attach([
                'group' => 'cover',
                'uploads' => $uploads,
                'related' => $object,
                'unique' => true,
            ]);
        });
    }
}
