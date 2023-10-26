@extends('layouts.main')
@section('content')


<section class="small-banner project-heimdall">
	<div class="container">
		<div class="bannerr-text" data-aos="zoom-in" data-aos-duration="1500">
			<h4 class="pink">Project</h4>
			<h2>HEIMDALL</h2>
		</div>
	</div>
</section>



<section class="heimdall-content">
	<div class="container-fluid">
		<div class="row">
			
			<div class="col-md-6">
				<div class="heimdall-text">
					<h5 data-aos="fade-up" data-aos-duration="500">Project Heimdall:</h5>
					<p data-aos="fade-up" data-aos-duration="1500">Project Heimdall is both AOHWV’s reference architecture and reference implementation of applying “zero trust security model”/ZTA and incorporating “Identity” as the new Perimeter concept at the enterprise level. <br>
					Heimdall incorporates the classic defense-in-depth security model with the “identity” as the new Perimeter and ZTA architecture. It improves cybersecurity posture of existing classical network. It significantly reduces attack surface, provides continuous validation and remediation for “high” risk identity.</p>
					<h5 data-aos="fade-up" data-aos-duration="500">Reference Architecture:</h5>
					<p data-aos="fade-up" data-aos-duration="1500">The first identity perimeter consists of Cloud or on-prem solutions based on IGA, PAM, and Cloud AM products. IGA protects by automating ILM, improving Governance with human identity. PAM protects by managing privilege credentials Life cycle and providing JIT/JEA with endpoint’s local admin credentials. Cloud AM provides SSO/MFA. These integrated products reduce system risk profile and improve cybersecurity assurance. The Second Identity perimeter remediate “trust” nature of the classic network by continuously detect, respond by MFA or Block access and providing real time remediation through XSOAR integration.</p>
					<h5 data-aos="fade-up" data-aos-duration="500">Reference Implementation:</h5>
					<p data-aos="fade-up" data-aos-duration="1500">This is accomplished by adopting the best-of-breed and COTS/MOTS products in our Azure LAB environment. AOHWV continuously improves by adopting latest cybersecurity toolsets</p>
					<a href="www.aohwv.com">www.aohwv.com<span>312.731.5750.</span></a>
				</div>
			</div>

			<div class="col-md-6">
				<div class="heimdall-img" data-aos="zoom-in" data-aos-duration="1500">
					<img src="{{url('front/images/heimdall-img.png')}}" data-aos="zoom-in" data-aos-duration="500">
				</div>
			</div>

		</div>


		<div class="perimeter-img">
			<div class="row">
				<div class="col-md-8">
					<img src="{{url('front/images/perimeter-img.png')}}">
				</div>
			</div>
		</div>

	</div>
</section>



<section class="health-check heimdall">
	<div class="container-fluid">
		<div class="health-box">
			<h1 data-aos="zoom-out" data-aos-duration="800">Identity Access Management <br>Health Check</h1>
			<a href="#">Contact Us</a>
		</div>
	</div>
</section>






@endsection