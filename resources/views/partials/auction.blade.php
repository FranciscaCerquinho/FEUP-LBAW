<div class="col-lg-3 col-md-4 col-sm-6 mb-4" id="auctions-list">


    <div class="card auctionCard">

    @if(isset($auction->price))
        <div class="sale-box">
            <span class="on_sale title_shop">{{$auction->price}} €</span>
        </div>
    @endif
    <a href="{{route('item', ['id'=>$auction->auction_id])}}"  class="text-center" ><img class="card-img-top auctionCardImage" src="/images/{{$auction->auctionphoto}}" alt=""></a>
    <div class="card-body auctionCardBody">
        <h4 class="card-title auctionCardTitle">
        <a href="{{route('item', ['id'=>$auction->auction_id])}}"> {{$auction->name}} </a>
        </h4>
        <h5>EUR {{$auction->actualprice}}</h5>
        <h1>
            <script>SplitDate("{{$auction->dateend}}",1);</script> left
        </h1>
        <p class="card-text auctionCardText">{{$auction->firstname}} {{$auction->lastname}}</p>
    </div>
    </div>
</div>
