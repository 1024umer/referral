@extends('layouts.main')
@section('content')
    <section class="container my-5">
        <div class="my-5">
            <h3 class="text-white">Welcome to this site please register your self</h3>
        </div>
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
                    <form action="{{isset($id)?route('referral.register'):route('register')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="referral_id" value="{{isset($id)?$id:''}}">
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
                                    <select name="state" class="form-select" aria-label="Default select example">
                                        <option selected disabled>Select a state</option>
                                        <option value="Alabama">Alabama</option>
                                        <option value="Alaska">Alaska</option>
                                        <option value="Arizona">Arizona</option>
                                        <option value="Arkansas">Arkansas</option>
                                        <option value="California">California</option>
                                        <option value="Colorado">Colorado</option>
                                        <option value="Connecticut">Connecticut</option>
                                        <option value="Delaware">Delaware</option>
                                        <option value="Florida">Florida</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Hawaii">Hawaii</option>
                                        <option value="Idaho">Idaho</option>
                                        <option value="Illinois">Illinois</option>
                                        <option value="Indiana">Indiana</option>
                                        <option value="Iowa">Iowa</option>
                                        <option value="Kansas">Kansas</option>
                                        <option value="Kentucky">Kentucky</option>
                                        <option value="Louisiana">Louisiana</option>
                                        <option value="Maine">Maine</option>
                                        <option value="Maryland">Maryland</option>
                                        <option value="Massachusetts">Massachusetts</option>
                                        <option value="Michigan">Michigan</option>
                                        <option value="Minnesota">Minnesota</option>
                                        <option value="Mississippi">Mississippi</option>
                                        <option value="Missouri">Missouri</option>
                                        <option value="Montana">Montana</option>
                                        <option value="Nebraska">Nebraska</option>
                                        <option value="Nevada">Nevada</option>
                                        <option value="New Hampshire">New Hampshire</option>
                                        <option value="New Jersey">New Jersey</option>
                                        <option value="New Mexico">New Mexico</option>
                                        <option value="New York">New York</option>
                                        <option value="North Carolina">North Carolina</option>
                                        <option value="North Dakota">North Dakota</option>
                                        <option value="Ohio">Ohio</option>
                                        <option value="Oklahoma">Oklahoma</option>
                                        <option value="Oregon">Oregon</option>
                                        <option value="Pennsylvania">Pennsylvania</option>
                                        <option value="Rhode Island">Rhode Island</option>
                                        <option value="South Carolina">South Carolina</option>
                                        <option value="South Dakota">South Dakota</option>
                                        <option value="Tennessee">Tennessee</option>
                                        <option value="Texas">Texas</option>
                                        <option value="Utah">Utah</option>
                                        <option value="Vermont">Vermont</option>
                                        <option value="Virginia">Virginia</option>
                                        <option value="Washington">Washington</option>
                                        <option value="West Virginia">West Virginia</option>
                                        <option value="Wisconsin">Wisconsin</option>
                                        <option value="Wyoming">Wyoming</option>
                                    </select>                                    
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
                    <p class="mt-2">If you already have an account. Please Login</p>
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
                    <p class="mt-2">Register Now, If you dont have an account</p>
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
