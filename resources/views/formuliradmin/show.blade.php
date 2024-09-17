@extends('layouts.home')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-body">
                    <h1 class="card-title">Detail Formulir</h1>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $formulir->nama }}</td>
                            </tr>
                            <tr>
                                <th>NIP</th>
                                <td>{{ $formulir->nip }}</td>
                            </tr>
                            <tr>
                                <th>Jabatan</th>
                                <td>{{ $formulir->jabatan }}</td>
                            </tr>
                            <tr>
                                <th>Unit Kerja</th>
                                <td>{{ $formulir->unitkerja }} - {{ $unitkerja_combined }}</td>
                            </tr>
                            <tr>
                                <th>Nomor Hp</th>
                                <td>{{ $formulir->nomorhp }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $formulir->email }}</td>
                            </tr>
                            <tr>
                                <th>Keluhan</th>
                                <td>{{ $formulir->keluhan }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Pengajuan</th>
                                <td>{{ \Carbon\Carbon::parse($formulir->tanggal)->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Fix</th>
                                <td>{{ \Carbon\Carbon::parse($formulir->tanggal_fix)->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Selesai</th>
                                <td>
                                    @if ($formulir->tanggal_selesai)
                                    {{ \Carbon\Carbon::parse($formulir->tanggal_selesai)->format('d F Y') }}
                                    @else
                                    <span class="text-danger">Konsultasi Belum Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @foreach ($jamPermohonan as $index => $jam)
                            <tr>
                                <th>Jam Pengajuan</th>
                                <td>{{ $jam }}</td>
                            </tr>
                            <tr>
                                <th>Jam Persetujuan</th>
                                <td>{{ $jamPersetujuan[$index] }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <th>Gambar</th>
                                <td>
                                    <!-- Displaying the image -->
                                    @if ($formulir->gambar)
                                    <div style="margin-bottom: 15px;">
                                        <img src="{{ asset('storage/gambar/' . $formulir->gambar) }}" alt="Formulir Image" style="max-width: 200px; height: auto;">
                                    </div>
                                    @else
                                    <p>No Image available</p>
                                    @endif
                                    <!-- Download button for the image -->
                                    @if ($formulir->gambar)
                                    <a href="{{ route('formuliradmin.download-foto', ['fileName' => $formulir->gambar]) }}" class="btn btn-success">Download Image</a>
                                    @endif
                                </td>
                            </tr>
                            <!-- Tambahkan field lainnya sesuai kebutuhan -->
                        </tbody>
                    </table>
                    <br>
                    <a href="{{ route('formuliradmin.index') }}" class="btn btn-primary">Kembali ke Daftar Formulir</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection