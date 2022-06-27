                            <div class="price-table-body">

                                <div class="row no-gutters">

                                    <div class="col-md-6 col-lg-4">

                                        <div class="continue-shopping">
                                            <a href="{{ route('cart.checkout') }}"><i class="fa fa-arrow-left"></i> Back to Shopping cart</a>
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-6 col-lg-4">

                                    </div>

                                    <div class="col-md-6 col-lg-4">
                                   
                                                <div class="checkout">

                                                    @include("cart::includes.subtotal")
                                              
                                                    <div class="payment-icon">
                                                    <img src="{{ asset('checkout/img/payment-icon.png') }}" />
                                                    </div>
                                                </div>
                                           
                                    </div>

                                    
                                </div>

                            </div>