<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="icon" href="{{ asset('images/logokanreg1.png') }}" type="image/x-icon">
    <title>Login Sagutep</title>
</head>

<body>
    <video autoplay loop muted plays-inline class="back-video">
        <source src="{{ asset('images/bg2.mp4') }}" type="video/mp4">
    </video>

    <!----------------------- Main Container -------------------------->

    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <!----------------------- Login Container -------------------------->

        <div class="row border rounded-5 p-3 bg-white shadow box-area">

            <!--------------------------- Left Box ----------------------------->

            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #ffffff;">
                <div class="featured-image mb-3">
                    <img src="{{ asset('images/logokanreg1.png') }}" class="img-fluid" style="width: 200px;">
                </div>
                <p class="text-black fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Nigol</p>
                <small class="text-black text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Sagutep</small>
            </div>

            <!-------------------- ------ Right Box ---------------------------->

            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>Login</h2>
                        <p>Sagutep</p>
                    </div>
                    <form method="POST" action="{{ route('sagutep') }}">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="email" class="form-control form-control-lg bg-light fs-6" id="email" name="email" value="{{ old('email') }}" placeholder="Email address" required autofocus>
                        </div>
                        <div class="input-group mb-1">
                            <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password" id="password" name="password">
                        </div>
                        <div class="input-group mb-5 d-flex justify-content-between">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="formCheck">
                                <label for="formCheck" class="form-check-label text-secondary"><small>Remember Me</small></label>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <button class="btn btn-lg btn-danger w-100 fs-6">Login</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</body>

</html>