@extends('layouts.index')

@section('content')
<br>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Daftar Formulir</h1>

                    @if (count($formulirs) > 0)
                    <form method="POST" action="{{ route('formuliradmin.update-status') }}">
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
                                @foreach ($formulirs as $formulir)
                                <tr>
                                    <td>{{ $formulir->nama }}</td>
                                    <td>{{ $formulir->nip }}</td>
                                    <td>{{ \Carbon\Carbon::parse($formulir->tanggal)->format('d/m/Y') }} <br> {{ $formulir->jam_usul }}</td>
                                    <td>{{ \Carbon\Carbon::parse($formulir->tanggal_fix)->format('d/m/Y') }}</td>
                                    <td>{{ $formulir->jam_final }}</td>
                                    <td>
                                        @if ($formulir->nama_va)
                                        {{ $formulir->nama_va }}
                                        @else
                                        <span class="text-danger">Belum ada VA</span>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Button to trigger the modal -->
                                        <button type="button" class="btn btn-secondary btn-sm mb-2" data-toggle="modal" data-target="#imageModal{{$formulir->id}}">
                                            @if ($formulir->gambar)
                                            Lihat Gambar 
                                            @else
                                            Unggah Gambar
                                            @endif
                                        </button>
                                        <!-- Modal for viewing and managing an image -->
                                        <div class="modal fade" id="imageModal{{$formulir->id}}" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel{{$formulir->id}}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="imageModalLabel{{$formulir->id}}">
                                                            @if ($formulir->gambar)
                                                            Gambar
                                                            @else
                                                            Unggah Gambar
                                                            @endif
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if ($formulir->gambar)
                                                        <!-- Display the uploaded image -->
                                                        <img src="{{ asset('storage/gambar/' . $formulir->gambar) }}" alt="Gambar" class="img-thumbnail">

                                                        <!-- Button to delete the image -->
                                                        <form method="POST" action="{{ route('formuliradmin.hapus-gambar', $formulir->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger mt-2">Hapus Gambar</button>
                                                        </form>
                                                        @else
                                                        <!-- Image upload form -->
                                                        <form method="POST" action="{{ route('formuliradmin.upload-gambar') }}" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="formulir_id" value="{{ $formulir->id }}">
                                                            <div class="form-group">
                                                                <label for="gambar{{$formulir->id}}">Pilih Gambar</label>
                                                                <input type="file" name="gambar" class="form-control-file" id="gambar{{$formulir->id}}">
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
                                         @if ($formulir->gambar)
                                        <form method="POST" action="{{ route('formuliradmin.update-status') }}">
                                            @csrf
                                            <input type="hidden" name="formulir_ids[]" value="{{ $formulir->id }}">
                                            <button type="submit" class="btn btn-primary btn-sm mb-2">Tandai Selesai</button>
                                        </form>
                                        @endif
                                        <a href="{{ route('formuliradmin.showpetugas', $formulir->id) }}" class="btn btn-info btn-sm mb-2" data-content-url="{{ route('formuliradmin.showpetugas', $formulir->id) }}">Lihat</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                    @else
                    <p class="mt-3">Tidak ada formulir yang tersedia.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
