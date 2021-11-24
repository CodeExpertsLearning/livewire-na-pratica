<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use \App\Http\Livewire\Expense\{
    ExpenseList,
    ExpenseCreate,
    ExpenseEdit
};
use \App\Http\Livewire\Plan\{PlanList, PlanCreate};

use \Illuminate\Support\Facades\{File, Storage};

Route::get('/', function () {
    $plans = \App\Models\Plan::all();

    return view('welcome', compact('plans'));
});

Route::middleware(['auth:sanctum', 'verified', 'check.usersubscription'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function(){

    Route::prefix('expenses')->name('expenses.')->group(function(){

        Route::get('/', ExpenseList::class)->name('index');

        Route::get('/create', ExpenseCreate::class)
             ->middleware('check.amountexpenses')
             ->name('create');

        Route::get('/edit/{expense}', ExpenseEdit::class)->name('edit');

        Route::get('/{expense}/photo', function($expense) {
            $expense = auth()->user()->expenses()->findOrFail($expense);

            if(!Storage::disk('public')->exists($expense->photo))
                return abort(404, 'Image not found!');

            $image = Storage::disk('public')->get($expense->photo);

            $mimeType = File::mimeType(storage_path('app/public/' . $expense->photo));

            return response($image)->header('Content-Type', $mimeType);
        })->name('photo');
    });

    Route::prefix('plans')->name('plans.')->group(function(){

        Route::get('/', PlanList::class)->name('index');

        Route::get('/create', PlanCreate::class)->name('create');
    });

});

Route::prefix('subscription')->group(function(){

    Route::get('/choosed/{plan}', function($plan) {
            session()->put('choosed_plan', $plan);

            return redirect()->route('plan.subscription', $plan);

    })->name('choosed.plan');

    Route::get('/{plan:slug}', \App\Http\Livewire\Payment\CreditCard::class)
         ->name('plan.subscription')
         ->middleware('auth:sanctum');
});


Route::get('/notification', function() {
//   $code = '99A43B3E27273A3EE4BF2F91542E7F1A';
    $code = '9AA873A99ACF9ACF94DAA4B7CFB7AACDD985';
    $sub = (new \App\Services\PagSeguro\Subscription\SubscriptionReaderService())->getSubscriptionByNotificationCode($code);

   dd($sub);
});

Route::get('/clear-session', fn() => session()->flush());
