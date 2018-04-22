@extends('layouts.app')

@section('content')
<div class="contact1">
		<div class="container-contact1">
			<div class="row col-12">
				<div class="col-lg-3" id="profile_pic">
					<img src="http://placehold.it/300x290" alt="" class="img-rounded img-responsive img-fluid" id="profile_pic" />
				</div>
				<div class="col-lg-5">
					<div class="user_infomation">
						<h4>Mariana Gomes</h4>
						<small>
							<cite title="San Francisco, USA">Porto, Portugal
								<i class="fas fa-map-marker-alt" style="margin-left:10px;"></i>
							</cite>
						</small>
						<p>
							<i class="far fa-envelope"></i> &nbsp; marianagomes@gmail.com
						</p>
						<p>
							<i class="fas fa-phone"></i> &nbsp; 912875765
						</p>

						<!-- Split button -->
						<div class="contact_user">
							<div class="row">
								<div class="col">
									<a type="button" href="#message">
										<button class="btn btn-danger" style="font-size:20px;">
											<i class="fas fa-bullhorn" style="font-size:20px;"></i>
											Report
										</button>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-xs-10">
					<form class="contact1-form validate-form">
						<span class="contact1-form-title">
							Text Mariana Gomes
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
								<span>Send Email
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