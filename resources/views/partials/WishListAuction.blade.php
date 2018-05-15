<div class="row product align-items-center" id="itemWishList" data-id="{{$wishList->wishlist_id}}">
  <div class="col-sm-2">
    <a href="{{route('item', ['id'=>$wishList->auction_id])}}">
        <img src="/images/{{$wishList->auctionphoto}}" alt="" class="img-fluid z-depth-0">
    </a>
  </div>
  <div class="col-sm-3">
      <h5 class="mt-3">
          <strong>{{$wishList->name}}</strong>
      </h5>
  </div>
  <div class="col-sm-2">
    <a class="owner_name" href="{{route('ownerProfile', ['id'=>$wishList->user_id])}}">{{$wishList->firstname}} {{$wishList->lastname}}</a>
  </div>
  <div class="col-sm-2">
      <strong>EUR {{$wishList->actualprice}}</strong>
  </div>
  <div class="col-sm-2" > <script>SplitDate("{{$wishList->dateend}}",1);</script> left</div>
  <div class="col-sm-1">
      <button type="button" id="remove_from_wishlist" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remove item">
        <i class="fas fa-trash-alt"></i>
      </button>
  </div>
</div>
<hr class="style17 wishListHr" style="color:grey;">
