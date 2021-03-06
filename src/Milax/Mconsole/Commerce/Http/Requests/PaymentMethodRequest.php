<?php

namespace Milax\Mconsole\Commerce\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentMethodRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                return [
                    'type' => 'required',
                    'name' => 'required',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required',
                ];
        }
    }

    public function attributes()
    {
        return trans('mconsole::commerce.payment.form');
    }
    
    /**
     * Set custom validator attribute names
     *
     * @return Validator
     */
    protected function getValidatorInstance()
    {
        /*modify data before send to validator*/
        return parent::getValidatorInstance();
    }
}
