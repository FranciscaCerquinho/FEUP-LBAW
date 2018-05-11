@extends('layouts.app')

@section('content')
<div id="add_auction">
    <div class="add_auction">
        <h1>Add Auction</h1>
        <hr class="style17" style="color:grey;">
        <div class="form-group" id="add_auction_buttons">
                <button type="button" style="font-size:16px;background-color:#437ab2; color:white" class="btn addAuction">Add another auction &nbsp; &nbsp;
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        <form id="taskForm" action="{{ route('addAuction') }}" enctype="multipart/form-data" method="post" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group row">
                <div class="col-lg-4">
                    <input for="example-text-input" type="text" class="form-control" name="name" placeholder="Auction name" />
                    @if ($errors->has('name'))
                        <div class="alert alert-danger alert-dismissable">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="col-lg-2">
                    <select for="example-text-input" class="form-control" name="category" id="sel1">
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
                    @if ($errors->has('category'))
                        <div class="alert alert-danger alert-dismissable">{{ $errors->first('category') }}</div>
                    @endif 
                </div>
                <div class="col-lg-2">
                    <input for="example-text-input" type="text" class="form-control" name="actualPrice" placeholder="Initial price (in Eur)" />
                    @if ($errors->has('actualPrice'))
                        <div class="alert alert-danger alert-dismissable">{{ $errors->first('actualPrice') }}</div>
                    @endif 
                </div>
                <div class="col-lg-2">
					<div class="input-group date" id="datetimepicker1" data-target-input="nearest">
						<input type="text" class="form-control datetimepicker-input" name="dateEnd" data-target="#datetimepicker1" placeholder="End Date"/>
						<div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
							<div class="input-group-text"><i class="fa fa-calendar"></i></div>
						</div>
					</div>
					<script type="text/javascript">
						$(function () {
							$('#datetimepicker1').datetimepicker({
								format: "DD/MM/YYYY HH:mm"
							})
						});
					</script>
                   @if ($errors->has('dateEnd'))
                        <div class="alert alert-danger alert-dismissable">{{ $errors->first('dateEnd') }}</div>
                    @endif 
				</div>
                
            </div>
            <div class="form-group row">
                <div class="col-lg-4">
                    <textarea for="example-text-input" class="form-control" id="exampleTextarea" rows="3" name="description" placeholder="Description"></textarea>
                    @if ($errors->has('description'))
                        <div class="alert alert-danger alert-dismissable">{{ $errors->first('description') }}</div>
                    @endif
                </div>
                <div class="col-lg-4">
                    <!-- image-preview-filename input [CUT FROM HERE]-->
                    <div class="input-group image-preview">
                        <input type="text" class="form-control image-preview-filename" id="imageName" disabled="disabled">
                        <!-- don't give a name === doesn't send on POST/GET -->
                        <span class="input-group-btn">
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
                                    <input type="file" name="photo" id="photo" accept="image/*" />
                                    <script type="text/javascript">
                                        /*$("#photo").on('change',function(){
                                            $("#photo").next('.form-control image-preview-filename').addClass("selected").html(($this).val());
                                        })*/
                                        $("#photo").on('change', function(){
                                            document.getElementById("imageName").value=document.getElementById("photo").value;
                                        })
                                    </script>
                                    <!-- <input type="file" name="photo" accept="image/png, image/jpeg, image/gif"/> -->
                                    <!-- rename it -->
                                </div>
                            </div>
                        </span>
                    </div>
                    <!-- /input-group image-preview [TO HERE]-->
                    @if ($errors->has('category'))
                        <div class="alert alert-danger alert-dismissable">{{ $errors->first('category') }}</div>
                    @endif
                </div>
                <div class="col-lg-2">
					<input for="example-text-input" type="text" class="form-control" name="buyNow" placeHolder="Buy-Now price (in EUR)" />
                    @if ($errors->has('buyNow'))
                        <div class="alert alert-danger alert-dismissable">{{ $errors->first('buyNow') }}</div>
                    @endif
				</div>
            </div>
            <div class="form-group" id="add_auction_buttons">
                <button class="btn" style="font-size:16px;background-color:#437ab2; color:white" type="submit">Start auction</button>
            </div>
    </div>
</div>
</div>

</form>
</div>
</div>
@endsection