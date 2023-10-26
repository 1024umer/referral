@extends('layouts.main')
@section('content')
    <section class="small-banner events">
        <div class="container">
            <div class="bannerr-text">
                <h4 class="pink" data-aos="zoom-in" data-aos-duration="1500">Out Timetable</h4>
                <h2 data-aos="zoom-in" data-aos-duration="1500">Our Upcoming Events</h2>
                <p data-aos="zoom-in" data-aos-duration="1500">We aims to inform and engage readers by highlighting exciting
                    and relevant events they can look forward to. It typically includes brief descriptions of each event,
                    including the date, time, location, and key features or themes.</p>
            </div>
        </div>
    </section>


    <div class="my-modall modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>GET IN TOUCH NOW!</h2>
                </div>
                <form method="POST" action="{{ route('event-form') }}" id="contactForm">
					@csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Name" name="name" required>
                            <input type="hidden" name="event_title" id="eventTitleInput">
                        </div>
                        <div class="form-group">
                            <input type="tel" class="form-control" placeholder="Phone Number" name="number" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email" name="email" required>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="people">
                                <option selected disabled>Number of People ?</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="submit-button">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <section class="event-content">
        <div class="theme-toggle">
            <input type="checkbox" class="checkbox" id="checkbox">
            <label for="checkbox" class="checkbox-label">
                <i class="fas fa-moon"></i>
                <i class="fas fa-sun"></i>
                <span class="ball"></span>
            </label>
        </div>
        <div class="container-fluid">
            <div class="event-content-main">
                @foreach ($events as $event)
                    <div class="event-blk">
                        <div class="event-img">
                            <img src="{{ $event->image_url }}">
                        </div>
                        <div class="event-text">
                            <h4 class="green">{{ $event->title }}</h4>
                            <div><?php print $event->description; ?></div>
                            <ul>
                                <li><i class="fa-solid fa-calendar"></i>{{ date('F j, Y', strtotime($event->date)) }}</li>
                                <li><i class="fa-solid fa-calendar"></i>{{ date('h:i A', strtotime($event->time)) }}</li>
                                <li><i class="fa-solid fa-location-dot"></i>{{ $event->location }}</li>
                            </ul>
                            <a href="#" class="btn book-now-button" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" data-event-title="{{ $event->title }}">Book Now</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="health-check events">
        <div class="container-fluid">
            <div class="health-box">
                <h1 data-aos="zoom-out" data-aos-duration="800">Identity Access Management <br>Health Check</h1>
                <a href="{{ route('contact') }}">Contact Us</a>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bookNowButtons = document.querySelectorAll('.book-now-button');
            bookNowButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const eventTitle = button.getAttribute('data-event-title');
                    const eventTitleInput = document.getElementById('eventTitleInput');
                    eventTitleInput.value = eventTitle;
                });
            });
        });
    </script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const contactForm = document.getElementById('contactForm');
        contactForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(contactForm);
            fetch('/event-form', { 
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Email sent successfully!',
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Email could not be sent. Please try again later.',
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred. Please try again later.',
                });
            });
        });
    });
</script>

@endpush
