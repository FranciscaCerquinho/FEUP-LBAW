@extends('layouts.app')

@section('title', 'Owner Page')
@section('content')
<div class="contact1">
		<div class="container-contact1">
			<div class="row col-12">
				<div class="col-lg-3" id="profile_pic">
                @if($owner->photo=='perfil_blue.png')
                    <img src="http://placehold.it/300x290" alt="ownerPhoto" class="img-rounded img-responsive img-fluid" />
                @else  
					@if(preg_match('/https:\//',$owner->photo, $matches, PREG_OFFSET_CAPTURE))
						<img src="{{$owner->photo}}" class="img-rounded img-responsive img-fluid" alt="ownerPhoto">
					@else
						<img src="images/{{$owner->photo}}" class="img-rounded img-responsive img-fluid" alt="ownerPhoto">
					@endif
				@endif
				</div>
				<div class="col-lg-5">
					<div class="user_infomation">
						<h4>{{$owner->firstname}} {{$owner->lastname}}</h4>
						<small>
							<cite title="San Francisco, USA">{{$owner->country}}
								<i class="fas fa-map-marker-alt" style="margin-left:10px;"></i>
							</cite>
						</small>
						<p>
							<i class="far fa-envelope"></i> &nbsp; {{$owner->email}}
						</p>
						<p>
							<i class="fas fa-phone"></i> &nbsp; {{$owner->contact}}
						</p>

						<!-- Split button -->
						<button  data-popup-reportUser-open="popup-1" type="button" id="reportA"><span class="reportUserButton fas fa-bullhorn"></span> Report</button>
						<div class="popup-reportUser" data-popup-reportUser="popup-1" data-id="{{$owner->id_user}}">
							<div class="popup-inner-reportUser" >
								<div class="form-group" id="userForm">
									<div class="input-group-prepend">
										<span class="input-group-text">
											<i class="fas fa-comment-alt" aria-hidden="true"></i>
										</span>
										<input type="text" class="form-control reportUserText" name="reason" placeholder="Reason" />
									</div>
								</div>
								<div class="row" id="reportUserButton">
										<div class="col-6 col-xl-5 col-lg-6 col-sm-6 col-md-8" id="buttonReport">
											<div class="text-center">
												<a role="button" target="_blank" id="btn" class="btn btn-primary btn-lg btn-block">Report</a>
											</div>
										</div>
									</div>
								<a class="popup-close-reportUser" data-popup-close-reportUser="popup-1">X</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-xs-10">
					<form class="contact1-form validate-form" action="{{route('emailUser',['email'=>$owner->email])}}" method="post">
						{{csrf_field()}}
						<span class="contact1-form-title">
							Text {{$owner->firstname}} {{$owner->lastname}}
						</span>
						<div class="wrap-input1 validate-input" data-validate="Name is required">
							<input class="input1" type="text" name="name" placeholder="Name">
							<span class="shadow-input1"></span>
						</div>

						<div class="wrap-input1 validate-input" data-validate="Valid email is required: ex@abc.xyz">
							<input class="input1" type="text" name="email" placeholder="Email">
							<span class="shadow-input1"></span>
						</div>

						<div class="wrap-input1 validate-input" data-validate="Subject is required">
							<input class="input1" type="text" name="subject" placeholder="Subject">
							<span class="shadow-input1"></span>
						</div>

						<div class="wrap-input1 validate-input" data-validate="Message is required">
							<textarea class="input1" name="message" placeholder="Message"></textarea>
							<span class="shadow-input1"></span>
						</div>

						<div class="container-contact1-form-btn">
							<button class="contact1-form-btn">
								<span >Send Email
									<i class="fas fa-arrow-right"></i>
								</span>
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
    </div>
@endsection
