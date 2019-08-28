<?php


namespace Milax\Mconsole\Commerce\Http\Controllers;

use App\Http\Controllers\Controller;
use Milax\Mconsole\Commerce\Http\Requests\ProductRequest;
use Milax\Mconsole\Commerce\Models\Product;
use Milax\Mconsole\Commerce\Models\Brand;
use Milax\Mconsole\Models\Language;
use Milax\Mconsole\Contracts\ListRenderer;
use Milax\Mconsole\Contracts\FormRenderer;
use Milax\Mconsole\Commerce\Contracts\Repositories\ProductsRepository;

class ProductsController extends Controller
{
    use \HasRedirects, \DoesNotHaveShow, \UseLayout;
    
    protected $model = 'Milax\Mconsole\Commerce\Models\Product';
    
    /**
     * Create new class instance
     */
    public function __construct(ListRenderer $list, FormRenderer $form, ProductsRepository $repository)
    {
        $this->redirectTo = mconsole_url('commerce/products');
        $this->list = $list;
        $this->form = $form;
        $this->repository = $repository;
        $this->brands = Brand::query()->select('id', 'name')->orderBy('name')->get()->pluck('name', 'id')->all();
        #dd(array_prepend(, 'Не указан'));
        
        $this->setCaption(trans('mconsole::commerce.products.caption'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->list
            ->setText('#', 'id', true)
            ->setText(trans('mconsole::commerce.products.form.article'), 'article', false)
            ->setText(trans('mconsole::commerce.products.form.name'), 'name', false)
            ->setSelect(trans('mconsole::commerce.products.form.brand'), 'brand_id', $this->brands, true);

        return $this->list->setQuery($this->repository->index()->with('brand')->with('uploads'))->setAddAction('commerce/products/create')->render(function ($item) {
            $cover = $item->getCover();
            return [
                trans('mconsole::tables.cover') => $cover ? $cover->getImagePath('mconsole') : null,
                trans('mconsole::tables.id') => $item->id,
                trans('mconsole::commerce.products.table.updated') => $item->updated_at->format('m.d.Y'),
                trans('mconsole::commerce.products.table.article') => $item->article,
                trans('mconsole::commerce.products.table.brand') => $item->brand->name ?? '',
                trans('mconsole::commerce.products.table.name') => $item->name,
                trans('mconsole::commerce.products.table.quantity') => $item->quantity,
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
        return $this->form->render('mconsole::commerce.products.form', [
            'languages' => Language::all(),
            'brands' => Brand::enabled()->get(),
            'brands' => ['Не указан'] + $this->brands,
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = $this->repository->create($request->all());
        
        $this->handleUploads($product);
        
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
        return $this->form->render('mconsole::commerce.products.form', [
            'item' => Product::find($id),
            'languages' => Language::all(),
            'brands' => ['Не указан'] + $this->brands,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = $this->repository->update($id, $request->all());
        $this->handleUploads($product);
        
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
            app('API')->uploads->attach([
                'group' => 'gallery',
                'uploads' => $uploads,
                'related' => $object,
                'unique' => false,
            ]);
        });
    }
}
