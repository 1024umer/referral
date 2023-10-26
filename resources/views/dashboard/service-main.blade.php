@extends('layouts.main')
@section('content')
<section class="small-banner service-main">
	<div class="container">
		<div class="bannerr-text" data-aos="zoom-in" data-aos-duration="1500">
			<h4 class="pink">Services we offer</h4>
			<h2>Secure Your Data, Secure<br>Your Future.</h2>
		</div>
	</div>
</section>




<section class="dark-cards">
	<div class="container">
		<div class="row">
			<div class="col-md-8">

		<div class="service-tabs-content">
			<div class="service-tabs-buttons">
					<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

					  <li class="nav-item service-card" role="presentation">
					    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
					    		<img src="{{url('front/images/srv-crd1.png')}}">
								<h4 class="green" data-aos="fade-up" data-aos-duration="500">Strategy, Design &amp; Life Cycle<br>Management:</h4>
					    </button>
					  </li>


					  <li class="nav-item service-card" role="presentation">
					    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
								<img src="{{url('front/images/srv-crd1.png')}}">
								<h4 class="green" data-aos="fade-up" data-aos-duration="500">Professional Services for PAM,<br>IGA & IAM</h4>
					    </button>
					  </li>
					</ul>
				</div>
			<div class="tab-content" id="pills-tabContent">
			  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
			  	<div class="service-card">
			  	<p  data-aos="fade-up" data-aos-duration="500">For new customers that may have just bought an identity product and in initial phases to define the implementation strategy and design as well as implement with Life Cycle Management.  Also meant for existing customers who would like to revisit or review implementation strategy, design & runbook.</p>
				<ul>
					<li>Reviewing business requirements, existing processes, compliance posture, infrastructure & application landscape</li>
					<li data-aos="fade-up" data-aos-duration="1000">Define a high-level strategy to design & implement IGA or IAM</li>
					<li>Bring in the identity source</li>
					<li data-aos="fade-up" data-aos-duration="1000">Define JML rules</li>
					<li>Reconcile & provision access to applications</li>
					<li data-aos="fade-up" data-aos-duration="1000">Define access requests and risk-based approvals</li>
					<li>Reports and dashboards</li>
					<li data-aos="fade-up" data-aos-duration="1000">User access reviews</li>
				</ul>
				<a href="{{route('service-page-one')}}">Learn  More</a>
			</div>
			  </div>


			  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
			  	<div class="service-card">
			  		<p data-aos="fade-up" data-aos-duration="500">Staff augmentation services play an important role in supporting and enhancing the implementation and management of Zero Trust Architecture (ZTA).  By leveraging staff augmentation services organizations can enhance capabilities, leverage specialized identity expertise, and ensure effective implementation of identity access management practice.</p>
				<ul>
					<li data-aos="fade-up" data-aos-duration="1000">Skilled professionals who specialize in identity technologies and practices. </li>
					<li>Configuration of identity solution ensuring properly integrated with existing systems and aligned with organizational requirements</li>
					<li data-aos="fade-up" data-aos-duration="1000">Resource flexibility. Scale identity teams based on needs providing resources on demand ensuring there is enough skilled professionals to handle the current workflow</li>
					<li>Expertise & knowledge transfer</li>
					<li data-aos="fade-up" data-aos-duration="1000">Reconcile & provision access to applications</li>
					<li>Operational support</li>
				</ul>
				<a href="{{route('service-page')}}">Learn  More</a>
			  	</div>
			  </div>
			</div>
		</div>
			</div>
		</div>
	</div>
</section>


@endsection







