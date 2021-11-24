<?php

namespace App\Http\Livewire\Subscription\Actions;

use App\Services\PagSeguro\Subscription\SubscriptionCancel;
use Livewire\Component;

class CancelSubscription extends Component
{
    public $showJetstreamModal = false;

    public function showModal()
    {
        $this->showJetstreamModal = true;
    }
    public function cancelSubscription(SubscriptionCancel $subscriptionCancel)
    {
        $getResult = $subscriptionCancel->cancel();

        if(!$getResult) {
            session()->flash('error', 'Assinatura não ativa!');
            $this->showJetstreamModal = false;
            return;
        }

        $userSubscription = auth()->user()->plan;

        if(!$userSubscription) {
            session()->flash('error', 'Assinatura não encontrada!!');
            $this->showJetstreamModal = false;
            return;
        }

        $userSubscription->update(['status' => 'CANCELLED']);

        session()->flash('success', 'Assinatura Cancelada com Sucesso!');

        $this->showJetstreamModal = false;

        //Disparar evento interno para envio do email informativo sobre o cancelamento
    }

    public function render()
    {
        return view('livewire.subscription.actions.cancel-subscription');
    }
}
