@extends('layouts.app',['type'=>$type])

@section('content')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-circle helpButton" data-toggle="modal" data-target="#exampleModalCenter">
    ?
  </button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Online Help </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="title">Wish List</p>
        <p>This page was created to list all the auctions the user want to follow. </p>
        <p> You can remove an auction from your wish list by clicking on <i class="fas fa-trash-alt"></i>.</p>
      </div>
    </div>
  </div>
</div>
<div id="wish_list" class="container-fluid">
  <div class="row">
    <div class="col-sm-12 sb-4">
      <h2 class="users">Wish List</h2>
      <hr class="style17" style="color:grey;">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="/auctions">
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

<div class="card container-md-4 wishListCard" @if($num_elems==0)style="margin-bottom: 210px"@endif>
    <div class="card-body">
        <!-- Shopping Cart table -->
        <div class="table-responsive">
            <div class="row" id="wishListHeader">
              <div class="col-sm-2">
              </div>
              <div class="col-sm-3">
                <h3>Auction</h3>
              </div>
              <div class="col-sm-2">
                <h3>Owner</h3>
              </div>
              <div class="col-sm-2">
                <h3>Price</h3>
              </div>
              <div class="col-sm-2">
                <h3>Time Left</h3>
              </div>
              <div class="col-sm-1">
              </div>
            </div>

  <?php for($i = 0; $i < $num_elems; $i++) {?>
          @include('partials.WishListAuction',['wishList'=>$wishList[$i]])
      <?php } ?>
    <div class="row wishListTotal">
      <div class="col-sm-8">  </div>
      <div class="col-sm-2">
        <h4 class="mt-2">
            <strong>Total</strong>
        </h4>
      </div>
      <div class="col-sm-2">
        <h4 class="mt-2" id="totalWishList">
            <strong>{{$num_elems}}</strong>
        </h4>
      </div>
    </div>
        <!-- /.Shopping Cart table -->
    </div>
</div>
</div>
@endsection
