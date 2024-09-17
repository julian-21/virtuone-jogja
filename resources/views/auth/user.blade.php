@extends('layouts.index')

@section('content')
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title" style="margin-bottom: 20px;">Daftar Akun</h1>
                    <div class="table-responsive">
                        <table class="table mt-3" id="example1">
                            <thead>
                                <a href="{{ route('register') }}" class="btn btn-secondary" style="margin-bottom: 20px;">Tambah User</a>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <a href="{{ route('change.password', $user->id) }}" class="btn btn-primary">Change Password</a>
                                        @if($user->is_active == 'yes')
                                        <a href="{{ route('deactivate.user', $user->id) }}" class="btn btn-danger">Deactivate Account</a>
                                        @else
                                        <a href="{{ route('activate.user', $user->id) }}" class="btn btn-success">Activate Account</a>
                                        @endif
                                        <a href="{{ route('edit.role', $user->id) }}" class="btn btn-info">Edit Role</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">No users found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection