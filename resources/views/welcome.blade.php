<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VirtuOne - Kanreg I BKN Yogyakarta</title>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="icon" href="{{ asset('images/logokanreg1.png') }}" type="image/x-icon">
</head>

<body>
    <header>
        <div class="nav container">
            <div class="logo-container">
                <img src="{{ asset('images/logokanreg1.png') }}" alt="Additional Image" class="additional-image">
                <a href="#" class="logo">Virtu<span>One</span>
                </a>
            </div>
            <div class="header-images">
                <img src="{{ asset('images/logo-berakhlak-1.png') }}" alt="Logo" class="headerlogo">
                <img src="{{ asset('images/logo-bangga-melayani-bangsa-1.png') }}" alt="Logo" class="headerlogo">
            </div>
        </div>
    </header>
    <section class="home" id="home">
        <div class="home-text container">
            <img src="{{ asset('images/logokanreg1.png') }}" alt="Logo" class="kanreglogo">
            <h2 class="home-title">Pelayanan Gratis</h2>
            <span class="home-subtitle">Dilaksanakan Secara Virtual</span>
        </div>
    </section>
    <div class="post-filter container">
        <span class="filter-item active-filter" data-filter="jenis">Jenis Layanan</span>
        <span class="filter-item" data-filter="konsultasi">Konsultasi</span>
        <span class="filter-item" data-filter="coaching">Coaching Clinic</span>
    </div>
    <section class="post container">

        <div class="post-box konsultasi">
            <a href="{{ route('formulir.create') }}">
                <img src="{{ asset('images/1.png') }}" alt="" class="post-img">
            </a>
            <div class="post-content">
                <h2 class="konsultasi">Konsultasi</h2>
                <a href="{{ route('formulir.create') }}" class="post-title">
                    Pendaftaran Konsultasi
                </a>
            </div>
        </div>
        <div class="post-box coaching">
            <a href="{{ route('coaching.create') }}">
                <img src="{{ asset('images/2.png') }}" alt="" class="post-img">
            </a>
            <div class="post-content">
                <h2 class="coaching">Coaching Clinic</h2>
                <a href="{{ route('coaching.create') }}" class="post-title">
                    Pendaftaran Coaching Clinic
                </a>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <div class="footer-container container">
            <div class="footer-logo">
                <a href="#" class="logo">Virtu<span>One</span></a>
            </div>
            <div class="footer-links">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="https://yogyakarta.bkn.go.id">Official Website</a></li>
                    <li><a href="https://www.facebook.com/kanreg1bkn">Facebook</a></li>
                    <li><a href="https://www.instagram.com/kanreg1bkn/">Instagram</a></li>
                    <li><a href="https://bit.ly/kanreg1bknofficial">Youtube</a></li>
                </ul>
            </div>
            <div class="footer-social">
                <a href="https://www.facebook.com/kanreg1bkn" class="social-icon"><i class='bx bxl-facebook'></i></a>
                <a href="https://www.instagram.com/kanreg1bkn/" class="social-icon"><i class='bx bxl-instagram'></i></a>
                <!-- <a href="#" class="social-icon"><i class='bx bxl-twitter'></i></a> -->
            </div>
        </div>
        <div class="footer-bottom">
            <p> VirtuOne Kanreg I BKN Yogyakarta &copy; 2023 </p>
        </div>
    </footer>

    <script src="{{ asset('js/home.js') }}"></script>
    <script>
        const filterItems = document.querySelectorAll('.filter-item');
        const postBoxes = document.querySelectorAll('.post-box');

        filterItems.forEach((item) => {
            item.addEventListener('click', () => {
                const selectedCategory = item.getAttribute('data-filter');

                // Toggle the active class for the filter items
                filterItems.forEach((filterItem) => {
                    filterItem.classList.remove('active-filter');
                });
                item.classList.add('active-filter');

                // Toggle the display of post boxes based on the selected category
                postBoxes.forEach((postBox) => {
                    if (selectedCategory === 'jenis') {
                        postBox.style.display = 'block'; // Display all post boxes
                    } else if (postBox.classList.contains(selectedCategory)) {
                        postBox.style.display = 'block'; // Display the selected category's post boxes
                    } else {
                        postBox.style.display = 'none'; // Hide other post boxes
                    }
                });
            });
        });
    </script>
</body>

</html>