<?php
namespace App\Services\PagSeguro\Subscription;


use App\Services\PagSeguro\Credentials;
use App\Services\PagSeguro\Traits\GetUserSubscriptionCode;
use Illuminate\Support\Facades\Http;

class SubscriptionCancel
{
    use GetUserSubscriptionCode;

    public function cancel()
    {
        $code = $this->getUserSubscriptionCode();

        if(!$code) return false;

        $url = Credentials::getCredentials('/pre-approvals/' . $code . '/cancel');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/vnd.pagseguro.com.br.v3+json;charset=ISO-8859-1'
        ])
        ->put($url, []);

        if($response->status() != 204) return false;

        return true;
    }
}
