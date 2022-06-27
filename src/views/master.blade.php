<!doctype html>
<html class="no-js" lang="en">

    @include('cart::includes.header')

    <body>

        <!-- Preloader -->
            <div id="preloader">
                <div class="loader"></div>
            </div>
        <!-- /Preloader -->

        <div class="price-table-area gray-bg section-padding-100-50" id="price">
            <div class="container">

                <div class="row justify-content-center">
                    <!-- Single Price Table Area -->
                    <div class="col-md-12 col-lg-12">
        
                        <!-- end insertion -->
                        
                        @yield('content')

                        
                    </div>
                </div>
            </div>
        </div>

        @include('cart::includes.footer')

    </body>

</html>