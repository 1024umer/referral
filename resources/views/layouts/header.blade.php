<header class="headerr">
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('index')}}"><img src="{{url('front/images/logo.png')}}"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link active" href="{{route('index')}}">Home</a></li>
          <li class="nav-item"><a class="nav-link active" href="{{route('about')}}">About Us </a></li>
          <li class="nav-item dropdown "><a class="nav-link active dropdown-toggle" href="{{route('service-main')}}">Services</a>
            <ul class="dropdown-menu">
              <li><a href="/service/inner-page#privileged">Privileged Access Management (PAM)</a></li>
              <li><a href="/service/inner-page#iga">Identity Governance & Administration (IGA).</a></li>
              <li><a href="/service/inner-page#identity_access">Identity Access Management (IAM)</a></li>
              <!-- <li><a href="/service/inner-page">Identity Threat Detection Response (ITDR)</a></li> -->
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link active" href="{{route('blog')}}">Blogs</a></li>   
          <li class="nav-item"><a class="nav-link active" href="{{route('case-study')}}">Case Study</a></li>        
          <li class="nav-item"><a class="nav-link active" href="{{route('event-page')}}">Events</a></li>
        </ul>
        <a class="bn-cntct" href="{{route('contact')}}">Contact Us</a>
      </div>
    </div>
  </nav>
    </div>
  </header>