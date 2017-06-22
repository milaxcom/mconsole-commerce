<?php

namespace Milax\Mconsole\Commerce\Http\Requests;

use App\Http\Requests\Request;
use Milax\Mconsole\Commerce\Contracts\Repositories\ProductsRepository;

class ProductRequest extends Request
{
    public function __construct(ProductsRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|max:255',
            'price' => 'integer',
            'discount_price' => 'integer',
            'increase_price' => 'integer',
            'decrease_price' => 'integer',
            'quantity' => 'integer',
        ];
        
        switch ($this->method) {
            case 'PUT':
            case 'UPDATE':
                $rules['slug'] = 'max:255|unique:commerce_products,slug,' . $this->repository->find($this->products)->id;
                break;
            
            case 'POST':
                $rules['slug'] = 'max:255|unique:commerce_products';
        }
        
        return $rules;
    }
    
    /**
     * Modify request input
     * 
     * @return array
     */
    public function all()
    {
        $input = parent::all();
        
        if (strlen($input['slug']) == 0) {
            $input['slug'] = str_slug($input['name']);
        } else {
            $input['slug'] = str_slug($input['slug']);
        }
        
        return $input;
    }
    
    /**
     * Set custom validator attribute names
     *
     * @return Validator
     */
    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();
        $validator->setAttributeNames(trans('mconsole::commerce.products.form'));
        
        return $validator;
    }
}
