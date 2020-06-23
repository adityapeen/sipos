<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-user text-primary"></i> User Info</h1>
    <div class="col-lg-12 mb-4">
        <?php if ($this->session->flashdata('sukses')) { ?>
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <?= $this->session->flashdata('sukses'); ?>
                </div>
            </div>
        <?php
        } else if ($this->session->flashdata('gagal')) { ?>
            <div class="card bg-danger text-white shadow">
                <div class="card-body">
                    <?= $this->session->flashdata('gagal'); ?>
                </div>
            </div>
        <?php } ?>
    </div>


    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img">
                        <a href="#" class="btn btn-block btn-sm btn-primary shadow-sm mt-1" data-toggle="modal" data-target="#uploadModal"><i class="fas fa-edit fa-sm text-white-50"></i> Ganti Foto</a>
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
<!-- Modal Upload -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="vertical-align: middle;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddModalTitle">Upload Foto Profil</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body justify-content-center">
                <form method="post" id="formImage" enctype="multipart/form-data" action="<?= base_url('user/uploadpicture'); ?>">
                    <input type="hidden" name="uname" value="<?= $user['username'] ?>">
                    <input type="file" name="userfile" class="form-control mb-2" onchange="readURL(this);" />
                    <div class="row justify-content-center">
                        <img id="preview" src="<?= base_url('assets/img/profile/') . $user['image']; ?>" height="200" alt="Preview Image" />
                    </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-warning" type="button" data-dismiss="modal" data-toggle="modal" data-target="#resetModal">Reset Picture</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Reset -->
<div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Reset Foto Akun</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h7>Apakah anda yakin?<br>Foto akun ini akan direset menjadi default</h7>
                <form method="post" id="formReset" action="<?= base_url('user/resetPicture'); ?>">
                    <input type="hidden" id="idreset" name="id" value="<?= $user['username']; ?>">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Reset</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            </div>
            </form>
        </div>
    </div>
</div>

</div>
<!-- End of Main Content -->
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#preview')
                    .attr('src', e.target.result)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>