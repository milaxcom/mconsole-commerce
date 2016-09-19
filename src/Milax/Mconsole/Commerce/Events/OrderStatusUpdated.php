<?php

namespace Milax\Mconsole\Commerce\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdated extends Event
{
    use SerializesModels;
    
    public $order;
    public $status;
    
    /**
     * Create a new event instance.
     *
     * @param  Podcast  $podcast
     * @return void
     */
    public function __construct($order, $status)
    {
        $this->order = $order;
        $this->status = $status;
    }
}