<!-- edit-role.blade.php -->

@extends('layouts.index')

@section('content')
<br>
<div class="container mt-4">
    <h2 class="mb-4">Edit User Role</h2>
    <form method="POST" action="{{ route('update.role', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-control" id="role" name="role" required>
                <option value="USER" @if($user->role == 'USER') selected @endif>User</option>
                <option value="ADMIN" @if($user->role == 'ADMIN') selected @endif>Admin</option>
                <option value="VA" @if($user->role == 'VA') selected @endif>VA</option>
                <option value="PETUGAS" @if($user->role == 'PETUGAS') selected @endif>Petugas</option>
                <!-- Add other roles as needed -->
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Role</button>
    </form>
</div>
@endsection
