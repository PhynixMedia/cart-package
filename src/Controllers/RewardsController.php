<?php

namespace Carts\Cart\Controllers;

use Carts\Cart\Services\CartService;
use Carts\Cart\Services\DiscountService;
use Carts\Cart\Services\Session;
use Carts\Cart\Resources\MailDataResource;
use Exception;

use Carts\Cart\Requests\CreateCartRequests;
use Carts\Cart\Requests\UpdateCartRequests;
use Carts\Cart\Requests\CheckoutRequests;
use Carts\Cart\Requests\ApplyDiscountCodeRequest;
use Carts\Cart\Requests\AddVoucherByCodeRequest;
use Carts\Cart\Requests\UpdateCartDeliveryRequests;

use Account\App\Services\ServiceLoader;
use Account\App\Services\ServicesConstants as Constants;

use App\Http\Controllers\Controller;
use Carts\Cart\Traits\Checkout;

class RewardsController extends Controller
{

    use Checkout;

    protected $cartService;
    protected $rewardService;

    public function __construct(ServiceLoader $services, CartService $cartService)
    {

        $this->cartService = $cartService;
        $this->rewardService = $services->load(Constants::REWARD_SERVICE);
    }

    /**
     * Customer add Code to cart
     */
    public function addCode(ApplyDiscountCodeRequest $request)
    {

        return back()->withError('Coupon Code Service not available');

        $key = 'discounts';

        $code = $request->get('coupon_code');

        if ($this->checkCode($key, $code)) {
            return back()->withError('Code has already been used for this order');
        }

        $coupon = (new DiscountService())->find($request);

        if ($coupon) {

            $discounts = session()->get($key) ?? [];

            $new = [];
            $new[$code] = $coupon;
            session()->put($key, array_merge($discounts, $new));

            return back()->withSuccess(currency() . $coupon->value . '  Discount has been added to your order');
        }

        return back()->withError('Invalid or Expired Discount Code');
    }

    /**
     * This check if coupon code is added already or not
     */
    public function checkCode($key, $code)
    {

        $discounts = session()->get($key) ?? [];
        return (array_key_exists($code, $discounts)) ? true : false;
    }

 
    /**
     * Customer add voucher to basket items cost
     */
    public function addVoucherByCode(AddVoucherByCodeRequest $request)
    {

        return back()->withError('Voucher Code Service not available');

        if (auth()->guard('appuser')->check())
        {
            $userid = auth()->guard('appuser')->user()->id;

            $params = [
                'customers_id' => $userid,
                'voucher_code' => $request->get('voucher_code'),
                'status' => 1
            ];

            if ($voucherData = $this->rewardService->findVoucher($params)) {

                $value = (float) $voucherData->price ?? 0;

                $min_order = (float) $voucherData->min_order ?? 0;

                //minimum order is met
                if ($min_order >= total()->total ?? 0)
                {
                    return back()->withError('Pls, minimum order required for this voucher must be above ' . currency() . $min_order);
                }

                //prevent multiple voucher per order
                if (session()->get('voucher'))
                {
                    return back()->withError('Sorry! You already have a voucher in this order! Voucher: ' . strtoupper($voucherData->voucher_code ?? ''));
                }

                unset($params['status']);

                if ($this->rewardService->applyVoucher($params)) {
                    session()->put('voucher', [
                        'value' => $value ?? 0,
                        'voucher_code' => $voucherData->voucher_code ?? '--invalid--'
                    ]);
                }

                return back()->withSuccess('Voucher successfully applied to your order');
            }

            return back()->withError('Invalid or Expired Voucher. Please, email ' . env('APP_ENQUIRY'));
        }

        return back()->withError('We are unable to process this request');
    }

}
