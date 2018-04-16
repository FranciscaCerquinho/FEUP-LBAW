@extends('layouts.app')

@section('content')
<div id="edit_profile">
		<div class="container">
			<h1>Edit Profile</h1>
			<hr class="style17" style="color:grey;">
			<div class="row">
				<!-- left column -->
				<div class="col-md-3">
					<div class="text-center">
						<img src="images/perfil-icon_grey.png" class="avatar img-circle" alt="avatar">
						<br>
						<label class="btn btn-file" style="background-color:#437ab2; color:white; margin-top:20px">
							Change Photo
							<input type="file" style="display: none;">
						</label>
					</div>
				</div>

				<!-- edit form column -->
				<div class="col-md-9 personal-info">
					<form action="{{ route('editProfile') }}" method="post" class="form-horizontal" role="form">
						<div class="form-group row">
							<label for="example-text-input" class="col-lg-2 col-control-label">First name:</label>
							<div class="col-lg-8">
								<input class="form-control" type="text" name="firstName" value="{{Auth::user()->firstname}}" id="example-text-input">
							</div>
						</div>
						<div class="form-group row">
							<label for="example-text-input" class="col-lg-2 control-label">Last name:</label>
							<div class="col-lg-8">
								<input class="form-control" type="text" name="lastName" value="{{Auth::user()->lastname}}" id="example-text-input">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-2 control-label">Email:</label>
							<div class="col-lg-8">
								<input class="form-control" type="text" name="email" value="{{Auth::user()->email}}" id="example-text-input" disabled>
							</div>
                        </div>
                        <div class="form-group row">
							<label class="col-lg-2 control-label">Contact:</label>
							<div class="col-lg-8">
								<input class="form-control" type="number" name="contact" min="14" max="17" value="{{Auth::user()->contact}}" id="example-text-input">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-2 control-label">Address:</label>
							<div class="col-md-8">
								<input class="form-control" type="text" name="address" value="{{Auth::user()->address}}" id="example-text-input">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-2 control-label">Password:</label>
							<div class="col-md-8">
								<input class="form-control" type="password" name="password" value="11111122333" id="example-text-input">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-2 control-label">Confirm password:</label>
							<div class="col-md-8">
								<input class="form-control" type="password" name="confirmPassword" value="11111122333" id="example-text-input">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-2 control-label"></label>
							<div class="col-md-8">
								<input type="submit" class="btn" value="Save Changes" style="background-color:#437ab2; color:white">
								<span></span>
								<input type="reset" class="btn btn-default" value="Cancel">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
    </div>
@endsection