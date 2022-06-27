@if($index)

    <table class="product_count live_quantity">
        <tr>
            <td>
                <button onclick="var result = document.getElementById('sst{{$index}}'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 1 ) result.value--;return false;"
                    class="reduced items-count" type="button">
                    <i class="fa fa-minus"></i>
                </button>
            </td>
            <td>
                <input style="max-width:60px;text-align: center;" data-weight="{{ $cart->size??'0' }}" type="text" disabled name="qty{{$index}}" id="sst{{$index}}" maxlength="12"  value="{{ $cart->qty??'0' }}" title="Quantity:" class="input-text qty qty-weight" />
            </td>
            <td>
                <button onclick="var result = document.getElementById('sst{{$index}}'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                    class="increase items-count" type="button">
                    <i class="fa fa-plus"></i>
                </button>
            </td>
        </tr>
    </table>
                        
@endif