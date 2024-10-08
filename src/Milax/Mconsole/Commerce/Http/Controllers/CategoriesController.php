<?php

namespace Milax\Mconsole\Commerce\Http\Controllers;

use App\Http\Controllers\Controller;
use Milax\Mconsole\Commerce\Http\Requests\CategoryRequest;
use Milax\Mconsole\Commerce\Models\Category;
use Milax\Mconsole\Models\Language;
use Milax\Mconsole\Contracts\FormRenderer;
use Milax\Mconsole\Contracts\ListRenderer;
use Milax\Mconsole\Commerce\Contracts\Repositories\CategoriesRepository;

class CategoriesController extends Controller
{
    use \HasRedirects, \DoesNotHaveShow, \UseLayout;
    
    protected $model = 'Milax\Mconsole\Commerce\Models\Category';

    protected $form, $list, $repository, $redirectTo;
    
    /**
     * Create new class instance
     */
    public function __construct(ListRenderer $list, FormRenderer $form, CategoriesRepository $repository)
    {
        $this->redirectTo = mconsole_url('commerce/categories');
        $this->list = $list;
        $this->form = $form;
        $this->repository = $repository;
        
        $this->setCaption(trans('mconsole::commerce.categories.caption'));
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->list
            ->setText('#', 'id', false)
            ->setText(trans('mconsole::commerce.categories.form.name'), 'name', false);

        return $this->list->setQuery($this->repository->index()->with('uploads'))->setAddAction('commerce/categories/create')->render(function ($item) {
            $cover = $item->getCover();
            return [
                trans('mconsole::tables.cover') => $cover ? $cover->getImagePath('mconsole') : null,
                trans('mconsole::tables.state') => view('mconsole::indicators.state', $item),
                trans('mconsole::tables.id') => $item->id,
                trans('mconsole::commerce.categories.table.updated') => $item->updated_at->format('m.d.Y'),
                trans('mconsole::commerce.categories.table.slug') => $item->slug,
                trans('mconsole::commerce.categories.table.name') => $item->name,
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
        return $this->form->render('mconsole::commerce.categories.form', [
            'item' => $this->repository->query()->withChildren()->withParent()->find($id),
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
        $this->handleUploads($this->repository->find($id));
        $this->repository->update($id, $request->all());
        
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
