@extends('layouts.app')

@section('content')

<div id="add_auction">
	<div class="add_auction">
		<h1>Add Auction</h1>
		<hr class="style17" style="color:grey;">
		<form id="taskForm" action="{{ route('add_auction') }}" method="post" role=form class="form-horizontal">
            {{ csrf_field() }}
			<div class="form-group row">
				<div class="col-lg-4">
					<input for="example-text-input" type="text" class="form-control" name="name" placeholder="Auction name" />
				</div>
				<div class="col-lg-2">
					<select for="example-text-input" name="category" class="form-control" id="sel1">
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
					<input for="example-text-input" type="text" class="form-control" name="actualPrice" placeholder="Initial price (in Eur)" />
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
				</div>
			</div>
			<div class="form-group row">
				<div class="col-lg-4">
					<textarea for="example-text-input" class="form-control" id="exampleTextarea" name="description" rows="3" placeholder="Description"></textarea>
				</div>
				<div class="col-lg-4">
					<!-- image-preview-filename input [CUT FROM HERE]-->
					<div class="input-group image-preview">
						<input type="text" class="form-control image-preview-filename" disabled="disabled">
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
									<input type="file" accept="image/png, image/jpeg, image/gif" name="photo" />
									<!-- rename it -->
								</div>
							</div>
						</span>
					</div>
					<!-- /input-group image-preview [TO HERE]-->
				</div>

				<div class="col-lg-2">
					<input for="example-text-input" type="text" class="form-control" name="buyNow" placeHolder="Buy-Now price (in EUR)" />
				</div>
			</div>
			<div class="form-group" id="add_auction_buttons">
				<button type="button" style="font-size:16px;background-color:#437ab2; color:white" class="btn">Add another auction &nbsp; &nbsp;
					<i class="fa fa-plus"></i>
				</button>
				<button class="btn" style="font-size:16px;background-color:#437ab2; color:white" type="submit">Start auction</button>
			</div>
		</form>
	</div>
</div>

@endsection