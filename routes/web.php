<?php
// Razorpay callback GET fallback (mobile/in-app browsers)
use Vfixtechnology\Razorpay\Http\Controllers\RazorpayController;

Route::get('razorpaycheck', [RazorpayController::class, 'verify'])
    ->name('razorpay.callback.get');

Route::get('/blog/m3-max-drone', function () {
    return view('shop::blog.m3_max_drone');
})->name('shop.blog.m3_max_drone');
