document.addEventListener("DOMContentLoaded", function () {
    const selectJam = document.querySelector('select[name="jam[]"]');
    const maxSelections = 1;

    selectJam.addEventListener("change", function () {
        const selectedOptions = Array.from(selectJam.selectedOptions);
        if (selectedOptions.length > maxSelections) {
            alert("Anda hanya dapat memilih maksimal 1 jam.");
            selectedOptions.forEach((option) => {
                if (!option.selected) {
                    option.disabled = true;
                }
            });
        } else {
            selectedOptions.forEach((option) => {
                option.disabled = false;
            });
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("#formulir-konsultasi");

    form.addEventListener("submit", function (event) {
        // Check if any of the required fields are empty
        const requiredFields = [
            "nama",
            "nip",
            "jabatan",
            "unitkerja",
            "nomorhp",
            "email",
            "keluhan",
            "tanggal",
            "jam",
        ];
        let isEmpty = false;

        requiredFields.forEach((field) => {
            const input = form.querySelector(`[name="${field}"]`);
            if (input.value.trim() === "") {
                isEmpty = true;
            }
        });

        if (isEmpty) {
            event.preventDefault(); // Prevent form submission
            alert("Please fill out all required fields.");
        }
    });
});

// form-handler.js

$(document).ready(function () {
    // Inisialisasi plugin Select2
    $(".select2").select2();

    // Panggil fungsi restoreFormData saat halaman dimuat
    restoreFormData();

    // Simpan data formulir setiap kali ada perubahan pada formulir
    $("form").on("input", function () {
        saveFormData();
    });

    // Jika tombol Kembali ke Halaman Utama diklik, bersihkan data formulir
    $(".btn-primary").on("click", function () {
        clearFormData();
    });
});

// Fungsi untuk menyimpan data formulir ke dalam localStorage
function saveFormData() {
    const formData = {
        nama: $("#nama").val(),
        nip: $("#nip").val(),
        jabatan: $("#jabatan").val(),
        unitkerja: $("#unitkerja").val(),
        nomorhp: $("#nomorhp").val(),
        email: $("#email").val(),
        keluhan: $("#keluhan").val(),
        tanggal: $("#tanggal").val(),
        jam: getSelectedOptions("jam"), // Menambahkan opsi terpilih dari Select2
    };

    localStorage.setItem("formData", JSON.stringify(formData));
}

// Fungsi untuk mendapatkan opsi terpilih dari Select2
function getSelectedOptions(elementId) {
    const selectedOptions = [];
    const selectedElements = $("#" + elementId).val();
    return selectedElements ? selectedElements : [];
}

// Fungsi untuk mengembalikan data formulir dari localStorage ke dalam formulir
function restoreFormData() {
    const storedFormData = localStorage.getItem("formData");
    if (storedFormData) {
        const formData = JSON.parse(storedFormData);

        document.getElementById("nama").value = formData.nama;
        document.getElementById("nip").value = formData.nip;
        document.getElementById("jabatan").value = formData.jabatan;
        document.getElementById("nomorhp").value = formData.nomorhp;
        document.getElementById("email").value = formData.email;
        document.getElementById("keluhan").value = formData.keluhan;
        document.getElementById("tanggal").value = formData.tanggal;

        // Setel opsi terpilih pada Select2
        setSelect2Options("unitkerja", formData.unitkerja);
        setSelect2Options("jam", formData.jam);
    }
}

// Fungsi untuk menetapkan opsi terpilih pada Select2
function setSelect2Options(elementId, selectedOptions) {
    const select2Element = $("#" + elementId);
    select2Element.val(selectedOptions).trigger("change");
}

// Fungsi untuk membersihkan data formulir dari penyimpanan lokal
function clearFormData() {
    localStorage.removeItem("formData");
}

$("#reload").click(function () {
    $.ajax({
        type: "GET",
        url: "reload-captcha",
        success: function (data) {
            $(".captcha span").html(data.captcha);
        },
    });
});
