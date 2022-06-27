                                
                                    <h6 style="margin-top:40px;">My Orders</h6>

                                    <hr />

                                    <table style="width:100%" class="checkout-cart">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Item</th>
                                                <th>Qty</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($carts as $index => $cart)

                                            @include("cart::checkout.contents.list", [ "cart"=>$cart])

                                        @endforeach

                                        </tbody>
                                    </table>
                                    
                               