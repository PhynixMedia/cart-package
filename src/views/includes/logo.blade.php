@if($ispay ?? '')

<div class="header-wrap">
    @if($status ?? '')
        <a href="{{ url('/') }}" style="float: right;color: #ccc;font-size: 14px;">
            <i style="margin-right: 8px;" class="fa fa-home"></i>Home
        </a>
    @else 
        <a href="{{ route('cart.checkout') }}" style="float: right;color: #999;font-size: 14px;"><i style="margin-right: 8px;" class="fa fa-shopping-cart"></i>My Cart</a>
    @endif
    <h6><img style="height:80px;margin:-20px 0" src="{{ asset(env('APP_CHECKOUT_LOGO')) }}"/></h6>
</div>

@else 

    <div class="header-wrap">
        <h6><img style="height:80px;margin:-20px 0" src="{{ asset(env('APP_CHECKOUT_LOGO')) }}"/></h6>
    </div>

@endif
