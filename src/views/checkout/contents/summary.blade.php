                            <div class="price-table-body">
                                <div class="row no-gutters">
                                    <div class="col-md-5 col-lg-4">
                                        
                                        <div class="continue-shopping">
                                            <a href="{{ route('shopping.basket') }}"><i class="fa fa-arrow-left"></i> Back to Shopping cart</a>
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
                                                        I agree to terms & conditions
                                                    </p>
                                                    <button>Checkout & Make Payment </button>

                                                    <div class="payment-icon">
                                                        <img src="{{ asset('checkout/img/payment-icon.png') }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>