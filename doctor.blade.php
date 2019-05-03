@extends('client.layout.master')

@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url({{asset('frontend/images/bg_1.jpg')}});"
		data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<h1 class="mb-2 bread">Qualified Doctors</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i
									class="ion-ios-arrow-forward"></i></a></span> <span>Doctor <i
								class="ion-ios-arrow-forward"></i></span></p>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section">
		<div class="container">
			<div class="row">
				@foreach($doctors as $doctor)
				<div class="col-md-6 col-lg-3 ftco-animate">
					<div class="staff">
						<div class="img-wrap d-flex align-items-stretch">
							<div class="img align-self-stretch" style="background-image: url({{asset('media/images/doctor/'.$doctor->photo)}});"></div>
						</div>
						<div class="text pt-3 text-center">
							<a href="{{url('doctor/'.$doctor->user_id)}}"><h3>{{$doctor->doctor_name}}</h3></a> 
							<span class="position mb-2">Pediatrician</span>
							<div class="faded">
								<p>{{$doctor->doctor_description}}</p>
								<ul class="ftco-social text-center">
									<li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
									<li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
									<li class="ftco-animate"><a href="#"><span class="icon-google-plus"></span></a></li>
									<li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>
@endsection
