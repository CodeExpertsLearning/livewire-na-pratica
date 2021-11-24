<?php

namespace App\Http\Livewire\Subscription\Actions;

use App\Services\PagSeguro\Subscription\SubscriptionOrders;
use Livewire\Component;

class ListOrders extends Component
{
    public $listOrders;

    public function mount(SubscriptionOrders $subscriptionOrders)
    {
        $this->listOrders = $subscriptionOrders->list();
    }

    public function render()
    {
        return view('livewire.subscription.actions.list-orders');
    }
}
