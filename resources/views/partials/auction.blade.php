<div class="col-lg-3 col-md-4 col-sm-6 mb-4" id="auctions-list">
    <div class="card auctionCard">
    <a href="item.html"  class="text-center" ><img class="card-img-top auctionCardImage" src="/images/{{$auction->auctionphoto}}" alt=""></a>
    <div class="card-body auctionCardBody">
        <h4 class="card-title auctionCardTitle">
        <a href="item.html"> {{$auction->name}} </a>
        </h4>
        <h5>EUR {{$auction->actualprice}}</h5>
        <h1>
            <script>SplitDate("{{$auction->dateend}}");</script>
        </h1>
        <p class="card-text auctionCardText">{{$auction->firstname}} {{$auction->lastname}}</p>
    </div>
    </div>
</div>
