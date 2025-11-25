<?= $this->extend("templates/adminlte/admindash"); ?>
<?= $this->section('content'); ?>

<section class=" container-fluid">
    <div class="row pt-2">
        <div class=" col-12">
            <div class="card ">
                <div class="card-header">
                    Header
                </div>
                <div class="card-body">
                    <table class="table table-dark">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Lanes</th>
                                <th>Class</th>
                                <th>Surface</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $x=1; foreach ($roads as $key) : ?>
                                <tr>
                                    <td><?= $x++ ?></td>
                                    <td><?= $key['roadcode'] ?></td>
                                    <td><?= $key['name'] ?></td>
                                    <td><?= $key['description'] ?></td>
                                    <td><?= $key['num_lanes'] ?></td>
                                    <td><?= $key['class'] ?></td>
                                    <td><?= $key['surface_type'] ?></td>
                                    <td>
                                <a href="<?= base_url() ?>open_road/<?= $key['roaducode'] ?>">Open</a>        
                                </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                       
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</section>


</body>


<?= $this->endSection() ?>