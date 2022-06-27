<div class="row justify-content-center">
                <!-- Single Price Table Area -->
                <div class="col-sm-10 col-md-9 col-lg-6">
                    <div class="single-price-table-area">
                        <div class="row">
                            
                            <div class="col-md-12 col-lg-12">

                                <div class="price-table-heading">
                                    
                                    @include("cart::includes.logo",["ispay"=>true, "status"=>false])

                                </div>
                                
                            </div>
                            
                        </div>
                        
                        <!-- Body Text -->
                        <div class="price-table-body">
                            <div class="row">

                                <style>
                                    .icon_wrap {
                                        position: relative;
                                        top: 70px;
                                        left: 25%;
                                        /* -moz-transform: translateX(-50%) translateY(-50%);
                                        -webkit-transform: translateX(-50%) translateY(-50%);
                                        transform: translateX(-50%) translateY(-50%); */
                                    }
                                    .confirm-description{
                                        text-align: center;
                                    }
                                </style>
                                
                                <div class="col-md-12 col-lg-12">
                                    <h3 style="text-align: center">Payment Declined</h3>
                           
                                    <div class="row">

                                        <div class="col-md-12 col-lg-12">

                                            <div class="icon_wrap" style="fill: red;width:100px;text-align: center;min-height:200px;color:green">

                                                <svg class="svg-icon" viewBox="0 0 20 20" style="position:relative;left: 50%;top:50%">
                                                    <path d="M10.185,1.417c-4.741,0-8.583,3.842-8.583,8.583c0,4.74,3.842,8.582,8.583,8.582S18.768,14.74,18.768,10C18.768,5.259,14.926,1.417,10.185,1.417 M10.185,17.68c-4.235,0-7.679-3.445-7.679-7.68c0-4.235,3.444-7.679,7.679-7.679S17.864,5.765,17.864,10C17.864,14.234,14.42,17.68,10.185,17.68 M10.824,10l2.842-2.844c0.178-0.176,0.178-0.46,0-0.637c-0.177-0.178-0.461-0.178-0.637,0l-2.844,2.841L7.341,6.52c-0.176-0.178-0.46-0.178-0.637,0c-0.178,0.176-0.178,0.461,0,0.637L9.546,10l-2.841,2.844c-0.178,0.176-0.178,0.461,0,0.637c0.178,0.178,0.459,0.178,0.637,0l2.844-2.841l2.844,2.841c0.178,0.178,0.459,0.178,0.637,0c0.178-0.176,0.178-0.461,0-0.637L10.824,10z"></path>
                                                </svg>

                                            </div>
                                            <div class="confirm-description">
                                                Sorry! We are unable to process this payment.
                                            </div>

                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="checkout-summary">
                            
                            <div class="price-table-body">
                                <div class="row no-gutters">

                                    <div class="col-md-12 col-lg-8">

                                        <div class="continue-shopping">
                                            <a href="{{ route('stripe.checkout') }}"><i class="fa fa-arrow-left"></i> Back to MAKE PAYMENT</a>
                                        </div>
                                        
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- End of section -->
                        
                    </div>
                    
                </div>

            </div>