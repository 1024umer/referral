@extends('layouts.main')
@section('content')
    <section class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <div class="p-5 border shadow bg-light">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" id="success_alert_home"role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h3 class="text-warning">Registration</h3>
                    <form action="{{route('register')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">First Name</label>
                                    <input type="text" name="first_name" class="form-control" id="">
                                    @error('first_name')
                                        <label class="for-error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" id="">
                                    @error('last_name')
                                        <label class="for-error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">State</label>
                                    <input type="text" name="state" class="form-control" id="">
                                    @error('state')
                                        <label class="for-error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Date of birth</label>
                                    <input type="date" name="dob" class="form-control" id="">
                                    @error('dob')
                                        <label class="for-error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="form-label">Profile Picture</label>
                                    <input type="file" name="profile_image" class="form-control" id="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="">
                                    @error('email')
                                        <label class="for-error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="">
                                    @error('password')
                                        <label class="for-error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="">
                                    @error('password_confirmation')
                                        <label class="for-error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <button class="btn btn-outline-warning w-100" type="submit">Register Now</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-5 border shadow bg-light">
                    @if (session('error'))
                        <div class="alert alert-error alert-dismissible fade show" id="error_alert_home"role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h3 class="text-warning">Login</h3>
                    <form action="{{route('authenticate')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="">
                                    @error('email')
                                        <label class="for-error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="">
                                    @error('password')
                                        <label class="for-error">{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <button class="btn btn-outline-warning w-100" type="submit">Login Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('css')
    <style>
        .for-error{
            color: red;
        }
    </style>
@endpush
@push('js')
<script>
    // Automatically fade the alert after 2 seconds
    setTimeout(function() {
        document.querySelector('#success_alert_home').style.opacity = '0';
        document.querySelector('#success_alert_home').style.display = 'none';
    }, 3000);
</script>
@endpush
