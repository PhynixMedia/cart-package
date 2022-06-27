                                        
   @if($cart ?? '')   

    @if(array_key_exists("qty", (array) $cart) && array_key_exists("price", (array) $cart))

   @php $cart = (object)$cart; @endphp                         
                                        
                                        
        <tr class="wrap-items" id="{{ $index }}">
            <td>
                <a class="link" href="{{ $cart->link ??'' }}">
                    <img style="width:70px;height:auto" alt="{{ $cart->name ??'' }}" class="image" src="{{ $cart->image ??'' }}" alt="">
                </a>
            </td>
            <td>
                <p>{{ $cart->name ??'' }}</p>
                <a href="{{ $cart->link ??'' }}">View Details</a> | 
                <a href="javascript:;" class="remove-item"><i class="fa fa-times"></i> Delete</a>
            </td>
            <td class="product-quantity">
                @include('cart::cart.contents.quantity', ['index'=>$index, "cart"=>$cart])
                                               
            <td class="product-price-cart">
                {{ currency() }}
                  <span class="amount item-price">{{ $cart->price ??0 }}</span>
            </td>
            <td class="product-subtotal">
                <span class="row-total">{{ money((float)$cart->qty*(float)$cart->price) }}</span>
            </td>
        </tr>

   @endif

@endif