@extends('layouts.index')

@section('content')
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Daftar Coaching</h1>

                    @if (count($coachings) > 0)
                    <form method="POST" action="{{ route('coachingadmin.update-status') }}">
                        @csrf
                        <table class="table mt-3" id="example1">
                            <thead>
                                <br>
                                <tr>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Tanggal dan Jam Pengajuan</th>
                                    <th>Tanggal Fix</th>
                                    <th>Jam Fix</th>
                                    <th>VA</th>
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
                                        @if ($coaching->nama_va)
                                        {{ $coaching->nama_va }}
                                        @else
                                        <span class="text-danger">Belum ada VA</span>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Button to trigger the modal -->
                                        <button type="button" class="btn btn-secondary btn-sm mb-2" data-toggle="modal" data-target="#imageModal{{$coaching->id}}">
                                            @if ($coaching->gambar)
                                            Lihat File
                                            @else
                                            Unggah File
                                            @endif
                                        </button>

                                        <!-- Modal for viewing and managing an image -->
                                        <div class="modal fade" id="imageModal{{$coaching->id}}" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel{{$coaching->id}}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="imageModalLabel{{$coaching->id}}">
                                                            @if ($coaching->gambar)
                                                            File
                                                            @else
                                                            Unggah File
                                                            @endif
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if ($coaching->gambar)
                                                        @if (in_array(pathinfo($coaching->gambar, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                        <!-- Display the uploaded image -->
                                                        <img src="{{ asset('storage/gambar/' . $coaching->gambar) }}" alt="Gambar" class="img-thumbnail">
                                                        @elseif (in_array(pathinfo($coaching->gambar, PATHINFO_EXTENSION), ['doc', 'docx', 'pdf', 'xls', 'xlsx']))
                                                        <!-- Display the link to download the file -->
                                                        <a href="{{ asset('storage/gambar/' . $coaching->gambar) }}" target="_blank">Lihat File</a>
                                                        @else
                                                        <p>Unsupported file type</p>
                                                        @endif

                                                        <!-- Button to delete the image -->
                                                        <form method="POST" action="{{ route('coachingadmin.hapus-gambar', $coaching->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger mt-2">Hapus File</button>
                                                        </form>
                                                        @else
                                                        <!-- File upload form -->
                                                        <form method="POST" action="{{ route('coachingadmin.upload-file') }}" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="coaching_id" value="{{ $coaching->id }}">
                                                            <div class="form-group">
                                                                <label for="gambar{{$coaching->id}}">Pilih File</label>
                                                                <input type="file" name="gambar" class="form-control-file" id="gambar{{$coaching->id}}">
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Unggah</button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Tampilkan tombol "Tandai Selesai" hanya jika ada gambar -->
                                        @if ($coaching->gambar)
                                        <form method="POST" action="{{ route('coachingadmin.update-status') }}">
                                            @csrf
                                            <input type="hidden" name="coaching_ids[]" value="{{ $coaching->id }}">
                                            <button type="submit" class="btn btn-primary btn-sm mb-2">Tandai Selesai</button>
                                        </form>
                                        @endif
                                        <a href="{{ route('coachingadmin.showpetugas', $coaching->id) }}" class="btn btn-info btn-sm mb-2" data-content-url="{{ route('coachingadmin.showpetugas', $coaching->id) }}">Lihat</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                    @else
                    <p class="mt-3">Tidak ada Coaching yang tersedia.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection