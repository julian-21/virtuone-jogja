@extends('layouts.home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Buat Media Teleconference Baru</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('zoom.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="meeting_id" class="form-label">Meeting ID</label>
                            <input type="text" id="meeting_id" name="meeting_id" value="{{ old('meeting_id') }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="passcode" class="form-label">Passcode</label>
                            <input type="text" id="passcode" name="passcode" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="link_zoom" class="form-label">Link Zoom</label>
                            <input type="text" id="link_zoom" name="link_zoom" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="media_teleconference" class="form-label">Media Teleconference</label>
                            <input type="text" id="media_teleconference" name="media_teleconference" class="form-control" required>
                        </div>
                        
                        <div class="text-left">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
