@extends('layouts.main')
@section('content')
    <section class="banner">
        <div class="container">
            <div class="banner-text">
                <div class="text-wide">
                    <h1 data-aos="fade-right" data-aos-duration="1500">Identity Access<br><span>Management</span></h1>
                </div>
                <div class="text-left-align" data-aos="fade-right" data-aos-duration="500">
                    <p>Enterprise Architecture and Full Life Cycle <br>Delivery Experience</p>
                    <a href="{{ route('about') }}">About Us</a>
                </div>
            </div>
        </div>
    </section>




    <section class="banner-footer-sec">
        <div class="container-fluid">
            <div class="banner-footer-blks">
                <div class="row">

                    <div class="col-sm-3 col-md-6 col-lg-3">
                        <div class="footer-sec-text bdr" data-aos="fade-up" data-aos-duration="600">
                            <img src="{{ url('front/images/bf-img1.png') }}">
                            <h6>Identity Governance &<br>Administration (IGA).</h6>
                        </div>
                    </div>

                    <div class="col-sm-3 col-md-6 col-lg-3">
                        <div class="footer-sec-text bdr" data-aos="fade-up" data-aos-duration="1100">
                            <img src="{{ url('front/images/bf-img2.png') }}">
                            <h6>Identity Access<br>Management (IAM)</h6>
                        </div>
                    </div>

                    <div class="col-sm-3 col-md-6 col-lg-3">
                        <div class="footer-sec-text bdr" data-aos="fade-up" data-aos-duration="1500">
                            <img src="{{ url('front/images/bf-img3.png') }}">
                            <h6>Privileged Access<br>Management (PAM)</h6>
                        </div>
                    </div>

                    <div class="col-sm-3 col-md-6 col-lg-3">
                        <div class="footer-sec-text" data-aos="fade-up" data-aos-duration="1900">
                            <img src="{{ url('front/images/bf-img4.png') }}">
                            <h6>Identity Threat Detection<br>Response (ITDR)</h6>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    <section class="service-we-offer">
        <div class="container">
            <div class="service-title" data-aos="zoom-in" data-aos-duration="700">
                <h6 class="pink">Identity Practice of RedLegg</h6>
                <h4>Services we offer</h4>
            </div>

            <div class="row">

                <div class="col-md-5 col-sm-12 col-md-12 col-lg-5">
                    <div class="service-card" data-aos="fade-right" data-aos-duration="1000">
                        <img src="{{ url('front/images/srv-crd1.png') }}">
                        <h4 class="green">Strategy, Design & Life Cycle Management:</h4>
                        <p>For new customers that may have just bought an identity product and in initial phases to define
                            the implementation strategy and design as well as implement with Life Cycle Management.</p>
                        <a href="{{ route('service-page-one') }}">Learn More</a>
                    </div>
                </div>

                <div class="col-md-5 col-sm-12 col-md-12 col-lg-5">
                    <div class="service-card" data-aos="fade-left" data-aos-duration="1000">
                        <img src="{{ url('front/images/srv-crd2.png') }}">
                        <h4 class="green">Professional Services for IGA, IAM & PAM</h4>
                        <p>Staff augmentation services play an important role in supporting and enhancing the implementation
                            and management of Zero Trust Architecture (ZTA).</p>
                        <a href="{{ route('service-page') }}">Learn More</a>
                    </div>
                </div>

            </div>

        </div>
    </section>




    <section class="why-choose-us">
        <div class="container">
            <div class="row">

                <div class="col-md-5">
                    <div class="choose-us-text" data-aos="fade-right" data-aos-duration="1500">
                        <h4 class="pink">why choose us</h4>
                        <h2>Enterprise<br> Architecture with Full<br> Life Cycle Delivery <br>Experience</h2>
                        <p>With keen eyes, we assess the current state, identifying gaps, challenges, and what is at stake.
                            We envision a future with architecture in mind—a blueprint of interconnected and aligned
                            systems, ensuring the protection of your assets and fostering a strong brand.</p>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="row alcntr">
                        <div class="col-md-6">
                            <div class="choose-us-card marbtm" data-aos="fade-down" data-aos-duration="1000">
                                <img src="{{ url('front/images/chus-crd1.png') }}">
                                <h4>{{ $chooseUs[0]->title }}</h4>
                                <p>{{ $chooseUs[0]->description }}</p>
                                <a href="{{ route('about') }}"><i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                            <div class="choose-us-card" data-aos="fade-up" data-aos-duration="1000">
                                <img src="{{ url('front/images/chus-crd1.png') }}">
                                <h4>{{ $chooseUs[1]->title }}</h4>
                                <p>{{ $chooseUs[1]->description }}</p>
                                <a href="{{ route('about') }}"><i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="choose-us-card" data-aos="fade-left" data-aos-duration="1000">
                                <img src="{{ url('front/images/chus-crd3.png') }}">
                                <h4>{{ $chooseUs[2]->title }}</h4>
                                <p>{{ $chooseUs[2]->description }}</p>
                                <a href="{{ route('about') }}"><i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="additional-services">
        <div class="container">
            <div class="choose-us-text add-srv" data-aos="zoom-in" data-aos-duration="700">
                <h4 class="pink">Additional services</h4>
                <h2>Enterprise Architecture with Full Life<br>Cycle Delivery Experience</h2>
                <a href="{{ route('service-page') }}">Learn More</a>
            </div>

            <div class="add-srv-content">
                <div class="content-blk">
                    <div class="content-blk-img line">
                        <img src="{{ url('front/images/add-srv1.png') }}">
                    </div>
                    <div class="content-blk-txt" data-aos="fade-left" data-aos-duration="600">
                        <h4 class="green">Identity Governance & Administration (IGA).</h4>
                        <p>Access Review, Provision, Reconciliation, and Password Management.</p>
                        <a href="/service/inner-page#iga">Learn More<i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="content-blk">
                    <div class="content-blk-img line">
                        <img src="{{ url('front/images/add-srv1.png') }}">
                    </div>
                    <div class="content-blk-txt" data-aos="fade-right" data-aos-duration="600">
                        <h4 class="green">Identity Access Management (IAM)</h4>
                        <p>Identity Access Management (IAM)</p>
                        <a href="/service/inner-page#identity_access">Learn More<i
                                class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="content-blk">
                    <div class="content-blk-img line">
                        <img src="{{ url('front/images/add-srv1.png') }}">
                    </div>
                    <div class="content-blk-txt" data-aos="fade-left" data-aos-duration="600">
                        <h4 class="green">Privileged Access Management (PAM)</h4>
                        <p>Privileged Credentials, Session Management, Audit.</p>
                        <a href="/service/inner-page#privileged">Learn More<i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="content-blk">
                    <div class="content-blk-img">
                        <img src="{{ url('front/images/add-srv1.png') }}">
                    </div>
                    <div class="content-blk-txt" data-aos="fade-right" data-aos-duration="600">
                        <h4 class="green">Identity Threat Detection Response (ITDR)</h4>
                        <p>Real-Time Identity Protection, Identity Analytics.</p>
                        <a href="/service/inner-page">Learn More<i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <section class="our-blogs">
        <div class="container-fluid">
            <div class="choose-us-text blogs-title" data-aos="zoom-in" data-aos-duration="700">
                <h4 class="pink">Recent Publications </h4>
                <h2>Our Latest Blogs</h2>
                <p>Dive into blogs section where our AI experts share their knowledge, practical tips, and industry trends.
                    Stay updated with the latest advancements and explore diverse perspectives on AI applications.</p>
            </div>

            <div class="blogs-slider-main">
                @foreach ($blogs as $blog)
                    <div class="blogs-slides" data-aos="zoom-in" data-aos-duration="1000">
                        <a href="{{ route('blog-inner', $blog->slug) }}">
                            <div class="blogs-img">
                                <img src="{{ $blog->image->full_url }}">
                            </div>
                            <div class="blogs-content">
                                <h5 class="green">{{ $blog->title }}</h5>
                                <p>{{ $blog->description }}</p>
                                <div class="blogs-btn">
                                    @foreach ($blog->categories as $category)
                                        <a href="#">{{ $category->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                            <div class="blogs-slides-bottom">
                                <ul>
                                    <li class="bdr"><i
                                            class="fa-solid fa-calendar"></i>{{ date('F d, Y', strtotime($blog->created_at)) }}
                                    </li>
                                    <li class="pink"><i class="fa-solid fa-share-nodes"></i><a
                                            href="javascript:void(0);" class="share-link"
                                            data-url="{{ route('blog-inner', $blog->slug) }}">Share</a></li>
                                </ul>
                            </div>
                        </a>
                    </div>
                @endforeach


            </div>

        </div>
    </section>


    <section class="technology-partners">
        <div class="container-fluid">
            <div class="row">

                <div class="col-sm-12 col-md-12 col-lg-5">
                    <div class="technologies-partners-text tech-partners-text" data-aos="fade-right"
                        data-aos-duration="1500">
                        <h6 class="pink">Our Technology partners</h6>
                        <h4 class="green">We Collaborate with Industry Leaders</h4>
                        <p>We collaborate with industry leaders, pooling collective knowledge and experience to deliver
                            exceptional results that push the boundaries of what is possible! Together we leverage our
                            strengths to drive innovation, foster growth, and deliver unmatched value!</p>
                    </div>
                </div>


                <div class="col-sm-12 col-md-12 col-lg-7">
                    <div class="tech-partners-imgs">
                        <div class="roww one">

                            <div data-aos="zoom-in" data-aos-duration="1400"><img
                                    src="{{ url('front/images/ptnr1.png') }}"></div>
                            <div data-aos="zoom-in" data-aos-duration="1400"><img
                                    src="{{ url('front/images/ptnr2.png') }}"></div>
                            <div data-aos="zoom-in" data-aos-duration="1100"><img
                                    src="{{ url('front/images/ptnr3.png') }}"></div>
                            <div data-aos="zoom-in" data-aos-duration="800"><img
                                    src="{{ url('front/images/ptnr4.png') }}"></div>
                            <div data-aos="zoom-in" data-aos-duration="500"><img
                                    src="{{ url('front/images/ptnr5.png') }}"></div>
                            <div data-aos="zoom-in" data-aos-duration="200"><img
                                    src="{{ url('front/images/ptnr6.png') }}"></div>
                            <div data-aos="zoom-in" data-aos-duration="200"><img
                                    src="{{ url('front/images/ptnr13.png') }}"></div>

                        </div>


                        <div class="roww two">
                            <div data-aos="zoom-in" data-aos-duration="200"><img
                                    src="{{ url('front/images/ptnr7.png') }}"></div>
                            <div data-aos="zoom-in" data-aos-duration="500"><img
                                    src="{{ url('front/images/ptnr8.png') }}"></div>
                            <div data-aos="zoom-in" data-aos-duration="800"><img
                                    src="{{ url('front/images/ptnr9.png') }}"></div>
                            <div data-aos="zoom-in" data-aos-duration="500"><img
                                    src="{{ url('front/images/ptnr10.png') }}"></div>
                            <div data-aos="zoom-in" data-aos-duration="1100"><img
                                    src="{{ url('front/images/ptnr11.png') }}"></div>
                            <div data-aos="zoom-in" data-aos-duration="1600"><img
                                    src="{{ url('front/images/ptnr12.png') }}"></div>
                            <div data-aos="zoom-in" data-aos-duration="200"><img
                                    src="{{ url('front/images/ptnr14.png') }}"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="testi">
        <div class="container-fluid">
            <div class="choose-us-text testi-title" data-aos="zoom-in" data-aos-duration="700">
                <h4 class="pink">TESTIMONIAL</h4>
                <h2>Our Client Feedback</h2>
            </div>

            <div class="testi-slider-main">
                @foreach ($feedbacks as $feedback)
                    <div class="test-slide">
                        <img src="{{ url('front/images/quote.png') }}">
                        <p>{{ $feedback->feedback }}</p>
                    </div>
                @endforeach
                {{-- <div class="test-slide">
				<img src="{{url('front/images/quote.png')}}">
				<p>This is way better than what I envisioned when we started. You and your folks are awesome! I’m actually rethinking what we can do with this solution once it is in place. I really appreciate what you are doing for us. It’s huge.</p>
			</div>

			<div class="test-slide">
				<img src="{{url('front/images/quote.png')}}">
				<p>I am so excited with the progress we are making!</p>
			</div>

			<div class="test-slide">
				<img src="{{url('front/images/quote.png')}}">
				<p>I’m studying for my CISSP so I look forward to your weekly questions!</p>
			</div>

			<div class="test-slide">
				<img src="{{url('front/images/quote.png')}}">
				<p>I’m studying for my CISSP so I look forward to your weekly questions!</p>
			</div>

			<div class="test-slide">
				<img src="{{url('front/images/quote.png')}}">
				<p>This is way better than what I envisioned when we started. You and your folks are awesome! I’m actually rethinking what we can do with this solution once it is in place. I really appreciate what you are doing for us. It’s huge.</p>
			</div> --}}
            </div>

        </div>
    </section>



    <section class="health-check">
        <div class="container-fluid">
            <div class="health-box">
                <h1 data-aos="zoom-out" data-aos-duration="800">Identity Access Management <br>Health Check</h1>
                <a href="{{ route('contact') }}">Contact Us</a>
            </div>
        </div>
    </section>


    <section class="faq">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12 col-md-12 col-lg-5">
                    <div class="tech-partners-text faqq" data-aos="fade-right" data-aos-duration="1500">
                        <h6 class="pink">FAQ</h6>
                        <h4>Frequently Asked<br> Questions.</h4>
                        <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p> -->
                    </div>
                </div>

                <div class="col-md-12 col-md-12 col-lg-7">
                    <div class="accordion" id="accordionExample">
                        <div class="row">
                            @foreach ($faqs as $faqRows)
                                <div class="col-md-6">
                                    @foreach ($faqRows as $faqData)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne{{ $faqData->id }}">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne{{ $faqData->id }}" aria-expanded="true"
                                                    aria-controls="collapseOne{{ $faqData->id }}">
                                                  {{ $faqData->title }}
                                                </button>
                                            </h2>
                                            <div id="collapseOne{{ $faqData->id }}" class="accordion-collapse collapse"
                                                aria-labelledby="headingOne{{ $faqData->id }}"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <h4 class="green">{{ $faqData->question }}</h4>
                                                    <p>{{ $faqData->answer }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const shareLinks = document.querySelectorAll('.share-link');
            console.log("here");
            shareLinks.forEach(function(shareLink) {
                shareLink.addEventListener('click', function() {
                    const url = this.getAttribute('data-url');
                    const input = document.createElement('input');
                    input.value = url;
                    document.body.appendChild(input);
                    input.select();
                    document.execCommand('copy');
                    document.body.removeChild(input);
                    alert('Link copied to clipboard: ' + url);
                });
            });
        });
    </script>
@endpush
