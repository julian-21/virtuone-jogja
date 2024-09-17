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
                                <td>{{ \Carbon\Carbon::parse($coaching->tanggal)->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Fix</th>
                                <td>{{ \Carbon\Carbon::parse($coaching->tanggal_fix)->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Selesai</th>
                                <td>
                                    @if ($coaching->tanggal_selesai)
                                    {{ \Carbon\Carbon::parse($coaching->tanggal_selesai)->format('d F Y') }}
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
                            <tr>
                                <th>Gambar</th>
                                <td>
                                    <!-- Displaying the image or file -->
                                    @if ($coaching->gambar)
                                    <div style="margin-bottom: 15px;">
                                        @if (in_array(strtolower(pathinfo($coaching->gambar, PATHINFO_EXTENSION)), ['jpeg', 'jpg', 'png', 'gif']))
                                        <img src="{{ asset('storage/gambar/' . $coaching->gambar) }}" alt="Coaching Image" style="max-width: 200px; height: auto;">
                                        @else
                                        <p>{{ strtoupper(pathinfo($coaching->gambar, PATHINFO_EXTENSION)) }} File</p>
                                        @endif
                                    </div>
                                    @else
                                    <p>No Image or File available</p>
                                    @endif

                                    <!-- Download button for the image or file -->
                                    @if ($coaching->gambar)
                                    <a href="{{ route('coachingadmin.download-file', ['fileName' => $coaching->gambar]) }}" class="btn btn-primary">Download Image/File</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            <!-- Tambahkan field lainnya sesuai kebutuhan -->
                        </tbody>
                    </table>
                    <br>
                    <a href="{{ route('coachingadmin.index') }}" class="btn btn-primary">Kembali ke Daftar Coaching Clinic</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection