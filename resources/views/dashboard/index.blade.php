@extends('layouts.main')
@section('content')

<section class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="pt-4">
                <h1 class="text-warning">Welcome, {{$user->first_name}}</h1>
            </div>
        </div>
        <div class="col-md-2">
            <div class="pt-4">
                <a class="btn btn-warning" href="{{route('user.logout')}}">Logout</a>
            </div>
        </div>
    </div>
</section>

<section class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="border bg-light">
                <div class="p-5">
                    <h4><strong>Name:</strong> {{$user->first_name}} {{$user->last_name}}</h4>
                    <p><strong>Email:</strong> {{$user->email}}</p>
                    <p><strong>State:</strong> {{$user->state}}</p>
                    <p><strong>Date of birth:</strong> {{$user->dob}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="border bg-light">
                <div class="p-5">
                    <h1>Personal Information</h1>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@push('js')
    
@endpush
