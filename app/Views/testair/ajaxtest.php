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
                    
                    
                        <select id="filter">
                            <option value="all">All Data</option>
                            <option value="1">Active Data</option>
                            <option value="0">Inactive Data</option>
                        </select>

                        <table id="data-table">
                            <!-- table headers and data will be populated dynamically -->
                        </table>

                        <script>
                        $(document).ready(function() {
                            // initialize the table with all data
                            getData('all');

                            // handle dropdown change event
                            $('#filter').on('change', function() {
                                // get the selected filter value
                                var filter = $(this).val();

                                // call the getData function with the selected filter value
                                getData(filter);
                            });
                        });

                        function getData(filter) {
                            // make AJAX request to get data based on selected filter
                            $.ajax({
                                url: '<?= base_url() ?>ajax',
                                type: 'POST',
                                data: {
                                    filter: filter
                                },
                                success: function(response) {
                                    // clear previous table data
                                    $('#data-table').empty();

                                    // parse the JSON response into an array of objects
                                    var data = JSON.parse(response);

                                    // loop through the data and add each row to the table
                                    for (var i = 0; i < data.length; i++) {
                                        var row = '<tr>' +
                                            '<td>' + data[i].id + '</td>' +
                                            '<td>' + data[i].name + '</td>' +
                                            '<td>' + data[i].status + '</td>' +
                                            '</tr>';

                                        $('#data-table').append(row);
                                    }
                                }
                            });
                        }
                        </script>

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




</html>
<?= $this->endSection() ?>