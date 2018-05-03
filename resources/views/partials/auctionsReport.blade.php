<?php $date= new DateTime($reported_auctions->date);
$date_string = $date->format('Y-m-d');?>
<div class="row" id="auctionsReported">
    <div class="col-md-2 col-sm-3">
        <a href="{{route('item', ['id'=>$reported_auctions->auction_id])}}">{{$reported_auctions->name}}</a>
    </div>
    <div class="col-md-2 col-sm-3">
        <span style="color:#0c59cf">{{$reported_auctions->firstname}} {{$reported_auctions->lastname}}</span>
    </div>
    <div class="col-md-5 col-sm-3">
        <span span style="color:#0c59cf">{{$reported_auctions->reason}}</span>
    </div>
    <div class="col-md-1 col-sm-3">
        <span style="color:#0c59cf">{{$date_string}} </span>
    </div>
    <div class="col-md-1 col-sm-3">
        <input class="check" type="checkbox" @if($ban==1)checked @endif> Ban </input>
    </div>
</div>