<?php

namespace Milax\Mconsole\Commerce\Repositories;

use Milax\Mconsole\Repositories\EloquentRepository;
use Milax\Mconsole\Commerce\Contracts\Repositories\PromocodesRepository as Repository;

class PromocodesRepository extends EloquentRepository implements Repository
{
    public $model = \Milax\Mconsole\Commerce\Models\Promocode::class;
    
    public function findByCode($code)
    {
        $now = Carbon::now();
        $promocode = $this->query()->where('code', $code)->first();
        
        // Check if promocode exists
        if (is_null($promocode)) {
            return null;
        }
        
        if (!$promocode->enabled()) {
            return null;
        }
        
        return $promocode;
     }
     
     public function useCode($code)
     {
         $promocode = $this->query()->where('code', $code)->first();
         
         if ($promocode) {
             if ($promocode->one_off) {
                 $promocode->used = true;
             }
             
             $promocode->save();
         }
     }
    
}
