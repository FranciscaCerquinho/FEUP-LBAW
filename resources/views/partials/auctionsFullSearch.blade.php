<div class="col-lg-3 col-md-6 mb-4">
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
            <p class="card-text searchResultText">
            {{$auction->firstname}} {{$auction->lastname}}
            </p>
        </div>
    </div>
</div>