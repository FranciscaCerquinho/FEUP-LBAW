<div class="row" id="item_wish_list">
  <div class="col-lg-4 col-md-4 col-sm-6 mb-4">
    <a href="{{route('listAuction', ['id'=>$wishlist])}}"  class="text-center" ><img class="card-img-top auctionCardImage" src="/images/{{$wishlist->auctionphoto}}" alt="" width="230px" height="230px"></a>
  </div>
  <div class="col-lg-4 col-md-4 col-sm-6 mb-4" id="information">
    <div class="row">
      <a href="{{route('listAuction', ['id'=>$wishlist])}}">{{$wishlist->name}} </a>
    </div>
    <div class="row">
      <a class="owner_name" href="{{route('ownerProfile', ['id'=>$wishlist])}}">{{$wishlist->firstname}} {{$wishlist->lastname}}</a>
    </div>
    <div class="row">
      <p class="time">
      <script>SplitDate("{{$wishlist->dateend}}");</script> left
    </p>
    </div>
    <div class="row">
      <p class="actualprice_wishList">EUR {{$wishlist->actualprice}}</p>
    </div>
    <div class="row">
      <p class="status_winning"> @if($wishlist->active==1)
                                    Winning
                                    @endif
                                    @if($wishlist->active==0)
                                    Losing
                                    @endif
      </p>
    </div>
    <div class="row">
      <button type="button" class="btn btn-danger" style="background-color:#cb5b54">
        <span class="fas fa-trash-alt"></span> Wish List
      </button>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 mb-4" id="auction_buttons">
    <div class="row" id="bid_buttons">
      <div class="col-lg-8 col-md-8 col-sm-8 col-5" id="price">
        <?php $bid = $wishlist->actualprice + 0.01; ?>
        <input class="form-control" type="number" value="{{$bid}}" id="price_button" step="0.01">
      </div>
      <div class="col-lg-2" id="bid">
        <button class="btn btn-primary" type="submit" style="background-color:#437ab2; color:white">Make Bid</button>
      </div>
    </div>
    <div class="row">
      <div class="col-4">
        <button class="btn btn-success" type="submit" style="background-color:#73b566;color:white ">
          <i class="fas fa-shopping-cart"></i>
          Buy Now ({{$wishlist->buynow}}€)</button>
      </div>
    </div>
  </div>
</div>
