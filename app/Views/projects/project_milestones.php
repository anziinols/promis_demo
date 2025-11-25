<?= $this->extend("templates/adminlte/admindash"); ?>
<?= $this->section('content'); ?>


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $pro['name'] ?></h1>
                <h5><?= $pro['procode'] ?></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>projects"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i>Projects </a></li>
                    <li class="breadcrumb-item active"> <?= $pro['name'] ?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class=" container-fluid">
    
    <div class="row">
        <!-- ./col -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info">
                <h5><i class="fas fa-calendar-check"></i> <?= strtoupper("Project Milestones") ?></h5> 
                </div> 
                <div class="card-body p-0">

                    <ul class="list-group">
                        <?php foreach ($phases as $ph) : ?>
                            <li class="list-group-item bg-dark">
                                <div class=" float-left">
                                    <a class=" text-light" href="<?= base_url() ?>open_prophases/<?= $ph['ucode'] ?>">
                                        <strong><?= $ph['phases'] ?></strong>
                                    </a>
                                </div>
                                
                            </li>
                            <li class="list-group-item p-0">

                                <ul class="list-group">
                                    <?php foreach($milestones as $ms):
                                        if($ms['phase_id'] == $ph['id']){
                                            ?>
                                            <li class="list-group-item "><?= $ms['milestones'] ?></li>
                                            <?php
                                        }
                                        ?>
                                    
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                </div>
                <div class="card-footer text-muted">
                    Footer
                </div>
            </div>
        </div>
    </div>
</section>


</body>

<script>
    $(document).ready(function() {
        $('#province').show(function() {
            var province_code = $(this).val();

            $.ajax({
                url: '<?= base_url() ?>getaddress',
                type: 'post',
                data: {
                    province_code: province_code
                },
                dataType: 'json',
                success: function(response) {
                    var len = response.district.length;

                    $("#district").empty();
                    $("#district").append("<option value='<?= $get_district['districtcode'] ?>'><?= $get_district['name'] ?></option>");

                    for (var i = 0; i < len; i++) {
                        var code = response.district[i]['districtcode'];
                        var name = response.district[i]['name'];
                        //var code = response.subcategories[i]['code'];

                        $("#district").append("<option value='" + code + "'>" + name +
                            "</option>");

                    }
                }
            });
        });
    });
</script>



<?= $this->endSection() ?>