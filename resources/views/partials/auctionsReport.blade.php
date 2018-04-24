<div class="row" id="auctionsReported">
    <div class="col-md-3 col-sm-3">
        <a href="{{route('item', ['id'=>$reported_auctions->auction_id])}}">{{$reported_auctions->name}}</a>
    </div>
    <div class="col-md-3 col-sm-3">
        <span style="color:#0c59cf">{{$reported_auctions->firstname}} {{$reported_auctions->lastname}}</span>
    </div>
    <div class="col-md-3 col-sm-3">
        <input class="check" type="checkbox" checked> Ban </input>
    </div>
</div>