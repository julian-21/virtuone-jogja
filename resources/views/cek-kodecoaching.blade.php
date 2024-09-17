<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Info Coaching Clinic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('images/logokanreg1.png') }}" type="image/x-icon">
</head>

<body>
    <div class="container mt-3 mb-3">
        <div class="card">
            <img src="{{ asset('images/banner2.png') }}" class="card-img-top" alt="Banner Image">
            <div class="card-body">
                @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <h1 class="card-title">Cek Info Coaching Clinic</h1>
                <form action="{{ route('cek-kode-coaching.cek') }}" method="POST">
                    @csrf <!-- Ini adalah tag Blade @csrf -->
                    <!-- ... your form content ... -->
                    <div class="mb-3">
                        <label for="kode" class="form-label">Masukkan Kode</label>
                        <input type="text" name="kode" id="kode" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary btn-block">Cek Info</button>
                            <a href="{{ route('coaching.create') }}" class="btn btn-secondary btn-block">Kembali ke Formulir</a>
                            <a href="{{ route('homeindex') }}" class="btn btn-secondary btn-block">Kembali ke Beranda</a>
                        </div>
                    </div>
                </form>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const form = document.querySelector('form');

                        form.addEventListener('submit', function(event) {
                            const kodeInput = document.querySelector('#kode');
                            const kodeValue = kodeInput.value;

                            if (kodeValue.length !== 8) {
                                event.preventDefault();
                                alert('Kode harus terdiri dari tepat 8 karakter.');
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</body>

</html>
