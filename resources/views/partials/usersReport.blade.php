<div class="row" id="usersReported">
    <div class="col-md-3 col-sm-3">
        <span style="color:#0c59cf">{{$reported_users->firstname}} {{$reported_users->lastname}}</span>
    </div>
    <div class="col-md-3 col-sm-3">
        <span style="color:#0c59cf">{{$reporting_users->firstname}} {{$reporting_users->lastname}}</span>
    </div>
    <div class="col-md-4 col-sm-3">
        <span span style="color:#0c59cf">{{$reported_users->reason}}</span>
    </div>
    <div class="col-md-2 col-sm-3">
        <input class="banUser" type="checkbox"> Ban </input>
    </div>
</div>