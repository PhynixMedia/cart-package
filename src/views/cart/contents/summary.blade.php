<div class="price-table-body">
                                <div class="row">
                                    <div class="col-md-5 col-lg-4">
                                        
                                        <div class="rewards coupon">
                                            <h4>Add Coupon</h4>
                                            <div class="wrap">
                                                <input type="text" />
                                                <button>Add Now</button>
                                            </div>
                                        </div>

                                        <div class="rewards voucher">
                                            <h4>Add Voucher</h4>
                                            <div class="wrap">
                                                <input type="text" />
                                                <button>Add Now</button>
                                            </div>
                                        </div>
                                        <div class="continue-shopping">
                                            <a href="{{ url('/') }}"><i class="fa fa-arrow-left"></i> Continue Shopping</a>
                                        </div>

                                    </div>
                                    <div class="col-md-7 col-lg-8">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-5">
                                                <div class="checkout">
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-lg-7">
                                                
                                                <div class="checkout">
                                                    @include("cart::includes.subtotal")
                                                    <p>
                                                        <input type="checkbox" name="" value="yes" />
                                                        I agree to terms & conditions
                                                    </p>
                                                    <a href="{{ route('cart.checkout') }}" class="cart_button">Proceed to checkout</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>