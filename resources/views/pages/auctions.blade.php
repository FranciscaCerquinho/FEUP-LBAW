@extends('layouts.app')

@section('content')
<div class="container-fluid bg-1">

<div class="new_auctions">
        <div class="row">
          <!-- auction -->
            <div class="col-lg-3 col-md-4 mb-4">
              <div class="card h-100">
                <a href="item.html"><img class="card-img-top" src="{{auction()->photo}}" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="item.html"> {{auction()->name}} </a>
                  </h4>
                  <h5>{{auction()->actualPrice}}</h5>
                  <h1>{{auction()->dateEnd}}</h1>
                  <p class="card-text" value= "{{auction()->id}}">
                </div>
              </div>
            </div>
          </div>
</div>

<!-- pagination -->

@endsection
