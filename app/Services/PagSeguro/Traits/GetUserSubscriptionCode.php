<?php


namespace App\Services\PagSeguro\Traits;


trait GetUserSubscriptionCode
{
    private function getUserSubscriptionCode()
    {
        $userSubscription = auth()->user()->plan;

        if(!$userSubscription) return false;

        return $userSubscription->reference_transaction;
    }
}
