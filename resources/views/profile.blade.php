@extends('layouts.app')

@section('content')
<div class="container">
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>
@endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('User Profile') }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                @if ($user->picture)
                                    <img src="{{ asset('images/' . $user->picture)}}" alt="User Image" class="img-fluid">
                                @else
                                    <p>No image available</p>
                                @endif
                                <!-- Add form for image upload if needed -->
                            </div>
                            <div class="col-md-8">
                                <h5>{{ $user->name }}</h5>
                                <p>Email: {{ $user->email }}</p>
                                <!-- Add more user information as needed -->

                                <!-- Example: Display user role -->
                                <p>Role: {{ $user->role }}</p>

                                <!-- Edit Profile Button -->
                                <a href="{{ route('profile.edit',['id' => Auth::id()]) }}" class="btn btn-primary">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
