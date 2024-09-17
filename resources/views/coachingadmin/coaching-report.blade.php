@extends('layouts.index')

@section('content')
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Daftar Coaching Clinic</h1>

                    @if (count($coachings) > 0)
                    <div class="table-responsive">
                    <form method="GET" action="{{ route('coaching-report') }}" style="display: inline;">
                            <div class="form-group">
                                <label>Mulai Tanggal:</label>
                                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">

                                <label>Sampai Tanggal:</label>
                                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">

                                <button type="submit" class="btn btn-primary mt-2">Terapkan</button>
                                <a href="{{ route('coaching.export', ['start_date' => $start_date, 'end_date' => $end_date]) }}" class="btn btn-success mt-2">Export to Excel</a>
                                <a href="{{ route('coachingadmin.index') }}" class="btn btn-danger mt-2">Kembali</a>
                            </div>
                        </form>
                        <table class="table mt-3" id="example1">
                            <thead>
                                <br>
                                <tr>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Tanggal dan Jam Pengajuan</th>
                                    <th>Tanggal Fix</th>
                                    <th>Jam Fix</th>
                                    <th>Petugas</th>
                                    <th>VA</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coachings as $coaching)
                                <tr>
                                    <td>{{ $coaching->nama }}</td>
                                    <td>{{ $coaching->nip }}</td>
                                    <td>{{ \Carbon\Carbon::parse($coaching->tanggal)->format('d/m/Y') }} <br> {{ $coaching->jam_usul }}</td>
                                    <td>{{ \Carbon\Carbon::parse($coaching->tanggal_fix)->format('d/m/Y') }}</td>
                                    <td>{{ $coaching->jam_final }}</td>
                                    <td>
                                        @if ($coaching->nama_petugas)
                                        {{ $coaching->nama_petugas }}
                                        @else
                                        <span class="text-danger">Belum ada Petugas</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($coaching->nama_va)
                                        {{ $coaching->nama_va }}
                                        @else
                                        <span class="text-danger">Belum ada VA</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($coaching->tanggal_selesai)
                                        {{ \Carbon\Carbon::parse($coaching->tanggal_selesai)->format('d/m/Y') }}
                                        @else
                                        <span class="text-danger">Coaching Clinic belum selesai</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            @if ($coaching->va_id === null)
                                            @if (!$coaching->va_id)
                                            <a href="{{ route('coachingadmin.show', $coaching->id) }}" class="btn btn-info btn-sm mb-2" data-content-url="{{ route('coachingadmin.show', $coaching->id) }}">Lihat</a>
                                            <!-- Tombol Klaim -->
                                            <form action="{{ route('coachingadmin.claim', $coaching->id) }}" method="POST" style="display:inline">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm mt-2">Klaim</button>
                                            </form>
                                            @else
                                            <!-- Tombol Unclaim -->
                                            <form action="{{ route('coachingadmin.unclaim', $coaching->id) }}" method="POST" style="display:inline">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm mt-2">Unclaim</button>
                                            </form>
                                            @endif
                                            @else
                                            @if ($coaching->is_completed == 1)
                                            <!-- Tombol Lihat hanya muncul jika is_complete adalah 1 -->
                                            <a href="{{ route('coachingadmin.show', $coaching->id) }}" class="btn btn-info btn-sm mb-2" data-content-url="{{ route('coachingadmin.show', $coaching->id) }}">Lihat</a>
                                            @else
                                            @if (!$coaching->va_id || $coaching->va_id === auth()->user()->id)
                                            <a class="btn btn-success btn-sm mb-2" href="https://api.whatsapp.com/send?phone={{ $coaching->nomorhp }}&text={{ $coaching->pesanwa }}" target="_blank">Kirim Pesan</a>
                                            <a href="{{ route('coachingadmin.edit', $coaching->id) }}" class="btn btn-warning btn-sm mb-2" data-content-url="{{ route('coachingadmin.edit', $coaching->id) }}">Edit</a>
                                            @else
                                            <!-- VA lain tidak dapat melihat atau mengklaim coaching -->
                                            @endif
                                            <a href="{{ route('coachingadmin.show', $coaching->id) }}" class="btn btn-info btn-sm mb-2" data-content-url="{{ route('coachingadmin.show', $coaching->id) }}">Lihat</a>
                                            @if (!$coaching->va_id)
                                            <!-- Tombol Klaim -->
                                            <form action="{{ route('coachingadmin.claim', $coaching->id) }}" method="POST" style="display:inline">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm mt-2">Klaim</button>
                                            </form>
                                            @else
                                            <!-- Tombol Unclaim -->
                                            <form action="{{ route('coachingadmin.unclaim', $coaching->id) }}" method="POST" style="display:inline">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm mt-2">Unclaim</button>
                                            </form>
                                            @endif
                                            @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="mt-3">Tidak ada coaching yang tersedia.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection