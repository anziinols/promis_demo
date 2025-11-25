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
<input type="text" class=" form-control" id="maths">
                        <h1>Dropdown Example</h1>
                        <form>
                            <label for="category">Countries:</label>
                            <select name="country" id="country" class=" form-control col-md-4 ">
                                <?php foreach ($country as $cy) : ?>
                                    <option value="<?= $cy['id'] ?>"><?= $cy['name'] ?></option>
                                <?php endforeach; ?>
                            </select>

                            <br><br>
                            <label for="subcategory">Province:</label>
                            <select name="province" id="province" class=" form-control col-md-4 ">

                            </select>

                            <br><br>
                            <label for="subcategory">District:</label>
                            <select name="district" id="district" class=" form-control col-md-4 ">

                            </select>
                        </form>

                        <script>
                            $(document).ready(function() {
                                $('#country').change(function() {
                                    var country_id = $(this).val();

                                    $.ajax({
                                        url: '<?= base_url() ?>ajax',
                                        type: 'post',
                                        data: {
                                            country_id: country_id
                                        },
                                        dataType: 'json',
                                        success: function(response) {
                                            var len = response.province.length;
                                           //console.log(response.math);
                                            
                                           $('#maths').val(response.math);

                                            $("#province").empty();
                                            //$("#subcategory").append("<option value=''>Select a subcategory</option>");

                                            for (var i = 0; i < len; i++) {
                                                var id = response.province[i]['id'];
                                                var name = response.province[i]['name'];
                                                //var code = response.subcategories[i]['code'];

                                                $("#province").append("<option value='" + id + "'>" + name + "</option>");

                                            }
                                        }
                                    });
                                });
                            });
                        </script>


                        <script>
                            $(document).ready(function() {
                                $('#province').change(function() {
                                    var province_id = $(this).val();

                                    $.ajax({
                                        url: '<?= base_url() ?>ajax',
                                        type: 'post',
                                        data: {
                                            province_id: province_id
                                        },
                                        dataType: 'json',
                                        success: function(response) {
                                            var len = response.district.length;

                                            $("#district").empty();
                                            //$("#subcategory").append("<option value=''>Select a subcategory</option>");

                                            for (var i = 0; i < len; i++) {
                                                var id = response.district[i]['id'];
                                                var name = response.district[i]['name'];
                                                //var code = response.subcategories[i]['code'];

                                                $("#district").append("<option value='" + id + "'>" + name + "</option>");

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