<?php

namespace Milax\Mconsole\Commerce\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Milax\Mconsole\Commerce\Contracts\Repositories\CategoriesRepository;

class CategoryRequest extends FormRequest
{
    public function __construct(CategoriesRepository $repository)
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
        switch ($this->method()) {
            case 'PUT':
            case 'UPDATE':
                return [
                    'slug' => 'required|max:255|unique:commerce_categories,slug,' . $this->repository->find($this->category)->id,
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

    public function attributes()
    {
        return trans('mconsole::commerce.categories.form');
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
        } else {
            $input['slug'] = str_slug($input['slug']);
        }
        $this->getInputSource()->replace($input);

        /*modify data before send to validator*/
        return parent::getValidatorInstance();
    }
}
