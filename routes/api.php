<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/notifications', function(Request $request) {
    $data = $request->only('notificationType', 'notificationCode');

    $subscription = (new \App\Services\PagSeguro\Subscription\SubscriptionReaderService())
            ->getSubscriptionByNotificationCode($data['notificationCode']);

    if(isset($subscription['error']) && $subscription['error'])
        return response()->json(['data' => ['msg' => 'Nada encontrado!']], 404);

    $userPlan = \App\Models\UserPlan::whereReferenceTransaction($subscription['code'])->first();

    if(!$userPlan) return response()->json(['data' => ['msg' => 'Nada encontrado!']], 404);

    $userPlan->update(['status' => $subscription['status']]);

    if($subscription['status'] == 'ACTIVE') {
        //Enviar um e-mail pro usuário agradecendo a adesão...
    }

    if($subscription['status'] == 'CANCELLED') {
        //Enviar um e-mail pro usuário pedindo desculpas mas não foi possivel renovar o plano...
    }

    return response()->json([], 204);
});

