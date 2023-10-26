@extends('layouts.main')
@section('content')

<section class="small-banner blog-inner">
	<div class="container">
		<div class="bannerr-text">
			<h2 data-aos="zoom-in" data-aos-duration="1500">{{$blogDetail->title}}</h2>
		</div>
	</div>
</section>


<section class="blog-inner-content">
	<div class="container">
		<div class="blog-inner-text">
			{{-- <h4 data-aos="zoom" data-aos-duration="700">Introduction:</h4>
			<p data-aos="fade-up" data-aos-duration="500">In an era of ever-evolving cyber threats and increasing complexities in the digital landscape, organizations are realizing the critical importance of adopting a Zero-Trust security approach. Zero-Trust goes beyond traditional perimeter-based security models by assuming that no user or device should be inherently trusted. Instead, it emphasizes continuous verification, strict access controls, and constant monitoring to protect critical assets. To gauge an organization's readiness and progress in implementing Zero-Trust, a comprehensive Zero-Trust Maturity Assessment is essential. In this blog, we delve into the core aspects of this assessment, shedding light on its significance and benefits.</p>
			<div class="row">
				<div class="col-md-6">
					<h5 data-aos="fade-up" data-aos-duration="1500">1. Understanding Zero-Trust Maturity:</h5>
					<p data-aos="fade-up" data-aos-duration="500">Zero-Trust Maturity Assessment is a strategic evaluation process that enables organizations to assess their current security posture and measure their level of adoption and implementation of Zero-Trust principles. It serves as a roadmap for organizations to identify gaps, define priorities, and establish a robust security foundation.</p>
					<h5 data-aos="fade-up" data-aos-duration="1500">2. Key Components of Zero-Trust Maturity Assessment:</h5>
					<p data-aos="fade-up" data-aos-duration="500">a. Policy and Governance: This component focuses on establishing clear policies, defining roles and responsibilities, and aligning security practices with business objectives. It assesses the effectiveness of policy implementation and governance mechanisms.</p>
				</div>
				
			</div>
			<p class="marbtm" data-aos="fade-up" data-aos-duration="500">b. Identity and Access Management: This component evaluates the organization's ability to verify and authenticate users, devices, and applications. It examines the adoption of multifactor authentication, least privilege access controls, and robust identity management processes.</p>
			<p class="marbtm" data-aos="fade-up" data-aos-duration="500">c. Network Security: This component assesses the organization's network segmentation, micro-segmentation, and secure network architectures. It evaluates the deployment of secure gateways, network monitoring tools, and intrusion detection systems.</p>
			<p class="marbtm" data-aos="fade-up" data-aos-duration="500">d. Endpoint Security: This component examines the organization's approach to securing endpoints, including devices, workstations, and servers. It assesses the deployment of endpoint protection mechanisms, encryption practices, and vulnerability management processes.</p>
			<p data-aos="fade-up" data-aos-duration="500">e. Data Security: This component focuses on protecting sensitive data through encryption, data loss prevention, and secure data handling practices. It evaluates the organization's ability to classify and secure data based on its sensitivity.</p>
			<h5 data-aos="fade-up" data-aos-duration="1500">3. Benefits of Zero-Trust Maturity Assessment:</h5>
			<p data-aos="fade-up" data-aos-duration="500">a. Identifying Security Gaps: The assessment helps organizations identify vulnerabilities, weaknesses, and gaps in their existing security infrastructure, policies, and practices.</p>
			<p data-aos="fade-up" data-aos-duration="500">b. Prioritizing Security Investments: By assessing the maturity level of different components, organizations can prioritize investments and allocate resources effectively based on critical areas that need improvement.</p>
			<p data-aos="fade-up" data-aos-duration="500">c. Regulatory Compliance: Zero-Trust Maturity Assessment assists organizations in aligning their security practices with industry standards and regulatory requirements, ensuring compliance and reducing legal risks.</p>
			<p data-aos="fade-up" data-aos-duration="500">d. Continuous Improvement: The assessment serves as a benchmark for ongoing improvement and provides a roadmap for organizations to enhance their security posture progressively.</p> --}}
			<div class="row">
				<div class="col-md-12" data-aos="fade-up" data-aos-duration="500">
					<!-- <img src="{{asset('storage/'.$blogDetail->detailImage->url)}}" class="sisi" data-aos="zoom-in" data-aos-duration="500"> -->
					<?php print $blogDetail->long_description; ?>

				</div>

			</div>
		</div>


		<div class="follow-us">
			<ul>
				<li class="fl-us">Follow Us:</li>
				    <li><a href="javascript:void(0)"><i class="fa-brands fa-instagram"></i></a></li>
				    <li><a href="javascript:void(0)"><i class="fa-brands fa-linkedin-in"></i></a></li>
				    <li><a href="javascript:void(0)"><i class="fa-brands fa-facebook-f"></i></a></li>
				    <li><a href="javascript:void(0)"><i class="fa-brands fa-twitter"></i></a></li>
			</ul>
		</div>

	</div>
</section>


<section class="blog-inner-lat-blog">
	<div class="container">
		<div class="lat-blg-title">
			<h4 data-aos="zoom-in" data-aos-duration="1500">Latest Blogs</h4>
		</div>
		<div class="row">
			@foreach($blogs as $blog)
			<div class="col-md-4">
				<a href="{{route('blog-inner',$blog->slug)}}">
					<div class="blogs-slides" data-aos="zoom-in" data-aos-duration="1000">
						<div class="blogs-img">
							<img src="{{$blog->image->full_url}}">
						</div>
						<div class="blogs-content">
							<h5 class="green">{{$blog->title}}</h5>
							<p>{{$blog->description}}</p>
							<div class="blogs-btn">
								@php
									$ids = explode(',', $blog->category_id);
									$categories = \App\Models\Category::whereIn('id',$ids)->orderBy('id', 'desc')->get();
								@endphp
								@foreach($categories as $category)
								<a href="#">{{$category->name}}</a>
								@endforeach
							</div>
						</div>
						<hr>
						<div class="blogs-slides-bottom">
								<ul>
									<li><i class="fa-solid fa-calendar"></i>{{$blog->created_at->format('Y-m-d')}}</li>
									|<li class="pink"><i class="fa-solid fa-share-nodes"></i>Share</li>
								</ul>
						</div>
					</div>
				</a>
			</div>
			@endforeach

		</div>
	</div>
</section>


@endsection