@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Profile') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('update_profile', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- User Data Section -->
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                        </div>

                        <!-- Profile Image Section -->
                        <div class="mb-3">
                            <label for="profile_image" class="form-label">{{ __('Profile Image') }}</label>
                            <input type="file" class="form-control" id="profile_image" name="image">
                            @if ($user->picture)
                                    <img src="{{ asset('images/' . $user->picture)}}" alt="User Image" class="img-fluid" style="width:250px;height:250px;">
                                @else
                                    <p>No image available</p>
                                @endif
                        </div>

                                                <!-- Role Section for Admin -->
                        @if(auth()->user()->role === 'admin')
                            <div class="mb-3">
                                <label for="role" class="form-label">{{ __('Role') }}</label>
                                <select class="form-control" id="role" name="role">
                                    <option value="user" @if($user->role === 'user') selected @endif>User</option>
                                    <option value="admin" @if($user->role === 'admin') selected @endif>Admin</option>
                                </select>
                            </div>
                        @endif

                        <!-- Button to Redirect to Password Section -->
                        <div class="mb-3">
                            <a href="{{route('profile_change_password' , $user->id)}}">{{ __('Change Password') }}</a>
                        </div>

                

                        <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection