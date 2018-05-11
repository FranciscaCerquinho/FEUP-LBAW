@extends('layouts.app',['type'=>$type])

@section('content')

<div id="wish_list" class="container-fluid">
  <div class="row">
    <div class="col-sm-12 sb-4">
      <h2 class="users">Wish List</h2>
      <hr class="style17" style="color:grey;">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="./index.html">
              <i class="fas fa-home"></i>
              Home
            </a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Wish List</li>
        </ol>
      </nav>
    </div>
  </div>
  <!--Auctions cards-->

  <?php
  $num_elems = count($wishList);
  ?>
  <div class="next_auctions">
  <?php for($i = 0; $i < $num_elems; $i++) {?>
          <div class="row">
          @include('partials.WishListAuction',['wishlist'=>$wishlist[$i]])
          </div>
      <?php } ?>
  </div>


  <ul id="pag" class="pagination col-lg-12"></ul>


</div>

@endsection
