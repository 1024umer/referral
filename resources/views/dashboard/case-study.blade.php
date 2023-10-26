@extends('layouts.main')
@section('content')

<section class="small-banner case-study">
	<div class="container">
		<div class="bannerr-text">
			<h4 class="pink" data-aos="zoom-in" data-aos-duration="1500">Project</h4>
			<h2 data-aos="zoom-in" data-aos-duration="1500">Our Case Studies</h2>
      <p data-aos="zoom-in" data-aos-duration="1500">Case studies are detailed examinations of specific situations or problems that provide a deep understanding of real-world scenarios. They typically involve comprehensive research, analysis, and documentation to explore various aspects of the subject matter.</p>
		</div>
	</div>
</section>

<section class="our-case-studies">
    <div class="container-fluid">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
          <div class="cate-main1">
            <div class="item">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab" aria-controls="pills-all" aria-selected="true">All</button>
                </li>
            </div>
            @foreach ($caseCategories as $caseCategory)
            <div class="item">
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-home-tab{{ $caseCategory->id }}" data-bs-toggle="pill" data-bs-target="#pills-home{{ $caseCategory->id }}" type="button" role="tab" aria-controls="pills-home" aria-selected="false">{{ $caseCategory->name }}</button>
                </li>
            </div>    
            @endforeach
          </div>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab">
                <div class="row marbtm">
                    @foreach ($all as $item)
                        <div class="col-md-4">
                            <div class="tab-cardd">
                                <div class="tab-cardd-img">
                                    <img src="{{ $item->image_url }}">
                                </div>
                                <div class="tab-cardd-bottom">
                                    <h6 data-aos="fade-up" data-aos-duration="500">{{ $item->title }}</h6>
                                    <h4 data-aos="fade-up" data-aos-duration="1000">{{ $item->description }}<a href="{{ route('case.inner', $item->slug) }}"><i class="fa-solid fa-arrow-right"></i></a></h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @foreach ($caseCategories as $caseCategory)
                <div class="tab-pane fade" id="pills-home{{ $caseCategory->id }}" role="tabpanel" aria-labelledby="pills-home-tab{{ $caseCategory->id }}">
                    <div class="row marbtm">
                        @foreach ($caseStudies as $caseStudy)
                            @php
                                $ids = json_decode($caseStudy->case_categories_ids);
                            @endphp
                            @if (in_array($caseCategory->id, $ids))
                                <div class="col-md-4">
                                    <div class="tab-cardd">
                                        <div class="tab-cardd-img">
                                            <img src="{{ $caseStudy->image_url }}">
                                        </div>
                                        <div class="tab-cardd-bottom">
                                            <h6 data-aos="fade-up" data-aos-duration="500">{{ $caseStudy->title }}</h6>
                                            <h4 data-aos="fade-up" data-aos-duration="1000">{{ $caseStudy->description }}<a href="{{ route('case.inner', $caseStudy->slug) }}"><i class="fa-solid fa-arrow-right"></i></a></h4>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>




<section class="health-check case-studies">
	<div class="container-fluid">
		<div class="health-box">
			<h1 data-aos="zoom-out" data-aos-duration="800">Identity Access Management <br>Health Check</h1>
			<a href="{{route('contact')}}">Contact Us</a>
		</div>
	</div>
</section>


@endsection