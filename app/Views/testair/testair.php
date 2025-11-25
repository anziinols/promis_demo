<?= $this->extend("templates/testairtemp"); ?>
<?= $this->section('content'); ?>

<body>
    <div class="container-fluid p-2">
        <div class="row d-flex justify-content-center p-lg-5">
            <div class="col-md-12 ">

                <div class="card shadow-lg rounded-top-5 ">
                    <div class="card-header text-center">
                        TestPlanet
                    </div>
                    <div class="card-body">

                        <form id="myForm">
                            <input type="text" name="name" id="name" placeholder="Name">
                            <button type="submit">Submit</button>
                        </form>


                        <br>
                        <div id="result"></div>
                        <br>
                        <table class="table table-bordered" id="table-container">
                            <thead>
                                <tr>
                                    <th data-value="1">Column 1</th>
                                    <th data-value="2">Column 2</th>
                                    <th data-value="3">Column 3</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="data-col1"></td>
                                    <td id="data-col2"></td>
                                    <td id="data-col3"></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="card-footer text-center">
                        <?= base_url() . "ajax" ?>
                        <small>Org.Calendar Administrators Login</small>
                    </div>
                </div>

            </div>

        </div>
    </div>

</body>

<script>
/* $.ajax({
    url: '<?= base_url() ?>ajax',
    type: 'GET',
    dataType: 'json',
    headers: {
        'X-Requested-With': 'XMLHttpRequest'
    },

    success: function(data) {
        //do something with the response
        //json: JSON.stringify(data);
        //console.log("Res from PHP: ".json);
        console.log(data);
           for (var i = 0; i < data.length; i++) {
             var item = data[i];
             console.log(item.id);
             console.log(item.title);
         }  
    },
    error: function(xhr, textStatus, errorThrown) {
        // Handle the error
    }
}); */
</script>

<?php
//$json = $_POST['json'];
//$data = json_decode($_POST['json'], true);

//print_r($data);
// Do something with the data
//var_dump($data);
?>

<script>
$(document).ready(function() {
    $('#myForm').submit(function(event) {
        // Prevent default form submission behavior
        event.preventDefault();

        // Serialize form data
        var formData = $(this).serialize();

        // Send AJAX request to controller
        $.post('<?= base_url() ?>ajax', formData, function(response) {
            //getData();
            display(response);
            // Handle response data
            //$('#name').empty();
            // $('#table-container').empty();
            console.log(response);
        });
    });
});
</script>
<script>
function display(data) {
    // Create a table element
    var table = $('<table>').addClass('table');

    // Create a header row and append it to the table
    var headerRow = $('<tr>');
    headerRow.append($('<th>').text('ID'));
    headerRow.append($('<th>').text('Title'));
    headerRow.append($('<th>').text('Start Date'));
    headerRow.append($('<th>').text('All Day'));
    table.append(headerRow);

    // Loop through the data and create a row for each item
    for (var i = 0; i < data.length; i++) {
        var item = data[i];
        var row = $('<tr>');
        row.append($('<td>').text(item.id));
        row.append($('<td>').text(item.title));
        row.append($('<td>').text(item.start));
        row.append($('<td>').text(item.allDay));
        table.append(row);
    }

    // Append the table to the page
    $('#table-container').html(table);
},
error: function(xhr, textStatus, errorThrown) {
    // Handle the error
}
}
</script>


<script>
function getData() {
    $.ajax({
        url: '<?= base_url() ?>ajax',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Create a table element
            var table = $('<table>').addClass('table');

            // Create a header row and append it to the table
            var headerRow = $('<tr>');
            headerRow.append($('<th>').text('ID'));
            headerRow.append($('<th>').text('Title'));
            headerRow.append($('<th>').text('Start Date'));
            headerRow.append($('<th>').text('All Day'));
            table.append(headerRow);

            // Loop through the data and create a row for each item
            for (var i = 0; i < data.length; i++) {
                var item = data[i];
                var row = $('<tr>');
                row.append($('<td>').text(item.id));
                row.append($('<td>').text(item.title));
                row.append($('<td>').text(item.start));
                row.append($('<td>').text(item.allDay));
                table.append(row);
            }

            // Append the table to the page
            $('#table-container').html(table);
        },
        error: function(xhr, textStatus, errorThrown) {
            // Handle the error
        }
    });
}
</script>


</html>
<?= $this->endSection() ?>