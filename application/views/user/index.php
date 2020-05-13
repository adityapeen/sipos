<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-user text-primary"></i> User Info</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title text-primary font-weight-bold"><?= $user['nama'] . '<br> username - ' . $user['username']; ?></h5>
                            <p class="card-text">Role - <?= $user['role'];  ?>
                                <br>Posyandu - <?= $user['posyandu'];  ?></p>
                            <p class="card-text"><small class="text-muted">Didaftarkan pada <?= date('d F Y', $user['date_created']); ?></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->