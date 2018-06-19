<div class="col-lg-3 col-md-6 mb-3  auctions-list" data-id="{{$auction->auction_id}}">
    <div class="card h-100 auctionCard searchCard">
        <a href="{{route('item', ['id'=>$auction->auction_id])}}">
            <img class="card-img-top searchResultImage" src="/images/{{$auction->auctionphoto}}" alt="">
        </a>
        @if(isset($auction->price))
              <div class="sale-box">
                  <span class="on_sale title_shop">{{$auction->price}} €</span>
              </div>
          @endif
        <div class="card-body searchResultBody">
            <h5 class="card-title searchResultTitle">
                <a href="{{route('item', ['id'=>$auction->auction_id])}}">{{$auction->name}}</a>
            </h5>
            <h4 class="auctionPrice">EUR {{$auction->actualprice}}</h5>
            <h6 class="auctionTimeLeft"> <script>SplitDate("{{$auction->dateend}}",1);</script> left</h1>
            <p class="card-text searchResultText" class="owner-name">
            {{$auction->firstname}} {{$auction->lastname}}
            </p>
        </div>
    </div>
</div>
