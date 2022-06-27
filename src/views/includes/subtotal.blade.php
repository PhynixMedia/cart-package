@if($total = total())
    <h4>Subtotal <span><span class="subTotal">{{ money($total->total??'0') }}</span><span>£</span></span></h4>
    <h4>Delivery <span><span class="shipping_charge">{{ money($total->shipping??'0') }}</span><span>£</span></span></h4>
        @if($voucher = session()->get('voucher'))
            @php  $voucher =  (object) $voucher @endphp
            <h4>Discounts <span><span class="">{{ money($voucher->value??0) }}</span><span>£</span></span></h4>
        @endif
    <h4>ORDER TOTAL <span><span class="cart_amount_total">{{ (money((float)$total->total??0 ) + (money((float)$total->shipping??0))) - cart_discount() }}</span><span>£</span></span></h4>
@endif