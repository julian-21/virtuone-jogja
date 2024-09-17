<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Formulir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('images/logokanreg1.png') }}" type="image/x-icon">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-info mb-1 mx-auto">
                    <div class="card-body">
                        <div class="border-info">
                            <img src="{{ asset('images/banner.png') }}" class="card-img-top" alt="">
                        </div>
                        <h2 class="card-title">Selamat Pendaftaran Konsultasi Anda Berhasil</h2>
                        <p class="card-text">"Berikut jadwal teleconference beserta tautan untuk bergabung. Jadwal di bawah sewaktu-waktu bisa berubah menyesuaikan waktu petugas yang akan memberikan layanan konsultasi. Silahkan pantau melalui fitur <a href="{{ route('cek-kode') }}">Cek Info</a>."</p>
                        <div class="card border-info">
                            <div class="card-header"><strong>Hasil Pendaftaran Konsultasi</strong></div>
                            <div class="card-body">
                                <h5 class="card-title">Nama</h5>
                                <p class="card-text">{{ $formulir->nama }}</p>
                                <h5 class="card-title">NIP</h5>
                                <p class="card-text">{{ $formulir->nip }}</p>
                                <h5 class="card-title">Jabatan</h5>
                                <p class="card-text">{{ $formulir->jabatan }}</p>
                                <h5 class="card-title">Unit Kerja</h5>
                                <p class="card-text">{{ $unitkerja_combined }}</p> <?php //{{ $formulir->unitkerja }} -  ?>
                                <h5 class="card-title">Nomor HP</h5>
                                <p class="card-text">{{ $formulir->nomorhp }}</p>
                                <h5 class="card-title">Email</h5>
                                <p class="card-text">{{ $formulir->email }}</p>
                                <h5 class="card-title">Permasalahan yang akan Ditanyakan</h5>
                                <p class="card-text">{{ $formulir->keluhan }}</p>
                                @if ($formulir->tanggal_fix==$formulir->tanggal)
                                <h5 class="card-title">Tanggal Permohonan dan Persetujuan</h5>
                                <p class="card-text">{{ \Carbon\Carbon::parse($formulir->tanggal_fix)->format('d F Y') }}</p>
                                @else <!-- Jika tidak, periksa apakah tanggal ada -->
                                <h5 class="card-title">Tanggal Permohonan</h5>
                                <p class="card-text">{{ \Carbon\Carbon::parse($formulir->tanggal)->format('d F Y') }}</p>
                                <h5 class="card-title">Tanggal Persetujuan</h5>
                                <p class="card-text">{{ \Carbon\Carbon::parse($formulir->tanggal_fix)->format('d F Y') }}</p>
                                @endif
                                <!-- Tampilkan data jam sesuai kebutuhan -->
                                @if ($formulir->jam_fix == $formulir->jam)
                                    <h5 class="card-title">Jam Permohonan</h5>
                                    <p class="card-text">{{ $jamPermohonan }}</p>
                                @else
                                    <h5 class="card-title">Jam Permohonan</h5>
                                    <p class="card-text">{{ $jamPermohonan }}</p>
                                    <h5 class="card-title">Jam Persetujuan</h5>
                                    <p class="card-text">{{ $jamPersetujuan }}</p>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div  class="card border-info mt-30">
                            <div class="card-header"><strong>Informasi Media Teleconference</strong></div>
                            <div class="card-body">
                                <!-- Tampilkan data Zoom sesuai kebutuhan -->
                                @if ($zoom)
                                    <p class="card-text">Media Teleconference : {{ $zoom->media_teleconference }}</p>
                                    <p class="card-text">Meeting ID : {{ $zoom->meeting_id }}</p>
                                    <p class="card-text">Passcode : {{ $zoom->passcode }}</p>
                                    <p class="card-text">Link : <a href="{{ $zoom->link_zoom }}" style="color: blue;" target="_blank">{{ $zoom->link_zoom }}</a></p>
                                @else
                                    <p>Data Zoom tidak tersedia.</p>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div  class="card border-info">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <strong>Kode Tiket</strong>
                                    <strong><h2 class="card-text text-primary">{{ $formulir->kode }}</h2></strong>
                                </h5>
                                <p class="card-text text-danger">Harap simpan kode tersebut untuk mengetahui info selanjutnya</p>
                            </div>
                        </div>
                        <a href="{{ route('homeindex') }}" class="btn btn-primary mt-3" onclick="clearFormData()">Kembali ke Halaman Utama</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('js/create.js') }}"></script>
</html>