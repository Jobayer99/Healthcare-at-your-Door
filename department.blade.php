@extends('client.layout.master')

@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url({{asset('frontend/images/bg_1.jpg')}});"
		data-stellar-background-ratio="0.2">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<h1 class="mb-2 bread">Daily Health tips</h1>
					<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i
									class="ion-ios-arrow-forward"></i></a></span> <span>Department <i
								class="ion-ios-arrow-forward"></i></span></p>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center mb-5 pb-2">
				<div class="col-md-8 text-center heading-section ftco-animate">
					<span class="subheading"></span>
					<h2 class="mb-4"> </h2>

				</div>
			</div>
			<div class="ftco-departments">
				<div class="row">
					<div class="col-md-12 nav-link-wrap">
						<div class="nav nav-pills d-flex text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
							<a class="nav-link ftco-animate" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab"
								aria-controls="v-pills-1" aria-selected="false">Click here to get daily tips</a>

					 		</div>
				          </div>
				
						<div class="tab-pane fade" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-day-1-tab">
								<div class="row departments">
									<div class="col-lg-4 order-lg-last d-flex align-items-stretch">
										<div class="img d-flex align-self-stretch" style="background-image: url({{asset('frontend/images/dept-4.jpg')}});"></div>
									</div>
									<div class="col-md-8">
										
									<p> 
										<ul>1.If you feel like eating but are not sure if you’re really hungry, ask   yourself if you’d like to have an apple. If the answer is ‘no’, you’re most likely bored rather than hungry.</ul>
										<ul>2.Exercising before going to bed makes your muscles burn more calories during the night.</ul>
										<ul>3.Crying releases excess stress hormones and is scientifically proven to ease mental strain.</ul>
										<ul>4.A mid-day nap improves your memory and reduces the chances of developing heart diseases.</ul>
										<ul>5.If you’re feeling anxious and stressed, eat a melon. Melons help relieve anxiety and stress, plus they boost your metabolism.</ul>
										<ul>6.Start learning a new language or how to play an instrument. These actions help slow down the brain’s aging process.</ul>
										<ul>7.While driving, chew mint or cinnamon-flavored gum. It has been proven to reduce feelings of frustration by 25%, increase your vigilance by 30%, and makes the drive feel 30% shorter.</ul>
										<ul>8.While driving, chew mint or cinnamon-flavored gum. It has been proven to reduce feelings of frustration by 25%, increase your vigilance by 30%, and makes the drive feel 30% shorter.</ul>
										<ul>9.Skipping a meal can cause you to gain weight. Your body thinks you’re going through a famine, which causes it to work in energy-saving mode and makes burning calories more difficult.</ul>
										<ul>10.Listening to music regularly is said to reduce the chances of developing a brain tumor.</ul>
										<ul>11.	Drink two cups of cold water before a meal, as this boosts metabolism by up to 30%.</ul>
										<ul>12.	 If you suffer from headaches or mental stress, lie down next to a wall with your legs elevated and leaning against the wall at a 90-degree angle. Maintain this position for 5 minutes.</ul>
										<ul>13.	Running for half an hour a day will help you reduce 0.5kg (1 lb) of fat a week.</ul>
										<ul>14.Drinking a lot of water during the day helps you sleep better at night.</ul>
										<ul>15.	Women who walk for an hour each day reduce their chances of getting breast cancer by 15%.</ul>
										<ul>16.	Check your toothpaste for an ingredient called “Novamin” – it is the only substance that can repair teeth.</ul>
										<ul>17.	Natural pineapple juice is 5 times more effective than cough syrup. It can also prevent baldness, and even the flu.</ul>
										<ul>18.	Make an effort to eat a home-cooked meal at least 5 times a week. A recent study found that this may extend your life by a whole decade.</ul>
										<ul>19.	If you’re trying to quit smoking, try the following method: every time you feel the need to smoke a cigarette, lick a tiny bit of salt. The urge to smoke should pass within a month.</ul>
										<ul>20.	A cold shower can help relieve depression and also helps keep your skin and hair healthier.</ul>
										<ul>21.	If you’ve stayed up all night, take a 15-minute nap before sunrise. It will trick your body into thinking it slept enough. (Don’t do this too often.)</ul>
										<ul>22.	Having a pet reduces stress, improves mental functions and extends your life expectancy.</ul>
										<ul>23.	Make an effort to be organized. The more organized you are – the less likely you are to suffer from Alzheimer’s.</ul>

										</p>
																														
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
					
					<p class="mb-0">A good laugh and a long sleep are the best cures in the doctor's book.</p>
					<p></p>
				</div>
				
			</div>
		</div>
	</section>			

						
	</section>
@endsection
