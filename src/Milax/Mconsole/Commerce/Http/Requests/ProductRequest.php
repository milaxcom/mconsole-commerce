<?php

namespace Milax\Mconsole\Commerce\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Milax\Mconsole\Commerce\Contracts\Repositories\ProductsRepository;

class ProductRequest extends FormRequest
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
        
        switch ($this->method()) {
            case 'PUT':
            case 'UPDATE':
                $rules['slug'] = 'max:255|unique:commerce_products,slug,' . $this->repository->find($this->product)->id;
                break;
            
            case 'POST':
                $rules['slug'] = 'max:255|unique:commerce_products';
        }
        
        return $rules;
    }

    public function attributes()
    {
        return trans('mconsole::commerce.products.form');
    }
    
    /**
     * Set custom validator attribute names
     *
     * @return Validator
     */
    protected function getValidatorInstance()
    {
        $input = $this->all();
        if (empty($input['slug'])) {
            $input['slug'] = str_slug($input['name']);
        }
        $this->getInputSource()->replace($input);

        /*modify data before send to validator*/
        return parent::getValidatorInstance();
    }
}
