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

                        <h1>Dropdown Example</h1>
                        <form>
                            <label for="category">Num Lanes:</label>
                            <select name="country" id="country" class=" form-control col-md-4 ">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="4">4</option>
                                <option value="6">6</option>
                                <option value="8">8</option>
                            </select>

                            <br><br>
                            <label for="subcategory">Subcategory:</label>
                            <select name="subcategory" id="subcategory" class=" form-control col-md-4 ">
                                
                            </select>
                        </form>

                        <script>
                            $(document).ready(function() {
                                $('#category').change(function() {
                                    var country_id = $(this).val();

                                    $.ajax({
                                        url: '<?= base_url() ?>ajax',
                                        type: 'post',
                                        data: {
                                            country_id: country_id
                                        },
                                        dataType: 'json',
                                        success: function(response) {
                                            var len = response.subcategories.length;

                                            $("#subcategory").empty();
                                            //$("#subcategory").append("<option value=''>Select a subcategory</option>");

                                            for (var i = 0; i < len; i++) {
                                                var id = response.subcategories[i]['id'];
                                                var name = response.subcategories[i]['name'];
                                                var code = response.subcategories[i]['roadcode'];

                                                $("#subcategory").append("<option value='" + id + "'>" + code  + name + "</option>");

                                            }
                                        }
                                    });
                                });
                            });
                        </script>
                        
                        <script>
                            $(document).ready(function() {
                                $('#category').change(function() {
                                    var category_id = $(this).val();

                                    $.ajax({
                                        url: '<?= base_url() ?>ajax',
                                        type: 'post',
                                        data: {
                                            category_id: category_id
                                        },
                                        dataType: 'json',
                                        success: function(response) {
                                            var len = response.subcategories.length;

                                            $("#subcategory").empty();
                                            //$("#subcategory").append("<option value=''>Select a subcategory</option>");

                                            for (var i = 0; i < len; i++) {
                                                var id = response.subcategories[i]['id'];
                                                var name = response.subcategories[i]['name'];
                                                var code = response.subcategories[i]['roadcode'];

                                                $("#subcategory").append("<option value='" + id + "'>" + code  + name + "</option>");

                                            }
                                        }
                                    });
                                });
                            });
                        </script>

                    </div>
                    <div class="card-footer text-center">
                        <?= base_url() . "ajax" ?>

                    </div>
                </div>

            </div>

        </div>
    </div>

</body>




</html>
<?= $this->endSection() ?>