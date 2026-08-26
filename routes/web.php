<?php

use App\Http\Controllers\PartialCodController;
use Vfixtechnology\Razorpay\Http\Controllers\RazorpayController;

Route::get('razorpaycheck', [RazorpayController::class, 'verify'])
    ->name('razorpay.callback.get');

Route::group(['middleware' => ['web']], function () {
    Route::get('partial-cod-redirect', [PartialCodController::class, 'redirect'])->name('partial_cod.process');
    Route::post('partial-cod-check', [PartialCodController::class, 'verify'])->name('partial_cod.callback');
    Route::get('partial-cod-check', [PartialCodController::class, 'verify'])->name('partial_cod.callback.get');
});

Route::get('/blog/m3-max-drone', function () {
    return view('shop::blog.m3_max_drone');
})->name('shop.blog.m3_max_drone');
