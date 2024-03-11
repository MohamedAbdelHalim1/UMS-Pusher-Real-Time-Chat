@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Change Password') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('update_password', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
                                <input type="password" class="form-control" id="current_password" name="current_password" required>
                            </div>

                            <div class="mb-3">
                                <label for="new_password" class="form-label">{{ __('New Password') }}</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                            </div>

                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">{{ __('Confirm New Password') }}</label>
                                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('Change Password') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection