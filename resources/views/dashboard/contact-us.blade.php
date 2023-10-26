@extends('layouts.main')
@section('content')


<section class="small-banner contact">
	<div class="container">
		
	</div>
</section>



<section class="reach-us">
	<div class="container">
		<div class="row">
			
			<div class="col-md-6">
				<div class="reach-text">
					<h4 class="pink" data-aos="fade-right" data-aos-duration="1500">Reach Us</h4>
					<h2 data-aos="fade-right" data-aos-duration="1500">Get In Touch With Us</h2>
					<p data-aos="fade-right" data-aos-duration="1500">For any inquiries, collaborations, or further information, please feel free to contact us. We are here to assist you with any questions or opportunities you may have. We look forward to hearing from you!</p>
					<li><i class="fa-solid fa-envelope"></i><a class="msg" href="lhees@ahowv.com">lhees@ahowv.com</a></li>
					<li><i class="fa-solid fa-phone"></i><a class="phn" href="tel:+1-312-731-5750">(312) 731-5750</a></li>
				</div>
			</div>


			<div class="col-md-1"></div>

			<div  class="col-md-5">
				<div class="lets-talk">
					<form method="post" action="{{route('contact-store')}}">
						@csrf
						<h4>Let’s Talk</h4>
						@if(session('success'))
						<div class="alert alert-success alert-dismissible fade show" id="success_alert_home"role="alert">
						{{ session('success') }}
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						@endif
						<input type="text" name="name" placeholder="Enter Your Name">
						<input type="text" name="email" placeholder="Enter Your Email">
						<textarea name="message" placeholder="Write Message"></textarea>
						<button type="submit">Send</button>
						<p>Thank you for your interest! Our team will be in touch with you shortly to follow up on your inquiry. We appreciate your patience and look forward to connecting with you soon.</p>
					</form>
				</div>
			</div>

		</div>
	</div>
</section>

@endsection