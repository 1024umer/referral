@extends('layouts.main')
@section('content')
    <section class="small-banner quiz">
        <div class="container">
            <div class="bannerr-text" data-aos="zoom-in" data-aos-duration="1500">
                <h4 class="pink">Quiz</h4>
                <h2>Friday Challenge Vault</h2>
            </div>
        </div>
    </section>

    <section class="quiz-content">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" id="success_alert_home"role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="container">
            <form method="post" action="{{ route('quiz.submit') }}">
                @csrf
                @foreach ($surveys as $survey)
                    <div class="quiz-radios">
                        @foreach ($survey->questions as $question)
                            <h4>Q: {{ $question->question }}</h4>
                            @foreach ($question->answers as $answer)
                                <label>
                                    <input required type="radio" name="answers[{{ $question->id }}]"
                                        value="{{ $answer->id }}">
                                    {{ $answer->answer }}
                                </label>
                            @endforeach
                        @endforeach
                    </div>
                @endforeach
                <button type="button" id="submitQuiz">Submit Quiz</button>
            </form>
        </div>
    </section>

    <div id="quizResultModal" class="modal quiz-modal fade" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h5>Thank You For Completing The Quiz</h5>
                    <h6>Your score is: <span id="quizScore"></span></h6>
                    <div style="display: none" id="quizResults"></div>
                </div>
                <div class="modal-footer">
                    <form id="quizMailForm" method="post" action="{{ route('quiz.result.mail') }}">
                        @csrf
                        <input type="email" name="email" placeholder="Enter your email here" required>
                        <p>Click below to view the answer sheet</p>
                        <button type="button" id="sendMailBtn" class="btn">Send</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <section class="health-check quizz">
        <div class="container-fluid">
            <div class="health-box">
                <h1 data-aos="zoom-out" data-aos-duration="800">Identity Access Management <br>Health Check</h1>
                <a href="#">Contact Us</a>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#submitQuiz').on('click', function() {
                var formData = $('form').serialize();
                $.ajax({
                    url: '{{ route('quiz.submit') }}',
                    type: 'POST',
                    data: formData,
                    success: function(data) {
                        $('input[type="radio"]').prop('checked', false);
                        $('#quizScore').text(data.correctAnswers + ' out of ' + data
                            .totalQuestions);
                        var resultsHtml = '<ul>';
                        $.each(data.results, function(question, isCorrect) {
                            resultsHtml += '<li>Q' + question + ': ' + (isCorrect ?
                                'Correct' : 'Wrong') + '</li>';
                        });
                        resultsHtml += '</ul>';
                        $('#quizResults').html(resultsHtml);
                        $('#quizResultModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
        $(document).ready(function() {
            $('#sendMailBtn').on('click', function() {
                var formData = $('#quizMailForm').serialize();
                formData += '&quizScore=' + $('#quizScore').text();
                $.ajax({
                    url: '{{ route('quiz.result.mail') }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            alert('Email Sent Successfully');
                        } else {
                            alert('Email could not be sent: ' + response.error);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endpush
