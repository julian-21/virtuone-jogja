<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran Coaching Clinic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <link rel="icon" href="{{ asset('images/logokanreg1.png') }}" type="image/x-icon">
    <style>
        /* Tambahkan gaya CSS berikut */
        .required::after {
            content: "*";
            color: red;
            margin-left: 5px;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card border-info mb-3 mt-3">
            <img src="{{ asset('images/banner2.png') }}" class="card-img-top" alt="">
            <div class="card-body">
                <h1 class="card-title text-center">Layanan Coaching Clinic</h1>
                <p class="card-text text-center">Layanan ini digunakan untuk melakukan Coaching Clinic yang dilakukan secara daring/online bagi instansi-instansi yang terkendala tidak bisa mengirim ASN-nya ke Kanreg I BKN. Fasilitas media teleconference akan disediakan oleh Kanreg I BKN. Layanan ini bersifat gratis, tidak dipungut biaya.</p>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <?php
                    if (config('global.buka_coaching')) {
                    ?>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Tombol untuk mengisi konsultasi -->
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Isi coaching</h5>
                                        <p class="card-text">Klik tombol di bawah untuk mengisi coaching Coaching Clinic.</p><br>
                                        <a href="#coaching-konsultasi" class="btn btn-primary">Isi Coaching Clinic</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                    } //if ($is_buka) {
                        ?>
                        <div class="col-md-6">
                            <!-- Tombol untuk mengecek kode -->
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Cek Info</h5>
                                    <p class="card-text">Klik tombol di bawah untuk melakukan pengecekan info dengan memasukkan kode yang telah diberi.</p>
                                    <a href="{{ route('cek-kode-coaching') }}" class="btn btn-success">Cek Info</a>
                                </div>
                            </div>
                        </div>
                        </div>


                        <br>
                        <?php
                        if (config('global.buka_coaching')) {
                        ?>
                            <form action="{{ route('coaching.store') }}" method="POST" id="coaching-konsultasi" enctype="multipart/form-data">
                                <h2 class="card-title text-center">Formulir Pendaftaran Coaching Clinic</h2>
                                @csrf
                                <!-- Nama -->
                                <div class="form-group">
                                    <label for="nama">Nama<span class="required"></span></label>
                                    <input type="text" name="nama" id="nama" class="form-control" autocomplete="nama" required>
                                    <small class="text-muted">Isikan Nama Anda.</small>
                                </div>

                                <!-- NIP -->
                                <div class="form-group">
                                    <label for="nip">NIP/NIK</label>
                                    <input type="text" name="nip" id="nip" class="form-control" required>
                                    <small class="text-muted">Isikan Nomor NIP/NIK Anda.</small>
                                </div>

                                <!-- Jabatan -->
                                <div class="form-group">
                                    <label for="jabatan">Jabatan<span class="required"></span></label>
                                    <input type="text" name="jabatan" id="jabatan" class="form-control" required>
                                    <small class="text-muted">Apabila bukan ASN silahkan Anda isi -</small>
                                </div>

                                <!-- Nama Instansi -->
                                <div class="form-group">
                                    <label for="unitkerja">Instansi<span class="required"></span></label>
                                    <select name="unitkerja" id="unitkerja" class="form-control select2" required>
                                        <option value="" hidden selected disabled>Pilih Instansi...</option>
                                        @foreach ($unitkerjaData as $instansi)
                                        <option value="{{ $instansi->unitkerja_kode }}">{{ $instansi->unitkerja }}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted">Apabila bukan ASN silahkan Anda pilih opsi Perorangan</small>
                                </div>

                                <!-- Nomor HP -->
                                <div class="form-group">
                                    <label for="nomorhp">Nomor HP<span class="required"></span></label>
                                    <input type="text" name="nomorhp" id="nomorhp" class="form-control" required>
                                    <small class="text-muted">Isikan Nomor HP yang dapat di hubungi melalui Whatsapp.</small>
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" autocomplete="email" required>
                                    <small class="text-muted">Isikan Email Anda.</small>
                                </div>

                                <!-- Tanggal -->
                                <div class="form-group">
                                    <label for="tanggal">Tanggal<span class="required"></span></label>
                                    <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                                    <small class="text-muted">Kepastian waktu/tanggal konsultasi akan diinfokan oleh pihak BKN.
                                        Silahkan cek berkala melalui fitur <a href="{{ route('cek-kode-coaching') }}">Cek Info</a> diatas</small>
                                </div>

                                <!-- Jam -->
                                <div class="form-group">
                                    <label for="jam">Pilih Jam<span class="required"></span></label>
                                    <select name="jam[]" id="jam" class="form-control select2" required>
                                        <option value="" hidden disabled selected>Pilih jam ...</option>
                                        @foreach ($jams as $jam)
                                        <option value="{{ $jam->id }}">{{ $jam->jam }}</option>
                                        @endforeach
                                    </select>
                                    @error('jam')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Kepastian waktu/tanggal konsultasi akan diinfokan oleh pihak BKN.
                                        Silahkan cek berkala melalui fitur <a href="{{ route('cek-kode-coaching') }}">Cek Info</a> diatas</small>
                                </div>

                                <!-- Element Manajemen ASN -->
                                <div class="form-group">
                                    <label for="elemenmanajemen">Materi Coaching Clinic:<span class="required"></span></label>
                                    <select id="elemenmanajemen" name="elemenmanajemen" class="form-control elemen">
                                        <option value="" hidden disabled selected>Pilih Materi Coaching Clinic ASN...</option>
                                        @foreach($materiCoachings as $materi)
                                        <option value="{{ $materi->id }}">{{ $materi->nama_materi }}</option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted"></small>
                                </div>

                                <div class="form-group mt-4 mb-4">
                                    <div class="captcha">
                                        <span>{!! captcha_img() !!}</span>
                                        <button type="button" class="btn btn-danger" class="reload" id="reload">
                                            &#x21bb;
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
                                </div>
                </div>
                <br>

                <!-- Tombol Simpan -->
                <button type="submit" class="btn btn-primary">Daftar</button>
                <a href="{{ route('homeindex') }}" class="btn btn-secondary btn-block">Kembali ke Beranda</a>
                <!-- Tampilkan kode unik jika ada -->
                @if(session('kode_unik'))
                <div class="mt-3">
                    Kode Zoom Anda adalah: {{ session('kode_unik') }}
                </div>
                @endif
                </form>

            <?php
                        } //if ($is_buka) {
            ?>
            <script src="{{ asset('js/coaching.js') }}"></script>
            </div>
        </div>
    </div>
    </div>
</body>

</html>