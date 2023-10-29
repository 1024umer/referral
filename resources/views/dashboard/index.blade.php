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
                <div class="p-5 text-center">
                    <div class="">
                        <img class="my-4" src="{{$user->image_url}}" alt="">
                    </div>
                    <h4><strong>Name: </strong> {{$user->full_name}}</h4>
                    <p><strong>Email: </strong> {{$user->email}}</p>
                    <p><strong>State: </strong> {{$user->state}}</p>
                    <p><strong>Date of birth: </strong> {{$user->dob}}</p>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="border bg-light">
                <div class="p-5">
                    <h1>Personal Information</h1>
                    <div>
                        @if (isset($parent))
                            <p><strong>Reffered By: </strong>{{$parent->full_name}}</p>
                        @endif
                        <p><strong>Current Balance:</strong>${{$user->balance}}</p>
                        <p><strong>Referral Link:</strong> <a id="referralLink" href="javascript:void(0)">{{$link}}</a></p>
                        <button class="btn btn-outline-warning" id="copyLinkBtn">Copy Link</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@push('css')
   <style>
    img{
    width: 200px;
    border-radius: 100%;
    height: 200px;
    border: 2px solid #ffc107;
    padding: 9px;
    }
    </style> 
@endpush
@push('js')
<script>
    document.getElementById('copyLinkBtn').addEventListener('click', function() {
        var referralLink = document.getElementById('referralLink');
        var tempInput = document.createElement('input');
        tempInput.value = referralLink.textContent;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
        alert('Referral link copied to clipboard');
    });
</script>

@endpush
