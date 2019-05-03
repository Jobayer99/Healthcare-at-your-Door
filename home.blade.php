@extends('client.layout.master')

@section('content')
<section class="home-slider owl-carousel">
		<div class="slider-item" style="background-image:url({{asset('frontend/images/bg_1.jpg')}});" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<div class="container">
				<div class="row no-gutters slider-text align-items-center justify-content-start" data-scrollax-parent="true">
					<div class="col-md-6 text ftco-animate">
						<h1 class="mb-4">We are here <span> to help you getting mental health counselling</span></h1>
						<h3 class="subheading">Everyday We Bring Hope and Smile to the Patient We Serve</h3>

					</div>
				</div>
			</div>
		</div>

		<div class="slider-item" style="background-image:url({{asset('frontend/images/bg_2.jpg')}});">
			<div class="overlay"></div>
			<div class="container">
				<div class="row no-gutters slider-text align-items-center justify-content-start" data-scrollax-parent="true">
					<div class="col-md-6 text ftco-animate">
						<h1 class="mb-4">We Care <span>About Your Mental Health</span></h1>
						<h3 class="subheading">Your Health is Our Top Priority with Comprehensive, Affordable medical.</h3>
						
					</div>
				</div>
			</div>
		</div>
	</section>



	

	<section class="ftco-section ftco-no-pt ftc-no-pb">
		<div class="container">
			<div class="row no-gutters">
				<div class="col-md-5 p-md-5 img img-2 mt-5 mt-md-0" style="background-image: url({{asset('frontend/images/about.jpg')}});">
				</div>
				<div class="col-md-7 wrap-about py-4 py-md-5 ftco-animate">
					<div class="heading-section mb-5">
						<div class="pl-md-5 ml-md-5">
							<span class="subheading">Get to know your treatment options</span>
							<h2 class="mb-4" style="font-size: 22px;">Our Service is specialty concerned to make peoples life easier.
								In here people can get doctors consultation from their home or any environment of their comfort.</h2>
						</div>
					</div>


					<div class="pl-md-5 ml-md-5 mb-5">

						<div class="row mt-5 pt-2">
							<div class="col-lg-6">
								<div class="services-2 d-flex">
									<div class="icon mt-2 mr-3 d-flex justify-content-center align-items-center"><span
											class="flaticon-first-aid-kit"></span></div>
									<div class="text">
									
								<ul><li><h3>Depressing</h3>
								<li><h3>Depression</h3>
								<li><h3>Depression</h3>
								<li><h3>Depression</h3>
								<li><h3>Depression</h3>
								<li><h3>Depression</h3>
								<li><h3>Depression</h3>
								<li><h3>Depression</h3></li>
									</li>
								</li>
							</li>
						</li>
					</li>
				</li>
			</li>
		</li>
		     </ul>

			 </div>
		</div>
	</div>
</div>
</div>
</div>
</div>
</div>
</section>

<section class="ftco-intro" style="background-image: url({{asset('frontend/images/bg_3.jpg')}});" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<h2>We Provide Mental Health Care Consultation</h2>
					<p class="mb-0">Your Health is Our Top Priority with Comprehensive, Affordable medical.</p>
					<p></p>
				</div>
				<div class="col-md-3 d-flex align-items-center">
					<p class="mb-0"><a href="{{ url('/login') }}" class="btn btn-secondary px-4 py-3">Register</a></p>
				</div>
			</div>
		</div>
	</section>
			
</section>





	




            <section class="ftco-intro" style="background-image: url({{asset('frontend/images/bg_3.jpg')}});" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					
					<p class="mb-0">An apple a day keeps the doctor away</p>
					<p></p>
				</div>
				<div class="col-md-3 d-flex align-items-center">
					<p class="mb-0"><a href="{{ url('department') }}" class="btn btn-secondary px-4 py-3">Get your Health Tips</a></p>
				</div>
			</div>
		</div>
	</section>


	

@endsection
