<?php

namespace Cart\App\Repositories;

use App\Repositories\CoreRepository;
use Cart\App\Models\Checkout;

class CheckoutRepository extends CoreRepository
{
    /** 
     * Constructor to bind model to repo
     */
    public function __construct(){

        $this->model = new Checkout();
    }

}