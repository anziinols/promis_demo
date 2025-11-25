<?= $this->extend('templates/adminlte/admindash') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Table to Excel</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
</head>
<body>

<!-- Your table -->
<table id="myTable" border="1">
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
            <td>Data 1-3</td>
        </tr>
        <tr>
            <td>Data 2-1</td>
            <td>Data 2-2</td>
            <td>Data 2-3</td>
        </tr>
        <!-- Add more rows as needed -->
    </tbody>
</table>

<!-- Button to trigger exporting -->
<button onclick="exportTableToExcel('myTable', 'TableData')">Export to Excel</button>

<script>
    function exportTableToExcel(tableId, filename = 'TableData') {
        const table = document.getElementById(tableId);
        const wb = XLSX.utils.table_to_book(table, { sheet: filename });
        XLSX.writeFile(wb, `${filename}.xlsx`);
    }
</script>

</body>
</html>



<?= $this->endSection(); ?>