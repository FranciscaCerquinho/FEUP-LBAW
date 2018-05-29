@extends('layouts.app')

@section('title', 'Add Auction')
@section('content')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-circle helpButton" data-toggle="modal" data-target="#exampleModalCenter">
    ?
  </button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Online Help </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="title">Want to add an auction?</p>
        <p>You just have to change the field and click on <b>"Start Auction"</b>. </p>
        <p class="title">What is the initial price?</p>
        <p>Is the price that you want to start the auction.</p>
        <p class="title">What is the Buy Now price?</p>
        <p>The price that is given if a user wants to buy the auction on time.</p>
        <p>Don't forget <b>"Buy Now" </b> price should be higher than <b>"Initial Price"</b> </p>
        <p><b>Good Luck!</p>
      </div>
    </div>
  </div>
</div>

<div class="add_auction container-fluid">
    <div class="row">
        <div class="col-sm-12 sb-4">
        <h2 class="users">Add Auction</h2>
        <hr class="style17" style="color:grey;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/auctions">
                <i class="fas fa-home"></i>
                Home
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Add Auction</li>
            </ol>
        </nav>
    </div>
    </div>
        @if(isset($alert))
            @if ($alert!="")
            <div class="alert alert-danger alert-dismissable" role="alert">
                <a class="panel-close close" data-dismiss="alert">x</a>
                <i class="fas fa-bell"></i>
                {!!$alert!!}
            </div>
            @endif
        @endif
        @if ($errors->has('category'))
            <div class="alert alert-danger alert-dismissable" role="alert">
                <a class="panel-close close" data-dismiss="alert">x</a>
                <i class="fas fa-bell"></i>
                {{ $errors->first('category') }}
            </div>
        @endif
        @if ($errors->has('name'))
            <div class="alert alert-danger alert-dismissable" role="alert">
                <a class="panel-close close" data-dismiss="alert">x</a>
                <i class="fas fa-bell"></i>
                {{ $errors->first('name') }}
            </div>
        @endif
        @if ($errors->has('photo'))
            <div class="alert alert-danger alert-dismissable" role="alert">
                <a class="panel-close close" data-dismiss="alert">x</a>
                <i class="fas fa-bell"></i>
                {{ $errors->first('photo') }}
            </div>
        @endif 
        @if ($errors->has('dateEnd'))
            <div class="alert alert-danger alert-dismissable" role="alert">
                <a class="panel-close close" data-dismiss="alert">x</a>
                <i class="fas fa-bell"></i>
                {{ $errors->first('dateEnd') }}
            </div>
        @endif 
        @if ($errors->has('description'))
            <div class="alert alert-danger alert-dismissable" role="alert">
                <a class="panel-close close" data-dismiss="alert">x</a>
                <i class="fas fa-bell"></i>
                {{ $errors->first('description') }}
            </div>
        @endif
        @if ($errors->has('buyNow'))
            <div class="alert alert-danger alert-dismissable" role="alert">
                <a class="panel-close close" data-dismiss="alert">x</a>
                <i class="fas fa-bell"></i>
                {{ $errors->first('buyNow') }}
            </div>
        @endif
        <form id="taskForm" action="{{ route('addAuction') }}" enctype="multipart/form-data" method="post" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group row">
                <div class="col-lg-4">
                    <input type="text" class="form-control" name="name" placeholder="Auction name" />
                </div>
                <div class="col-lg-2">
                    <select class="form-control" name="category" id="sel1">
                        <option>Electronics</option>
                        <option>Fashion</option>
                        <option>Home & Garden</option>
                        <option>Motors</option>
                        <option>Music</option>
                        <option>Toys</option>
                        <option>Daily Deals</option>
                        <option>Sporting</option>
                        <option>Others</option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <input type="number" step="0.01" class="form-control" name="actualPrice" placeholder="Initial price (in Eur)" />
                </div>
                <div class="col-lg-2">
					<div class="input-group date" id="datetimepicker1" data-target-input="nearest">
						<input type="text" class="form-control datetimepicker-input" name="dateEnd" data-target="#datetimepicker1" placeholder="End Date"/>
						<div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
							<div class="input-group-text"><i class="fa fa-calendar"></i></div>
						</div>
					</div>
				</div>
                
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <textarea class="form-control" id="exampleTextarea" rows="3" name="description" placeholder="Description"></textarea>
                </div>
                <div class="col-lg-4">
                    <!-- image-preview-filename input [CUT FROM HERE]-->
                    <div class="input-group image-preview">
                        <input type="text" class="form-control image-preview-filename" id="imageName" disabled="disabled">
                        <!-- don't give a name === doesn't send on POST/GET -->
                        <div class="input-group-btn">
                            <!-- image-preview-clear button -->
                            <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                <span class="glyphicon glyphicon-remove"></span> Clear
                            </button>
                            <!-- image-preview-input -->
                            <div class="btn btn-default image-preview-input">
                                <div class="input-group-prepend">
                                    <span>
                                        <i class="fas fa-folder-open"></i>
                                    </span>
                                    <span class="image-preview-input-title">Add an image</span>
                                    <input type="file" name="photo" id="photo" class="item-photo" accept="image/*" />
                                    <script type="text/javascript">
                                        $("#photo").on('change', function(){
                                            document.getElementById("imageName").value=document.getElementById("photo").value;
                                        })
                                    </script>
                                    <!-- rename it -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /input-group image-preview [TO HERE]-->
                </div>
                <div class="col-lg-2">
					<input type="number" step="0.01" class="form-control" name="buyNow" placeHolder="Buy-Now price (in EUR)" />
				</div>
            </div>
            <div class="form-group" id="add_auction_buttons">
                <button class="btn submitAuction" style="font-size:16px;background-color:#437ab2; color:white" type="submit">Start auction</button>
            </div>
    </div>
</div>
</div>

</form>
</div>
@endsection