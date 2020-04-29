<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tambah User Sistem</h1>
    <?= $this->session->flashdata('message'); ?>

    <div class="card striped-tabled-with-hover shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Penduduk <?= $posyandu['dusun']; ?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable" cellspacing="0" role="grid" aria-describedby="dataTable_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Nama</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending">JK</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">Tanggal Lahir</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">Nama</th>
                                        <th rowspan="1" colspan="1">JK</th>
                                        <th rowspan="1" colspan="1">Tanggal Lahir</th>
                                        <th rowspan="1" colspan="1">Aksi</th>

                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($penduduk as $p) { ?>
                                        <tr role="row">
                                            <td><?= $p->nama ?></td>
                                            <td><?= $p->kelamin ?></td>
                                            <td><?= $p->tgllahir ?></td>
                                            <td>
                                                <?php if ($p->iduser != "") { ?>
                                                    <a href="#" data-ukuran="" data-title="Edit" data-toggle="modal" data-target="#editUserModal" class="btn btn-primary btn-icon-split btn-sm">
                                                        <span class="icon text-white-50"><i class="fas fw fa-edit"></i></span>
                                                        <span class="text">Edit</span></a>
                                                    <a href="#" data-ukuran="" data-title="Reset" data-toggle="modal" data-target="#ResetModal" class="btn btn-warning btn-icon-split btn-sm">
                                                        <span class="icon text-white-50"><i class="fas fw fa-edit"></i></span>
                                                        <span class="text">Reset</span></a>

                                                <?php } else { ?>
                                                    <a href="#" class="btn btn-success btn-icon-split btn-sm" data-nik="<?= $p->nik; ?>" data-title="Input" data-toggle="modal" data-target="#addUserModal">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fw fa-edit"></i>
                                                        </span>
                                                        <span class="text">Input</span>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>

<!-- Modal Tambah User-->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="vertical-align: middle;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambahkan Akun Baru</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url('auth/register') ?>">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="nama" placeholder="Nama Lengkap" name="nama" value="" readonly>
                        <input type="hidden" name="nik" id="nik" value="">
                        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="username" placeholder="Username" name="username" value="" required>
                        <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password" required>
                            <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="col-sm-6">
                            <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Ulangi Password" required>
                            <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label> Role </label>
                        <select name="role" id="role" class="form-control">
                            <?php foreach ($role as $r) { ?>
                                <option value="<?= $r->id; ?>"><?= $r->role; ?> </option>
                            <?php } ?>
                        </select>
                        <input type="hidden" id="unitkerja" name="idposyandu" value="<?= $user['idposyandu']; ?>">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Tambah User</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus Penduduk-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="vertical-align: middle;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Penduduk</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Apakah anda yakin? <br>Data yang telah dihapus tidak dapat dikembalikan</div>
            <div class="modal-footer">
                <form id="deleteForm" action="" method="post" style="margin-block-end: 0em;">
                    <input type="hidden" name="idhapus" id="idhapus" value="">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger" id="linkDel">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    $('#addUserModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var title = button.data('title');
        $('.modal-title').html(title + " Data User");

        var nik = button.data('nik');
        $.get("<?= base_url('api/getdatapenduduk'); ?>", {
                nik: nik,
            })
            .done(function(data) {
                var e = JSON.parse(data);
                $('#idpengukuran').val('');
                $('#nama').val(e[0].nama);
                $('#nik').val(e[0].nik);
            });

    });

    $('#username').focusout(function() {
        var username = $('#username').val();
        if (username != '') {
            $.get("<?= base_url('api/getusername'); ?>", {
                    username: username,
                })
                .done(function(data) {
                    var e = JSON.parse(data);
                    if (e.terpakai == true) {
                        alert("Username sudah digunakan!");
                    }
                });
        }
    });


    $('#deleteModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var act = "<?= base_url('user/penduduk/delete'); ?>";
        $('#idhapus').attr("value", id);
        $('#deleteForm').attr("action", act);
    })
</script>