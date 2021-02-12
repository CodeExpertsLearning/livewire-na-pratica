<?php

namespace App\Http\Livewire\Payment;

use App\Models\{Plan, User};
use App\Services\PagSeguro\Credentials;
use App\Services\PagSeguro\Subscription\SubscriptionService;
use Faker\Provider\DateTime;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class CreditCard extends Component
{
    public $sessionId;

    public Plan $plan;

    protected $listeners = [
        'paymentData' => 'proccessSubscription'
    ];

    public function mount()
    {
        $url = Credentials::getCredentials('/sessions/');

        $response = Http::post($url);
        $response = simplexml_load_string($response->body());
        $this->sessionId = (string) $response->id;
    }

    public function proccessSubscription($data)
    {
        $data['plan_reference'] = $this->plan->reference;
        $makeSubscription = (new SubscriptionService($data))->makeSubscription();

        $user = auth()->user();

        $user->plan()->create([
            'plan_id' => $this->plan->id,
            'status'  => $makeSubscription['status'],
            'date_subscription' => (\DateTime::createFromFormat(DATE_ATOM, $makeSubscription['date']))->format('Y-m-d H:i:s'),
            'reference_transaction' => $makeSubscription['code'],
        ]);

        session()->forget('choosed_plan');

        session()->flash('message', 'Plano Aderido com Sucesso');

        $this->emit('subscriptionFinished');
    }

    public function render()
    {
        return view('livewire.payment.credit-card')
            ->layout('layouts.front');
    }
}
