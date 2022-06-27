<?php

namespace Carts\Cart\Controllers;

use App\Http\Controllers\Controller;
use Carts\Cart\Services\DiscountService;
use Carts\Cart\Services\Session;
use Exception;

class DiscountsController extends Controller {

    protected $discountService;

    public function __construct(){

        $this->discountService = new DiscountService();
    }

    public function index(){

        $codes = $this->discountService->all();
        return view('cart::pages.discount.discount', compact('codes'));
    }

    

}