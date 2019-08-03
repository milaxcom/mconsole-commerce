<?php

namespace Milax\Mconsole\Commerce\Events;

use Illuminate\Queue\SerializesModels;

class OrderCreated
{
    use SerializesModels;
    
    public $order;
    
    /**
     * Create a new event instance.
     *
     * @param  Podcast  $podcast
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }
}