@extends('layouts.index')

@section('content')
<br>
<div class="container mt-4">
    <h2 class="mb-4">Change Password</h2>
    <form method="post" action="{{ route('change.password', $user->id) }}">
        @csrf
        <div class="mb-3">
            <label for="current_password" class="form-label">Current Password</label>
            <input type="password" class="form-control" id="current_password" name="current_password" required>
        </div>
        <div class="mb-3">
            <label for="new_password" class="form-label">New Password</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required>
        </div>
        <div class="mb-3">
            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
        </div>
        <button type="submit" class="btn btn-primary">Change Password</button>
    </form>
</div>
@endsection
