<div class="col-12 col-lg-3 col-md-3 col-sm-6 mb-4 " id="auctions-list" data-id="{{$auction->auction_id}}">

<div class="card-deck align-items-center">
  <div class="card auctionCard" >
  @if(isset($auction->price))
        <div class="sale-box">
            <span class="on_sale title_shop">{{$auction->price}} €</span>
        </div>
    @endif
    <a href="{{route('item', ['id'=>$auction->auction_id])}}"><img class="card-img-top auctionCardImage" src="/images/{{$auction->auctionphoto}}" alt="Card image cap"></a>
    <div class="card-body auctionCardBody">
      <h4 class="card-title auctionCardTitle"> <a href="{{route('item', ['id'=>$auction->auction_id])}}"> {{$auction->name}} </a></h4>
      <h5>EUR {{$auction->actualprice}}</h5>
      <p class="time_left">
        <script>SplitDate("{{$auction->dateend}}",1);</script> left
      </p>
      <p class="card-text auctionCardText">{{$auction->firstname}} {{$auction->lastname}}</p>
    </div>
  </div>
</div>
</div>
