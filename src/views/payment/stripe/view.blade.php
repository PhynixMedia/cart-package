@extends("cart::master")
    
    @section("content")
    
            <div class="row justify-content-center">
                <!-- Single Price Table Area -->
                <div class="col-md-12 col-lg-12">
                    <div class="single-price-table-area">
                    
                        @include("cart::includes.nav")
                        
                        <!-- Body Text -->
                        @include("cart::payment.contents.content")

                        <div class="checkout-summary">
                            
                            @include("cart::payment.contents.summary")

                        </div>
                        <!-- End of section -->
                        
                    </div>
                    
                </div>

            </div>

    @endsection