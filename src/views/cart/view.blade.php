@extends("cart::master")

@section("content")

    <div class="row justify-content-center">
        <!-- Single Price Table Area -->
        <div class="col-md-12 col-lg-12">
            <div class="single-price-table-area">

            @include("cart::includes.nav")

            <!-- Body Text -->
                <div class="price-table-body">
                    <div class="col-md-12 col-lg-12">

                        <table style="width:100%" class="shopping-cart">
                            <thead>
                            <tr>
                                <th width="90px"></th>
                                <th>Item</th>
                                <th width="200px">Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($carts as $index => $cart)

                                @include("cart::cart.contents.list", ["index"=>$index, "cart"=>$cart])

                            @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="cart-summary">

                    @include("cart::cart.contents.summary")

                </div>
                <!-- End of section -->

            </div>

        </div>

    </div>


@endsection