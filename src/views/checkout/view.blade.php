@extends("cart::master")
    
    @section("content")

            <div class="row justify-content-center">
                <!-- Single Price Table Area -->
                <div class="col-md-12 col-lg-12">
                    <div class="single-price-table-area">
                        
                        @include("cart::includes.nav")
                        
                        <form action="{{ route('finalize.order.checkout') }}" method="post">

                        @csrf
                        <!-- Body Text -->
                            <div class="price-table-body">

                                <div class="row">

                                    @include("cart::checkout.contents.form")    

                                    <div class="col-md-6 col-lg-5">

                                        @include("cart::checkout.contents.account")

                                        @include("cart::checkout.contents.orders")

                                    </div>

                                </div>
                                
                            </div>

                            <div class="checkout-summary">
                                
                                @include("cart::checkout.contents.summary")

                            </div>
                            <!-- End of section -->

                        </form>
                        
                    </div>
                    
                </div>

            </div>
        
@endsection