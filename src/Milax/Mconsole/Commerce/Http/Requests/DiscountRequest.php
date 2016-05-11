<?php

namespace Milax\Mconsole\Commerce\Http\Requests;

use App\Http\Requests\Request;

class DiscountRequest extends Request
{    
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
                    'name' => 'required|max:255',
                ];
                break;
            
            default:
                return [
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
        $validator->setAttributeNames(trans('mconsole::commerce.discounts.form'));
        
        return $validator;
    }
}
