<!--<div class="col-12 col-lg-3 col-md-3 col-sm-6 mb-4 auctions-list" data-id="{{$auction->auction_id}}">

<div class="card-deck h-100 align-items-center">
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
</div>-->

<div class="col-lg-4 col-md-6 mb-3  auctions-list" data-id="{{$auction->auction_id}}">
    <div class="card h-100 auctionCard searchCard">
        <a href="{{route('item', ['id'=>$auction->auction_id])}}">
            <img class="card-img-top searchResultImage" src="/images/{{$auction->auctionphoto}}" alt="">
        </a>
        <div class="card-body searchResultBody">
            <h5 class="card-title searchResultTitle">
                <a href="{{route('item', ['id'=>$auction->auction_id])}}">{{$auction->name}}</a>
            </h5>
            <h4 class="auctionPrice">EUR {{$auction->actualprice}}</h5>
            <h6 class="auctionTimeLeft"> <script>SplitDate("{{$auction->dateend}}",1);</script> left</h1>
            <p class="card-text searchResultText" id="owner-name">
            {{$auction->firstname}} {{$auction->lastname}}
            </p>
        </div>
    </div>
</div>
