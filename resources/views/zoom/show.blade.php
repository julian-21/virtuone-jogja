@extends('layouts.home')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Detail Media Teleconference</h1>

            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Meeting ID</th>
                            <th>Passcode</th>
                            <th>Link Zoom</th>
                            <th>Media Teleconference</th>
                            <!-- Tambahkan kolom lain sesuai kebutuhan -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $zoom->id }}</td>
                            <td>{{ $zoom->meeting_id }}</td>
                            <td>{{ $zoom->passcode }}</td>
                            <td><a href="{{ $zoom->link_zoom }}" class="text-primary">{{ $zoom->link_zoom }}</a></td>
                            <td>{{ $zoom->media_teleconference }}</td>
                            <!-- Tambahkan baris-baris data lain sesuai kebutuhan -->
                        </tr>
                    </tbody>
                </table>
            </div>

            <a href="{{ route('zoom.index') }}" class="btn btn-primary">Kembali ke Daftar Zoom Meeting</a>
        </div>
    </div>
</div>
@endsection
