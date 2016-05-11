<?php

namespace Milax\Mconsole\Commerce\Http\Requests;

use App\Http\Requests\Request;

class ProductRequest extends Request
{
    public function __construct()
    {
        $this->repository = app('API')->repositories->commerce->products;
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
        switch ($this->method) {
            case 'PUT':
            case 'UPDATE':
                return [
                    'slug' => 'max:255|unique:commerce_products,slug,' . $this->repository->find($this->products)->slug,
                    'name' => 'required|max:255',
                    'price' => 'integer',
                    'discount_price' => 'integer',
                    'increase_price' => 'integer',
                    'decrease_price' => 'integer',
                ];
                break;
            
            case 'POST':
                return [
                    'slug' => 'max:255|unique:commerce_products',
                    'name' => 'required|max:255',
                    'price' => 'integer',
                    'discount_price' => 'integer',
                    'increase_price' => 'integer',
                    'decrease_price' => 'integer',
                ];
        }
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
