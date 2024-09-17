$(document).ready(function () {
    $('#example1').DataTable({
        "order": [[3, "desc"]], // Sort by the fourth column (Tanggal Fix) in descending order
        "pageLength": 25, // Number of rows per page
    });
});