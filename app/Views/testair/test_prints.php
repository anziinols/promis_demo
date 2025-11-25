<?= $this->extend('templates/adminlte/admindash') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Table in Landscape View</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<!-- Your Bootstrap table -->
<table id="myTable" class="table table-bordered">
    <thead>
        <tr>
            <th>Header 1</th>
            <th>Header 2</th>
            <th>Header 3</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Data 1-1</td>
            <td>Data 1-2</td>
            <td>B. Responsibilities
1. Assignment of tasks to team members
2. Regular progress evaluations

VIII. Appendices:

A. Supporting Documents
1. Licenses and permits
2. Market research data
3. Partnership agreements

IX. Conclusion:

A. Summary of the business plan
1. Reiteration of goals and objectives
2. Call to action</td>
        </tr>
        <tr>
            <td>Data 2-1</td>
            <td>Data 2-2</td>
            <td>Data 2-3</td>
        </tr>
        <!-- Add more rows as needed -->
    </tbody>
</table>

<!-- Button to trigger printing in landscape view -->
<button onclick="printmyTable('myTable', 'Printed Table', 'caption: Print this table with a footer caption.', 'landscape')">Print Table</button>

<script>
    function printmyTable(tbl_id, tbl_title, additionalStyles = '', orientation = 'portrait') {
        var table = document.getElementById(tbl_id);

        var printWindow = window.open("", "_blank");

        printWindow.document.write('<html><head><title>' + tbl_title + '</title>');
        printWindow.document.write('<h5>' + tbl_title + '</h5>');
        printWindow.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">');
        printWindow.document.write('<style>@page { size: ' + orientation + '; } td, th { border: 1px solid black; padding: 8px; word-wrap: break-word;} ' + additionalStyles + '</style></head><body>');
        printWindow.document.write('<div class="row">');
        printWindow.document.write('<div class="col-md-12">');
        printWindow.document.write('<div class="container mt-4 print-table">' + table.outerHTML + '</div>');
        printWindow.document.write('</div>');
        printWindow.document.write('</div>');
        printWindow.document.write('</body></html>');

        printWindow.focus();
        printWindow.print();
        printWindow.close();
    }
</script>

</body>
</html>



<?= $this->endSection(); ?>