<?php

namespace Milax\Mconsole\Commerce\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Milax\Mconsole\Commerce\Contracts\Repositories\PromocodesRepository;

class PromocodeRequest extends FormRequest
{
    public function __construct(PromocodesRepository $repository)
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
        switch ($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'code' => 'required|unique:commerce_promocodes,code',
                    'amount' => 'required|integer',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                $promocode = $this->repository->find($this->promocode);
                return [
                    'code' => 'required|unique:commerce_promocodes,code,' . $promocode->id,
                    'amount' => 'required|integer',
                ];
            }
            default:break;
        }

    }

    public function attributes()
    {
        return trans('mconsole::commerce.promocodes.form');
    }
    
    /**
     * Set custom validator attribute names
     *
     * @return Validator
     */
    protected function getValidatorInstance()
    {
        $input = $this->all();
        if (strlen($input['started_at']) == 0) {
            $input['started_at'] = null;
        }
        
        if (strlen($input['expired_at']) == 0) {
            $input['expired_at'] = null;
        }
        $this->getInputSource()->replace($input);

        /*modify data before send to validator*/
        return parent::getValidatorInstance();
    }
}
