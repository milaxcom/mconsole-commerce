<?php

namespace Milax\Mconsole\Commerce\Http\Requests;

use App\Http\Requests\Request;
use Milax\Mconsole\Contracts\Repository;

class CategoryRequest extends Request
{
    public function __construct()
    {
        $this->repository = new \Milax\Mconsole\Commerce\Repositories\CategoriesRepository(\Milax\Mconsole\Commerce\Models\Category::class);
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
        $category = $this->repository->index()->find($this->categories);
        switch ($this->method) {
            case 'PUT':
            case 'UPDATE':
                return [
                    'slug' => 'required|max:255|unique:commerce_categories,slug,' . $category->id,
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