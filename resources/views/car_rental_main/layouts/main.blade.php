
<!DOCTYPE html>
<html lang="en">

@include('car_rental_main.includes.head', ['title' => 'Car Rental'])



<body>

    
    <div class="site-wrap" id="home-section">


        @include('car_rental_main.includes.site_navbar')
        @include('car_rental_main.includes.top_header')

        @yield('content')


        @include('car_rental_main.includes.footer')

    </div>

    <script src="{{ asset('assets/main/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/main/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/main/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/main/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/main/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('assets/main/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/main/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('assets/main/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('assets/main/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('assets/main/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/main/js/aos.js') }}"></script>
    <script src="{{ asset('assets/main/js/main.js') }}"></script>

    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>

    <!-- Custom scripts -->
    @yield('scripts')


</body>

</html>

