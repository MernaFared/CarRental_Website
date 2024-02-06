@extends('car_rental_main.layouts.main')

@section('title', 'Car Rental')

@section('content')

     <!-- page content -->

     @include('car_rental_main.includes.rent_car')



     @include('car_rental_main.includes.how_works')

   
   
     @include('car_rental_main.includes.promo_renting_car')

   

     @include('car_rental_main.includes.car_listings')

     @include('car_rental_main.includes.features')

     @include('car_rental_main.includes.home_testimonials')

     @include('car_rental_main.includes.waiting_for')

   
    <!-- /page content -->

   
@endsection
