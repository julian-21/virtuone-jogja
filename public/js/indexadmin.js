$(document).ready(function () {
    function sortByMonth() {
        // Your custom logic to extract and sort data by month
        // This is just a placeholder, replace it with your actual logic
        // For example, you can sort the data by extracting the month from the date column (index 2)
        $("#example1").DataTable().order([2, 'asc']).draw();
    }

    var dataTable = $("#example1").DataTable({
        columnDefs: [
            { type: "date-eu", targets: [2, 3] }, // Assuming the third and fourth columns are date columns
        ],
    });

    $("#sortByMonthBtn").on("click", function () {
        sortByMonth();
    });
});
