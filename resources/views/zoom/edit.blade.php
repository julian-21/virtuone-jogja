@extends('layouts.home')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Edit Zoom Meeting</h1>
            <br>
            <form action="{{ route('zoom.update', $zoom->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="meeting_id" class="form-label">Meeting ID</label>
                        <input type="text" name="meeting_id" id="meeting_id" class="form-control" value="{{ $zoom->meeting_id }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="passcode" class="form-label">Passcode</label>
                        <input type="text" name="passcode" id="passcode" class="form-control" value="{{ $zoom->passcode }}" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="link_zoom" class="form-label">Link Zoom</label>
                    <input type="text" name="link_zoom" id="link_zoom" class="form-control" value="{{ $zoom->link_zoom }}" required>
                </div>
                <div class="mb-3">
                    <label for="media_teleconference" class="form-label">Media Teleconference</label>
                    <input type="text" name="media_teleconference" id="media_teleconference" class="form-control" value="{{ $zoom->media_teleconference }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <br>
                <br>
                <a href="{{ route('zoom.index') }}" class="btn btn-primary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
