<div class="row justify-content-center">

                <!-- Single Price Table Area -->

                <div class="col-sm-10 col-md-9 col-lg-6">

                    <div class="single-price-table-area">

                        <div class="row">
                            
                            <div class="col-md-12 col-lg-12">
                                <div class="price-table-heading">
                                    
                                    @include("cart::includes.logo",["ispay"=>true, "status"=>true])

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
                                    <h3 style="text-align: center">Payment Successful</h3>
                                    

                                    <div class="row">

                                        <div class="col-md-12 col-lg-12">

                                            <div class="icon_wrap" style="fill: green;width:100px;text-align: center;min-height:200px;color:green">

                                                <svg class="svg-icon" viewBox="0 0 20 20" style="position:relative;left: 50%;top:50%">
                                                    <path d="M10.219,1.688c-4.471,0-8.094,3.623-8.094,8.094s3.623,8.094,8.094,8.094s8.094-3.623,8.094-8.094S14.689,1.688,10.219,1.688 M10.219,17.022c-3.994,0-7.242-3.247-7.242-7.241c0-3.994,3.248-7.242,7.242-7.242c3.994,0,7.241,3.248,7.241,7.242C17.46,13.775,14.213,17.022,10.219,17.022 M15.099,7.03c-0.167-0.167-0.438-0.167-0.604,0.002L9.062,12.48l-2.269-2.277c-0.166-0.167-0.437-0.167-0.603,0c-0.166,0.166-0.168,0.437-0.002,0.603l2.573,2.578c0.079,0.08,0.188,0.125,0.3,0.125s0.222-0.045,0.303-0.125l5.736-5.751C15.268,7.466,15.265,7.196,15.099,7.03"></path>
                                                </svg>

                                            </div>
                                            <div class="confirm-description">
                                                Thank you for your order!
                                            </div>

                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="checkout-summary">
                            
                            <div class="price-table-body">
                                <div class="row no-gutters">

                                    <div class="col-md-12 col-lg-12">

                                        <div class="continue-shopping">
                                            <a href="{{ url('/') }}"><i class="fa fa-arrow-left"></i> Back to Home</a>
                                        </div>
                                        
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- End of section -->
                        
                    </div>
                    
                </div>

            </div>