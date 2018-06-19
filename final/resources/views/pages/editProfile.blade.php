@extends('layouts.app')

@section('title', 'Edit Profile')
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
        <p class="title">How to edit your profile?</p>
        <p>You just have to change the field that you want to change and then click on <b>"Save Changes"</b> </p>
		<p class="title">How to change the password?</p>	
		<p>If you want to change the password, don't forget that the field <b>"Password"</b> and <b>"Confirm Password"</b> have to match.</p>
        <p class="title">How to change your picture?</p>
        <p>Click on <b>"Change photo" </b> and then select the picture and click on <b>"Save Changes"</b> </p>
      </div>
    </div>
  </div>
</div>
<div id="edit_profile" >
	<div class="row" style="margin-left:50px; margin-right:50px;">
		<div class="col-sm-12 sb-4">
		<h2 class="users">Edit your Profile</h2>
		<hr class="style17" style="color:grey;">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="/auctions">
				<i class="fas fa-home"></i>
				Home
				</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
			</ol>
		</nav>
	</div>
	<div class="container">
		<form action="{{ route('editProfile') }}" enctype="multipart/form-data" method="post" class="form-horizontal">
		{{ csrf_field() }}
		<div class="row">
			<!-- left column -->
			<div class="col-md-3 form-group row">
				<div class="text-center">
					@if(Auth::user()->photo=='perfil_blue.png')
					<img src="images/perfil-icon_grey.png" class="avatar img-circle" alt="avatar">
					@else
						@if(preg_match('/https:\//',Auth::user()->photo, $matches, PREG_OFFSET_CAPTURE))
						<img src="{{Auth::user()->photo}}" class="avatar img-circle" alt="avatar">
						@else
						<img src="images/{{Auth::user()->photo}}" class="avatar img-circle" alt="avatar">
						@endif
					@endif
					<br>
					<label class="btn btn-file" style="background-color:#437ab2; color:white; margin-top:20px" for="changeUserNamePhoto">
						Change Photo
						<input class="form-control" type="file" name="photo" accept="image/*">
					</label>
				</div>
			</div>
			<!-- edit form column -->
			<div class="col-md-9 personal-info">
			<div class="col-md-10">
				@if(isset($alert))
				@if ($alert!="")
				<div class="alert alert-danger alert-dismissable" role="alert">
					<a class="panel-close close" data-dismiss="alert">x</a>
					<i class="fas fa-bell"></i>
					{!!$alert!!}
				</div>
				@endif
				@endif
				@if(isset($success))
				@if ($success!="")
				<div class="alert alert-success alert-dismissable" role="alert">
					<a class="panel-close close" data-dismiss="alert">x</a>
					<i class="far fa-check-circle"></i>
					{!!$success!!}
				</div>
				@endif
				@endif
				@if ($errors->has('firstName'))
					<div class="alert alert-danger alert-dismissable" role="alert">
						<a class="panel-close close" data-dismiss="alert">x</a>
						<i class="far fa-bell"></i>
						{{ $errors->first('firstName') }}
					</div>
				@endif
				@if ($errors->has('lastName'))
					<div class="alert alert-danger alert-dismissable" role="alert">
						<a class="panel-close close" data-dismiss="alert">x</a>
						<i class="far fa-bell"></i>
						{{ $errors->first('lastName') }}
					</div>
				@endif
				@if ($errors->has('contact'))
					<div class="alert alert-danger alert-dismissable" role="alert">
						<a class="panel-close close" data-dismiss="alert">x</a>
						<i class="far fa-bell"></i>
						{{ $errors->first('contact') }}
					</div>
				@endif
				@if ($errors->has('address'))
					<div class="alert alert-danger alert-dismissable" role="alert">
						<a class="panel-close close" data-dismiss="alert">x</a>
						<i class="far fa-bell"></i>
						{{ $errors->first('address') }}
					</div>
				@endif
				@if ($errors->has('country'))
					<div class="alert alert-danger alert-dismissable" role="alert">
						<a class="panel-close close" data-dismiss="alert">x</a>
						<i class="far fa-bell"></i>
						{{ $errors->first('country') }}
					</div>
				@endif
			</div>
					<div class="form-group row">
						<label class="col-lg-2 col-control-label" for="changeFirstName">First name:</label>
						<div class="col-lg-8">
							<input class="form-control" type="text" name="firstName" value="{{Auth::user()->firstname}}" >
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-2 control-label"  for="changeLastName">Last name:</label>
						<div class="col-lg-8">
							<input class="form-control" type="text" name="lastName" value="{{Auth::user()->lastname}}" >
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-2 control-label"  for="changeEmail">Email:</label>
						<div class="col-lg-8">
							<input class="form-control" type="text" name="email" value="{{Auth::user()->email}}"  disabled>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-lg-2 control-label"  for="changeContact">Contact:</label>
						<div class="col-lg-8">
							<input class="form-control" type="number" name="contact" value="{{Auth::user()->contact}}" >
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 control-label"  for="changeAddress">Address:</label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="address" value="{{Auth::user()->address}}" >
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 control-label"  for="changeCountry">City,Country:</label>
						<div class="col-md-8">
							<input class="form-control" type="text" name="country" value="{{Auth::user()->country}}" >
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 control-label"  for="changePassword">Password:</label>
						<div class="col-md-8">
							<input class="form-control" type="password" name="password" value="11111122333" >
						</div>
					</div>
				
					<div class="form-group row">
						<label class="col-md-2 control-label"  for="confirmPassword">Confirm password:</label>
						<div class="col-md-8">
							<input class="form-control" type="password" name="confirmPassword" value="11111122333" >
						</div>
					</div>
					<div class="form-group row">
						<label class="col-md-2 control-label" for="submitChanges"></label>
						<div class="col-md-8">
							<input type="submit" class="btn" value="Save Changes" style="background-color:#437ab2; color:white">
							<span></span>
							<input type="reset" class="btn btn-default" value="Cancel">
						</div>
					</div>
			</div>
		</div>
		</form>
	</div>
</div>
@endsection