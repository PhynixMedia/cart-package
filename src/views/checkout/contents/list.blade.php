
@if($cart ?? '')   

    @if(array_key_exists("qty", (array) $cart) && array_key_exists("price", (array) $cart))

    @php $cart = (object)$cart; @endphp  

    <tr>
        <td>
            <img alt="{{ $cart->name ??'' }}" class="image" src="{{ $cart->image ??'' }}" alt="">
        </td>
        <td>
            <p>{{ $cart->name ??'' }}</p>
            <a href="#">Price: {{ currency() }}{{ $cart->price ??0 }}</a>
        </td>
        <td>x{{ $cart->qty ?? 1 }}</td>
        <td>{{ currency() }}{{ money((float)$cart->qty*(float)$cart->price) }}</td>
    </tr>


@endif

@endif