// coaching.js

$(document).ready(function() {
    // Inisialisasi plugin Select2
    $('.select2').select2();
    $('.elemen').select2();

    // Periksa apakah ada data formulir coaching di penyimpanan lokal
    var coachingFormData = JSON.parse(localStorage.getItem('coachingFormData'));

    if (coachingFormData) {
        // Isi kembali formulir coaching dengan data yang tersimpan
        $('#nama').val(coachingFormData.nama);
        $('#nip').val(coachingFormData.nip);
        $('#jabatan').val(coachingFormData.jabatan);
        $('#unitkerja').val(coachingFormData.unitkerja).trigger('change');
        $('#nomorhp').val(coachingFormData.nomorhp);
        $('#email').val(coachingFormData.email);
        $('#tanggal').val(coachingFormData.tanggal);
        $('#jam').val(coachingFormData.jam).trigger('change');
        $('#elemenmanajemen').val(coachingFormData.elemenmanajemen).trigger('change');
    }

    // Simpan data formulir coaching ke penyimpanan lokal saat ada perubahan
    $('form').on('input', function() {
        saveCoachingFormData();
    });

    // Jika tombol Kembali ke Halaman Utama diklik, bersihkan data formulir coaching
    $('.btn-primary').on('click', function() {
        clearCoachingFormData();
    });

    // Fungsi untuk menyimpan data formulir coaching ke penyimpanan lokal
    function saveCoachingFormData() {
        var formData = {
            nama: $('#nama').val(),
            nip: $('#nip').val(),
            jabatan: $('#jabatan').val(),
            unitkerja: $('#unitkerja').val(),
            nomorhp: $('#nomorhp').val(),
            email: $('#email').val(),
            tanggal: $('#tanggal').val(),
            jam: $('#jam').val(),
            elemenmanajemen: $('#elemenmanajemen').val(),
        };

        localStorage.setItem('coachingFormData', JSON.stringify(formData));
    }

    // Fungsi untuk membersihkan data formulir coaching dari penyimpanan lokal
    function clearCoachingFormData() {
        localStorage.removeItem('coachingFormData');
    }
});

$("#reload").click(function () {
    $.ajax({
        type: "GET",
        url: "reload-captcha",
        success: function (data) {
            $(".captcha span").html(data.captcha);
        },
    });
});
