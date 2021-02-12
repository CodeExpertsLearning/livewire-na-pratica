<?php
namespace App\Traits\Subscription;

trait SubscriptionTrait
{
    public function loadFeaturesByUserPlan($type = null)
    {
        $userPlan = auth()->user()->plan();

        if(!$userPlan->exists()) return [];

        return $userPlan->first()->plan->features()->whereType($type)->get();
    }

    public function userCanNotCreateANewExpense()
    {
        $userPlanFeatures = $this->loadFeaturesByUserPlan('amount');

        if(!$userPlanFeatures) return false;

        $amountFeature = $userPlanFeatures->first()->rule['amount'];
        $userExpenseAmount = auth()->user()->expenses->count();

        return $userExpenseAmount >= $amountFeature;
    }
}
