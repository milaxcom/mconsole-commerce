<?php

namespace Milax\Mconsole\Commerce\Http\Requests;

use App\Http\Requests\Request;
use Milax\Mconsole\Commerce\Contracts\Repositories\PromocodesRepository;

class PromocodeRequest extends Request
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
                $promocode = $this->repository->find($this->promocodes);
                return [
                    'code' => 'required|unique:commerce_promocodes,code,' . $promocode->id,
                    'amount' => 'required|integer',
                ];
            }
            default:break;
        }

    }
    
    /**
     * Replace input
     * 
     * @return array
     */
    public function all()
    {
        $all = parent::all();
        
        if (strlen($all['started_at']) == 0) {
            $all['started_at'] = null;
        }
        
        if (strlen($all['expired_at']) == 0) {
            $all['expired_at'] = null;
        }
        
        return $all;
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
