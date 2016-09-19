<?php

namespace Milax\Mconsole\Commerce\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class OrderCreated extends Event
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