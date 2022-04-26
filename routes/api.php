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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/subscribe', function (Request $request) {
//    return response()->json($request->all());
    $stripe = new \Stripe\StripeClient(
        'sk_test_51IeLv4DHFpZchNKgybWgFnpYPbVy3M3YieAU7E1i2k5A0VJqjJ7SWVFNkTnxxmUpvAO9JGC5vn3nrlQi4doRyv9000JHiFUUsW'
    );
    $setupIntent = $stripe->setupIntents->create([
        'payment_method_types' => ['card'],
    ]);
    return response()->json($setupIntent);
    /*$request->user()->newSubscription(
        'default', 'price_monthly'
    )->create($request->paymentMethodId);*/
})->name('subscribe');
