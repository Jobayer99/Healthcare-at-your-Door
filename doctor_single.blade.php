@extends('client.layout.master')

@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url({{asset('frontend/images/bg_1.jpg')}});"
		data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<h1 class="mb-2 bread ">Appointment with {{$doctor->doctor_name}}</h1>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section">
		<div class="container">
			<div class="ftco-departments">
				<div class="row">
					<div class="col-md-12 tab-wrap">
						<div class="tab-content bg-light p-4 p-md-5 ftco-animate" id="v-pills-tabContent">
							<div class="tab-pane py-2 fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="day-1-tab">
								<div class="row departments">
									<div class="col-lg-4 order-lg-last d-flex align-items-stretch">
										<div class="img d-flex align-self-stretch" style="background-image: url({{asset('media/images/doctor/'.$doctor->photo)}});"></div>
									</div>
									<div class="col-lg-8">
										<h2 class="display-4">{{$doctor->doctor_name}}</h2>
										<h4 class="text-muted">{{$doctor->department_name}}</h4>
										<p>{{$doctor->doctor_description}}</p>
										<div class="row mt-5 pt-2">
											<div class="col-lg-8">
												@if(Session::get('user_login'))
												<form id="form-group">
													<input type="hidden" id="doctor_user_id" value="{{$doctor->user_id}}">
													<div class="form-group">
														<select id="shift_id" class="form-control" >
															@foreach($shift as $s)
															<option value="{{$s->shift_id}}">{{$s->shift_name}}</option>
															@endforeach
														</select>
													</div>

													<div class="form-group">
														<input type="date" id="appointment_date" class="form-control" placeholder="appointment date">
													</div>

													<div id="error_container"></div>
													
													<div class="form-group">
														<input type="button" id="check_appointment" class="btn btn-primary py-3 px-5" value="Confirm">
													</div>
													
												</form>
												<div id="payment_button" class="d-none">
													<form action="{{url('payment-submit')}}" method="POST">
														<input type="hidden" name="doctor_user_id" value="{{$doctor->user_id}}">
														<input type="hidden" name="shift_id" id="shift_id_assign" value="">
														<input type="hidden" name="appointment_time" id="appointment_time" value="">
														{{csrf_field()}}
														<script
															src="https://checkout.stripe.com/checkout.js" class="stripe-button"
															data-key="pk_test_D9mugT9XMCzATHb481bB8RVr00XpQRI605"
															data-amount="{{600 * 100}}"
															data-name="{{$doctor->doctor_name}}"
															data-description="{{$doctor->email}}"
															data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
															data-locale="auto">
														</script>
													</form>
												</div>
												@endif
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section>
		<div class="container">
			<div class="ftco-departments">
				<div class="row">
					<div class="col-md-12">
						<!-- review -->
						<h2 class='display-4'>Review</h2>
						<div class="row mt-5 pt-2">
							<div class="col-lg-8" style="background:#FAFAFA">
								@forelse($reviews as $review)
								<div class="card-body bg-white m-3">
									<h5 class="card-title">{{$review->fullname}}</h5>
									<p class="card-text">{{$review->review_text}}</p>
								</div>
								@empty
								<div class="card-body bg-white m-3">
									<h2 class="card-title">No review available</h2>
								</div>
								@endforelse
								

							</div>
						</div>
						<!-- review -->
					</div>
				</div>
			</div>
		</div>
	</section>










	<script
	src="https://code.jquery.com/jquery-2.1.3.min.js"
	integrity="sha256-ivk71nXhz9nsyFDoYoGf2sbjrR9ddh+XDkCcfZxjvcM="
	crossorigin="anonymous"></script>
	<script>
		$(document).ready(function(){
			$('#check_appointment').click(function(){
				$('#error_container').empty();
				$('#payment_button').addClass('d-none');
				$('#error_container').html('<p style="text-align:center;font-size:2rem;"><i class="icon icon-spinner"></i>');
				var shift_id = $('#shift_id').val();
				var appointment_date = $('#appointment_date').val();
				var data = {
					doctor_user_id : $('#doctor_user_id').val(),
					shift_id : $('#shift_id').val(),
					appointment_date : $('#appointment_date').val(),
				}
				if(data.appointment_date){
					$.ajax({
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						type: 'POST',
						url: '<?php echo url('/') ?>/check-appointment-ajax',
						ContentType: 'application/json',
						data: data,
						success: function (e) {
							console.log('response', e)
							if(e == 200){
								$('#error_container').html('<span class="text-success">Appointment available. Proceed by payment</span>');
								$('#payment_button').removeClass('d-none');
								$('#shift_id_assign').val(shift_id);
								$('#appointment_time').val(appointment_date);

							}else{
								$('#error_container').html('<span class="text-danger">Appointment has already been taken. Please try another date.</span>');
							}
						}
					});
				}else{
					$('#error_container').html('<span class="text-warning">Choose an appointment date</span>');
				}
			})
		});
	</script>
@endsection
