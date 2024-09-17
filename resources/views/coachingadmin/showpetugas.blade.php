@extends('layouts.home')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card mt-5">
                <div class="card-body">
                    <h1 class="card-title">Detail Coaching Clinic</h1>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Nama</th>
                                <td>{{ $coaching->nama }}</td>
                            </tr>
                            <tr>
                                <th>NIP</th>
                                <td>{{ $coaching->nip }}</td>
                            </tr>
                            <tr>
                                <th>Jabatan</th>
                                <td>{{ $coaching->jabatan }}</td>
                            </tr>
                            <tr>
                                <th>Unit Kerja</th>
                                <td>{{ $coaching->unitkerja }} {{ $unitkerja_combined }}</td>
                            </tr>
                            <tr>
                                <th>Nomor Hp</th>
                                <td>{{ $coaching->nomorhp }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $coaching->email }}</td>
                            </tr>
                            <tr>
                                <th>Materi Coaching ASN</th>
                                <td>{{ $materi->nama_materi }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Pengajuan</th>
                                <td>{{ $coaching->tanggal }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Fix</th>
                                <td>{{ $coaching->tanggal_fix }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Selesai</th>
                                <td>
                                    @if ($coaching->tanggal_selesai)
                                    {{ $coaching->tanggal_selesai }}
                                    @else
                                    <span class="text-danger">Coaching Clinic Belum Selesai</span>
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
                            <!-- Tambahkan field lainnya sesuai kebutuhan -->
                        </tbody>
                    </table>
                    <br>
                    <a href="{{ route('coachingadmin.indexpetugas') }}" class="btn btn-primary">Kembali ke Daftar Coaching Clinic</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection