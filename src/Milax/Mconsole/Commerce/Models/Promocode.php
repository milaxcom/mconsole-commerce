<?php

namespace Milax\Mconsole\Commerce\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Promocode extends Model
{
    protected $table = 'commerce_promocodes';
    protected $fillable = ['code', 'type', 'amount', 'started_at', 'expired_at', 'one_off', 'used'];
    
    /**
     * Check if promocode is enabled
     * 
     * @return boolean
     */
    public function enabled()
    {
        // Check if promocode is already used
        if ($this->used) {
            return false;
        }
        
        $now = Carbon::now();
        
        // Check promocode started_at
        if ($this->started_at && $now < $this->started_at) {
            return false;
        }
        
        // Check promocode expired_at
        if ($this->expired_at && $now > $this->expired_at) {
            return false;
        }
        
        return true;
    }
    
}
