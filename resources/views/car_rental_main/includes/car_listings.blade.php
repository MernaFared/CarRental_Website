<div class="site-section bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
          <h2 class="section-heading"><strong>Car Listings</strong></h2>
          <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>    
        </div>
      </div>
      

      <div class="row">
        @foreach($latestCars as $car)
          <div class="col-md-6 col-lg-4 mb-4">

            <div class="listing d-block  align-items-stretch">
              {{-- <div class="listing-img h-100 mr-4">
                <img src="{{asset('assets/images/cars/' . $car->image)}}" alt="Image" class="img-fluid">
              </div> --}}
              <div class="listing-img h-100 mr-4">
                <img src="{{asset('assets/images/cars/' . $car->image)}}" alt="Image" class="img-fluid" style="width: 310px; height: 248px;">
            </div>
            
              
              <div class="listing-contents h-100">
                <h3>{{$car->title}}</h3>
                <div class="rent-price">
                  <strong>${{$car->price}}</strong><span class="mx-1">/</span>day
                </div>
                <div class="d-block d-md-flex mb-3 border-bottom pb-3">
                  <div class="listing-feature pr-4">
                    <span class="caption">Luggage:</span>
                    <span class="number">{{$car->luggage}}</span>
                  </div>
                  <div class="listing-feature pr-4">
                    <span class="caption">Doors:</span>
                    <span class="number">{{$car->doors}}</span>
                  </div>
                  <div class="listing-feature pr-4">
                    <span class="caption">Passenger:</span>
                    <span class="number">{{$car->passengers}}</span>
                  </div>
                </div>
                <div>
                  {{-- <p>{{ strlen($car->description) > 100 ? substr($car->description, 0, 100) . '...' : $car->description }}</p> --}}

                  <p style="max-height: 3.6em; /* (2 * line-height) + line-height/2 */
                  overflow: hidden;
                  min-height: 3.6em;
                  text-overflow: ellipsis;
                  display: -webkit-box;
                  -webkit-line-clamp: 2; /* Limit the number of lines to 2 */
                  -webkit-box-orient: vertical;">
                      {{ strlen($car->description) > 100 ? substr($car->description, 0, 100) . '...' : $car->description }}
                  </p>
       
                  <p><a href="{{route('carDetails', $car->id)}}" class="btn btn-primary btn-sm">Rent Now</a></p>
                </div>
              </div>

            </div>
          </div>
        @endforeach
    

      

      </div>
    </div>
  </div>