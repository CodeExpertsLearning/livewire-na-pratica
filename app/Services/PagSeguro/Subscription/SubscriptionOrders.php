<?php
namespace App\Services\PagSeguro\Subscription;


use App\Services\PagSeguro\Credentials;
use App\Services\PagSeguro\Traits\GetUserSubscriptionCode;
use Illuminate\Support\Facades\Http;

class SubscriptionOrders
{
    use GetUserSubscriptionCode;

    public function list()
    {
        $code = $this->getUserSubscriptionCode();

        if(!$code) return false;

        $url = Credentials::getCredentials('/pre-approvals/' . $code . '/payment-orders');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/vnd.pagseguro.com.br.v3+json;charset=ISO-8859-1'
        ])
        ->get($url);

        if(!$response->ok()) return false;

        return $response->json()['paymentOrders'];
    }
}
