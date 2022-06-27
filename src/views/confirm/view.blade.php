    @extends("cart::master")
    
    @section("content")
    
        @if($status == "success")
            @include("cart::confirm.contents.success")
        @else
            @include("cart::confirm.contents.cancel")
        @endif  

    @endsection