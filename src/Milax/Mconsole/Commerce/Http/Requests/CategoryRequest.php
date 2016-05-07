<?php

namespace Milax\Mconsole\Commerce\Http\Requests;

use App\Http\Requests\Request;

class CategoryRequest extends Request
{
    public function __construct()
    {
        $this->repository = app('API')->repositories->commerce->categories;
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
                    'slug' => 'required|max:255|unique:commerce_categories,slug,' . $this->repository->find($this->categories)->id,
                    'name' => 'required|max:255',
                ];
                break;
            
            default:
                return [
                    'slug' => 'required|max:255|unique:commerce_categories',
                    'name' => 'required|max:255',
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
        $validator->setAttributeNames(trans('mconsole::commerce.categories.form'));
        
        return $validator;
    }
}
