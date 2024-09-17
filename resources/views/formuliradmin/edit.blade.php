@extends('layouts.home')

@section('content')
<div class="container mt-4" id="dynamic-content">
    <div class="card mt-5">
        <div class="card-body">
            <h1 class="card-title">Edit Formulir</h1>
            <br>

            <form action="{{ route('formuliradmin.update', $formulir->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $formulir->nama }}" required>
                </div>

                <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="text" class="form-control" id="nip" name="nip" value="{{ $formulir->nip }}" required>
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal Pengajuan</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $formulir->tanggal }}" required disabled>
                </div>
                @foreach ($jamPermohonan as $index => $jam)
                <div class="form-group">
                    <label for="jam">Jam Pengajuan</label>
                    <input type="text" class="form-control" id="jam" name="jam" value="{{ $jam }}" readonly>
                </div>
                @endforeach
                <div class="form-group">
                    <label for="tanggal_fix">Tanggal Fix</label>
                    <input type="date" class="form-control" id="tanggal_fix" name="tanggal_fix" value="{{ $formulir->tanggal_fix }}" required>
                </div>

                <div class="form-group">
                    <label for="jam_fix">Jam Fix</label>
                    <select class="form-control" id="jam_fix" name="jam_fix" required>
                        @foreach ($allJams as $jam)
                        <option value="{{ $jam->id }}" {{ $formulir->jams->contains($jam->id) ? 'selected' : '' }}>
                            {{ $jam->jam }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="media_teleconference">Media Teleconference</label>
                    <select class="form-control" id="media_teleconference" name="media_teleconference" required>
                        @foreach ($zoomsOptions as $zoom)
                        <option value="{{ $zoom->media_teleconference }}" {{ $formulir->media == $zoom->media_teleconference ? 'selected' : '' }}>
                            {{ $zoom->media_teleconference }} - {{ $zoom->meeting_id }}

                            @if ($zoom->is_zoom_active)
                            (Active)
                            @else
                            (Not Active)
                            @endif
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="petugas_konsultasi">Petugas Konsultasi</label>
                    <select class="form-control" id="petugas_konsultasi" name="petugas_konsultasi" required>
                        @foreach ($petugasOptions as $petugas)
                        <option value="{{ $petugas->id }}">{{ $petugas->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary" id="btn-simpan">Simpan</button>
                    <a href="{{ route('formuliradmin.index') }}" class="btn btn-secondary" id="btn-kembali">Kembali ke Daftar Formulir</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection