<?php
namespace App\Services\PagSeguro\Subscription;


use App\Services\PagSeguro\Credentials;
use Illuminate\Support\Facades\Http;

class SubscriptionReaderService
{
    public function getSubscriptionByCode($subscriptionCode)
    {
        $url = Credentials::getCredentials('/pre-approvals/' . $subscriptionCode);

        return $this->subscriptionReader($url);
    }

    public function getSubscriptionByNotificationCode($notificationCode)
    {
        $url = Credentials::getCredentials('/pre-approvals/notifications/' . $notificationCode);

        return $this->subscriptionReader($url);
    }

    private function subscriptionReader($urlCode)
    {
        $response = Http::withHeaders(
            [
                'Content-Type' => 'application/json',
                'Accept' => 'application/vnd.pagseguro.com.br.v3+json;charset=ISO-8859-1'
            ]
        )
        ->get($urlCode);

        return $response->json();
    }
}
