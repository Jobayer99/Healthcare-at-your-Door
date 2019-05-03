@extends('client.layout.master')
@section('style')
<link rel="stylesheet" href="{{asset('frontend/css/chat.css')}}">
@endsection
@section('content')
<section class="hero-wrap hero-wrap-2" style="background-image: url({{asset('frontend/images/bg_1.jpg')}});"
		data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text align-items-center justify-content-center">
				<div class="col-md-9 ftco-animate text-center">
					<h1 class="mb-2 bread ">{{$profile->fullname}}</h1>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section">
		<div class="container">
				<div class="ftco-departments">
					<div class="row">
						<div class="col-md-12 tab-wrap">
						<!-- chat container start -->
						<div class="messaging">
						<div class="inbox_msg">
							<div class="inbox_people">
							<div class="headind_srch">
								<div class="recent_heading">
								<h4>Upcoming appointment</h4>
								</div>
								
							</div>
							<div class="inbox_chat">
							@forelse($appointments as $appointment)
							<!-- inboxed user list -->
								<div class="chat_list appointment_doctor active_chat" data-doctor_user_id="{{$appointment->doctor_user_id}}">
									<div class="chat_people">
										<div class="chat_img"> 
											<img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> 
										</div>
										<div class="chat_ib">
											<h5>{{$appointment->doctor_name}} <span class="chat_date">{{$appointment->shift_name}}</span></h5>
											<p>{{$appointment->department_name}}</p>
										</div>
									</div>
								</div>
								<!-- inboxed user list -->
								@empty
								<!-- inboxed empty -->
								<div class="chat_list">
									<h2>No schedule appointment in list</h2>
								</div>
								<!-- inboxed empty -->
								@endforelse

							</div>
						</div>
						<div class="mesgs">
							<div class="msg_history" id="msg_history">
								<!-- message will be printed here -->
							</div>

							<div class="type_msg d-none" >
								<div class="input_msg_write">
									<textarea type="text" class="write_msg" id="write_msg" placeholder="Type a message" ></textarea>
								</div>
								<button class="btn btn-primary float-right mb-3" id="send_msg" type="button">SEND<span class="icon-paper-plane" aria-hidden="true"></span></button>
								<input type="hidden" id="chat_active_id" value="">
							</div>



							</div>
						</div>
						</div>
						<!-- chat container end -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
@section('script')
	<script
  src="https://code.jquery.com/jquery-2.1.3.min.js"
  integrity="sha256-ivk71nXhz9nsyFDoYoGf2sbjrR9ddh+XDkCcfZxjvcM="
  crossorigin="anonymous"></script>
