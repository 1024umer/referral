@extends('layouts.main')
@section('content')
    <div class="row m-5">
        <div class="col-md-6 d-flex justify-content-center">
            <div class="text-center correct">
                <h3>Correct Answers: {{ $correctAnswers }}</h3>
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-center">
            <div class="text-center wrong">
                <h3>Wrong Answers: {{ $wrongAnswers }}</h3>
            </div>
        </div>
    </div>
    <div class="text-center m-5">
        <button class="btn btn-primary" id="openModalButton">Send Email</button>
    </div>

    <!-- Create a hidden modal popup -->
    <div id="emailModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Enter Your Email Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('quiz.result.mail') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <input type="hidden" name="correctAnswers" value="{{ $correctAnswers }}">
                            <input type="hidden" name="wrongAnswers" value="{{ $wrongAnswers }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Send Email</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#openModalButton').click(function() {
                $('#emailModal').modal('show');
            });
            $('.close').click(function() {
                $('#emailModal').modal('hide');
            });
        });
    </script>
@endpush
