<?php

/**
 * 
 * CART AND CHECKOUT
 * ROUTE FOR THIS PACKAGE
 * 
 */
Route::group(['middleware' => ['web']], function ()
{
    /**
     * ROUTE FOR CART AND CHECKOUT
     */
    Route::prefix('cart')->group(function ()
    {

//        Route::get('test/add/item', 'Cart\App\Controllers\CartController@demoAddCart');

        /**
         * ROUTE FOR CART / SHOPPING BASKET
         */
        Route::get('/shopping/basket', 'Cart\App\Controllers\CartController@cart')->name('shopping.basket');
        Route::get('/remove/item/{id}', 'Cart\App\Controllers\CartController@delete');
        Route::post('/update/item/quantity', 'Cart\App\Controllers\CartController@updateCart');
        Route::post('/add/item', 'Cart\App\Controllers\CartController@proAddToCart');
        Route::post('/delivery/option/update', 'Cart\App\Controllers\CartController@delivery');

        /**
         * ROUTE FOR VOUCHER AND DISCOUNT CODE
         */
        Route::group(['prefix' => 'code'], function()
        {
            Route::post('/customers/apply/by/code','Cart\App\Controllers\RewardsController@addVoucherByCode')->name('apply.voucher.by.code');
            Route::post('/add/discount/code', 'Cart\App\Controllers\RewardsController@addCode')->name('add.discount.code');
            Route::get('/promotion/discount/code', 'Cart\App\Controllers\DiscountsController@index')->name('view.discount.code');
        });

        /**
         * ROUTES FOR CHECKOUT CONTROLLER
         */
        Route::group(['prefix' => 'checkout'], function()
        {
            Route::get('/', 'Cart\App\Controllers\CheckoutsController@checkout')->name('cart.checkout');
            Route::post('/orders', 'Cart\App\Controllers\CheckoutsController@store')->name('finalize.order.checkout');
        });

//        /**
//         * PAYMENT ROUTES
//         */
//        Route::group(['prefix' => 'order'], function()
//        {
//            Route::get('/checkout/pay', 'Cart\App\Controllers\Payments\StripeController@index')->name('stripe.checkout');
//            Route::post('/request/checkout/pay', 'Cart\App\Controllers\Payments\StripeController@paymentIntent')->name('stripe.checkout.pay');
//            Route::get('/checkout/success', 'Cart\App\Controllers\CartController@success')->name('checkout.success');
//            Route::get('/checkout/cancel', 'Cart\App\Controllers\CartController@cancel')->name('checkout.cancel');
//        });

    });

//    Route::post('/stripe/webhook', 'Cart\App\Controllers\Payments\StripeController@webhook')->name('stripe.checkout.pay.confirm');

});


