<?php

namespace Milax\Mconsole\Commerce\Contracts\Repositories;

interface PromocodesRepository
{
    /**
     * Find promocode by it's code
     * 
     * @param  string $code
     * @return Milax\Mconsole\Commerce\Models\Promocode
     */
    public function findByCode($code);
    
    /**
     * Use promocode by it's code
     * 
     * @param  string $code
     * @return void
     */
    public function useCode($code);
}
