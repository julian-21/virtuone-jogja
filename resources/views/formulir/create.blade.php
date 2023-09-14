<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Isi Formulir</div>

                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form action="{{ route('formulir.store') }}" method="POST">
                        @csrf

                        <!-- Nama -->
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" required>
                        </div>

                        <!-- NIP -->
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" name="nip" id="nip" class="form-control" required>
                        </div>

                        <!-- Jabatan -->
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan" class="form-control" required>
                        </div>

                        <!-- Nama Instansi -->
                        <div class="form-group">
                            <label for="namainstansi">Nama Instansi</label>
                            <input type="text" name="namainstansi" id="namainstansi" class="form-control" required>
                        </div>

                        <!-- Nomor HP -->
                        <div class="form-group">
                            <label for="nomorhp">Nomor HP</label>
                            <input type="text" name="nomorhp" id="nomorhp" class="form-control" required>
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <!-- Keluhan -->
                        <div class="form-group">
                            <label for="keluhan">Keluhan</label>
                            <textarea name="keluhan" id="keluhan" class="form-control" rows="4" required></textarea>
                        </div>

                        <!-- Tanggal -->
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                        </div>

                        <!-- Jam -->
                        <div class="form-group">
                            <label for="jam">Pilih Jam (Maksimal 3)</label>
                            <select name="jam[]" class="form-control" multiple>
                                @foreach ($jams as $jam)
                                <option value="{{ $jam->id }}">{{ $jam->jam }}</option>
                                @endforeach
                            </select>
                            @error('jam')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tombol Simpan -->
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <!-- Tampilkan kode unik jika ada -->
                        @if(session('kode_unik'))
                        <div class="mt-3">
                            Kode Zoom Anda adalah: {{ session('kode_unik') }}
                        </div>
                        @endif
                    </form>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const selectJam = document.getElementById('select-jam');
                            const maxSelections = 3;

                            selectJam.addEventListener('change', function() {
                                const selectedOptions = Array.from(selectJam.selectedOptions);
                                if (selectedOptions.length > maxSelections) {
                                    alert('Anda hanya dapat memilih maksimal 3 jam.');
                                    selectedOptions.forEach(option => {
                                        if (!option.selected) {
                                            option.disabled = true;
                                        }
                                    });
                                } else {
                                    selectedOptions.forEach(option => {
                                        option.disabled = false;
                                    });
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>