<script>
	$(document).ready(function(){
		//initial load msg start
		$(document).on('click', '.appointment_doctor', function(){
			var doctor_user_id = $(this).data('doctor_user_id');
			$('#msg_history').empty();
			$('.type_msg').addClass('d-none');
			$('#chat_active_id').val(doctor_user_id);
			if(doctor_user_id){
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					type: 'POST',
					url: '<?php echo url('/') ?>/activate-chat-ajax',
					ContentType: 'application/json',
					data: {doctor_user_id : doctor_user_id},
					success: function (e) {
						console.log('response')
						if(e == 0){
							$('#msg_history').html('<h2>Waiting for Doctor respone</h2>');
						}else if(e == 2){
							$('#msg_history').html('<h2>Appointment already Done!</h2>');
						}else{							
							$('.type_msg').removeClass('d-none');
							var msg = JSON.parse(e);
							var tag = "";
							$.each(msg, function(i, m){
								var msg_time = new Date(m.updated_at);
								var to_user_id = $('#chat_active_id').val();
								var toUserId = m ? m.to_user_id : false;
								if(toUserId){
									if(toUserId != to_user_id){
										tag += '<div class="incoming_msg">'+
												'<div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>'+
												'<div class="received_msg">'+
													'<div class="received_withd_msg">'+
													'<p>'+ m.message +'</p>'+
													'<span class="time_date">'+ msg_time.toLocaleString('en-US', { hour: 'numeric', minute : 'numeric', hour12: true })+'</span>'+
													'</div>'+
												'</div>'+
												'</div>';
									}else{
										tag += '<div class="outgoing_msg">'+
													'<div class="sent_msg">'+
													'<p>'+ m.message +'</p>'+
														'<span class="time_date">'+ msg_time.toLocaleString('en-US', { hour: 'numeric', minute : 'numeric', hour12: true })+'</span>'+
													'</div>'+
												'</div>';	
									}
								}
							});
							

							$('#msg_history').html(tag);
							var element = document.getElementById('msg_history');
								element.scrollTop = element.scrollHeight;
						}
					}
				});
			}
		});
		//initial load msg end

		//send msg process
		$(document).on('click', '#send_msg', function(){
			var to_user_id = $('#chat_active_id').val();
			var msg = $('#write_msg').val();
			$('#write_msg').val('');
			var msg_time = new Date();
			if(msg.length > 0){
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					type: 'POST',
					url: '<?php echo url('/') ?>/send-msg-ajax',
					ContentType: 'application/json',
					data: {msg : msg, to_user_id : to_user_id},
					success: function (e) {
						console.log(e);
						if(e){
							var tag = '<div class="outgoing_msg">'+
												'<div class="sent_msg">'+
												'<p>'+ msg +'</p>'+
													'<span class="time_date">'+ msg_time.toLocaleString('en-US', { hour: 'numeric', minute : 'numeric', hour12: true })+'</span>'+
												'</div>'+
											'</div>';
							$('#msg_history').append(tag);
							var element = document.getElementById('msg_history');
								element.scrollTop = element.scrollHeight;
						}
					}
				});
			}
			
			console.log(msg);
		})
		//send msg process end
		//send feedback
		$(document).on('click', '#feedback_send', function(){
			var feedback_text = $('#feedback_text').val();
			var doctor_user_id = $('#chat_active_id').val();
			$('#chat_active_id').val('');
			if(feedback_text.length > 0){
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					type: 'POST',
					url: '<?php echo url('/') ?>/feedback-send-ajax',
					ContentType: 'application/json',
					data: {doctor_user_id : doctor_user_id, feedback_text : feedback_text},
					success: function (e) {
						if(e){
							$('#msg_history').html('<h2>Thank you for your feedback.</h2>');
							var to_user_id = $('#chat_active_id').val('');
						}
					}
				});
			}
		})
	});



	var interval_load_msg = setInterval(function(){
		var to_user_id = $('#chat_active_id').val();
		if(to_user_id){
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				type: 'POST',
				url: '<?php echo url('/') ?>/load-msg-ajax',
				ContentType: 'application/json',
				data: {to_user_id : to_user_id},
				success: function (e) {
					if(e){
						var result = JSON.parse(e);
						var msg = result.msg;
						console.log('load', result);
						if(result.end_chat != 2){
							var tag = "";
							$.each(msg, function(i, m){
								var msg_time = new Date(m.updated_at);
								var to_user_id = $('#chat_active_id').val();
								if(m.to_user_id != to_user_id){
									tag += '<div class="incoming_msg">'+
											'<div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>'+
											'<div class="received_msg">'+
												'<div class="received_withd_msg">'+
												'<p>'+ m.message +'</p>'+
												'<span class="time_date">'+ msg_time.toLocaleString('en-US', { hour: 'numeric', minute : 'numeric', hour12: true })+'</span>'+
												'</div>'+
											'</div>'+
											'</div>';
								}else{
									tag += '<div class="outgoing_msg">'+
												'<div class="sent_msg">'+
												'<p>'+ m.message +'</p>'+
													'<span class="time_date">'+ msg_time.toLocaleString('en-US', { hour: 'numeric', minute : 'numeric', hour12: true })+'</span>'+
												'</div>'+
											'</div>';	
								}
							});
							$('#msg_history').html(tag);
							var element = document.getElementById('msg_history');
								element.scrollTop = element.scrollHeight;
						}else{
							$('.type_msg').addClass('d-none');
							clearInterval(interval_load_msg);
							var feedback = '<div class="type_feedback" >'+
												'<div class="input_msg_write">'+
													'<textarea type="text" class="write_msg" id="feedback_text" placeholder="Type your feedback about this doctor.." ></textarea>'+
												'</div>'+
												'<button class="btn btn-primary float-right mb-3" id="feedback_send" type="button">SEND FEEDBACK<span class="icon-paper-plane" aria-hidden="true"></span></button>'+
											'</div>';
							$('#msg_history').html(feedback);
						}
						
					}
				}
			});
		}		
	}, 3000);
</script>
@endsection
