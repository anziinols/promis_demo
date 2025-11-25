<?= $this->extend("templates/dakoiitemp"); ?>
<?= $this->section('content'); ?>

<body>
    <div class="container-fluid p-2">
        <div class="row d-flex justify-content-center p-lg-5">
            <div class=" col-md-4 ">

                <div class="card shadow-lg rounded-top-5 ">
                    <div class="card-header text-center">
                        Dakoii Admin Login
                    </div>
                    <div class="card-body"> 
                        <?php if (session()->has('error')) : ?>
                            <div class="alert alert-danger">
                              <i class="fas fa-exclamation-triangle    "></i> <?= session('error') ?>
                            </div>
                        <?php endif; ?>
                        <?= form_open('dlogin') ?>
                        <div class="form-group">

                            <input type="text" class="form-control" required name="username" placeholder="Username">
                        </div>
                        <div class="form-group">

                            <input type="password" class="form-control" required placeholder="Password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
                        <?= form_close() ?>
                    </div>
                    <div class="card-footer text-center">
                        <small>Dakoii Administrators Login</small>
                    </div>
                </div>

            </div>

        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>



</html>
<?= $this->endSection() ?>