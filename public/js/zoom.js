$(document).ready(function () {
    // Tangani tautan saat diklik
    $("a.btn-info, a.btn-warning, form button.btn-danger").on("click", function (e) {
        e.preventDefault();

        // Ambil URL dari atribut href atau action (tergantung pada tautan atau form)
        var url = $(this).attr("href") || $(this).closest("form").attr("action");

        // Lakukan permintaan AJAX untuk memuat konten
        $.ajax({
            url: url,
            type: "GET",
            success: function (response) {
                // Ganti konten di dalam div dengan ID "dynamic-content" dengan konten yang dimuat
                $("#dynamic-content").html(response);
            },
            error: function (xhr, status, error) {
                console.error("Error:", error);
            },
        });
    });
});



