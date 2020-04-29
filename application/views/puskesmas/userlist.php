<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">User Management</h1>
    <div class="col-lg-12 mb-4">
        <?php if ($this->session->flashdata('message')) {
        ?>
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>
                </div>
            </div>
        <?php
        } ?>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar User</h6>
                    <a href="<?= base_url('puskesmas/adduser'); ?>" class="btn btn-primary btn-sm text-white-70 small"><b>Tambah User</b></a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive2">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row md-12">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable" id="userTable" cellspacing="0" role="grid" aria-describedby="dataTable_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Nama</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Username</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Role</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Unit Kerja</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Desa</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Status</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($userlist as $p) { ?>
                                                <tr role="row">
                                                    <td><?= $p->nama ?></td>
                                                    <td><?= $p->username ?></td>
                                                    <td><?= $p->role ?></td>
                                                    <td><?= $p->unitkerja ?></td>
                                                    <td><?= $p->desa ?></td>
                                                    <td><?php if ($p->aktif == 1) { ?>
                                                            <div class="badge badge-success badge-pill">Aktif</div>
                                                        <?php } else { ?>
                                                            <div class="badge badge-warning badge-pill">Nonaktif</div>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-circle btn-sm" data-id="<?= $p->username ?>" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-danger btn-circle btn-sm" data-id="<?= $p->id ?>" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></a>
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
    </div>

    <!-- Modal Tambah User-->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true" style="vertical-align: middle;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Akun</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?= base_url('auth/updateuser') ?>">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="nama" placeholder="Nama Lengkap" name="nama" value="" readonly>
                            <input type="hidden" name="id" id="id" value="">
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control form-control-user" id="username" placeholder="Username" name="username" value="" required>
                        </div>
                        <label> Ubah Password </label>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" id="password" name="password1" placeholder="Kosongi jika tidak diubah">
                            </div>
                            <div class="col-sm-6">
                                <button class="btn btn-info" type="button" data-dismiss="modal" data-toggle="modal" data-target="#resetModal">Reset Password</button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label> Role </label>
                                <select name="role" id="role" class="form-control">
                                    <option disabled>Pilih Role</option>
                                    <?php foreach ($role as $r) { ?>
                                        <option value="<?= $r->id; ?>"><?= $r->role; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label> Status User</label>
                                <select name="aktif" id="aktif" class="form-control">
                                    <option value="0">Nonaktif</option>
                                    <option value="1">Aktif</option>
                                </select>
                            </div>
                        </div>

                        <label> Unit Kerja </label>
                        <select name="idposyandu" id="unitkerja" class="form-control" readonly>
                        </select>
                        <input type="hidden" name="tipe" value="puskesmas">

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Reset -->
    <div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-hidden="true" style="vertical-align: middle;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Reset Password Akun</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h7>Apakah anda yakin?<br>Password akun ini akan direset menjadi 1234</h7>
                    <form method="post" id="formReset" action="<?= base_url('auth/resetPassword'); ?>">
                        <input type="hidden" id="tipereset" name="tipe" value="puskesmas">
                        <input type="hidden" id="idreset" name="id" value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Reset</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Hapus -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true" style="vertical-align: middle;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalTitle">Hapus Akun User</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h7>Apakah anda yakin?<br>Data yang dihapus tidak dapat dikembalikan</h7>
                    <form method="post" id="formDelete" action="<?= base_url('auth/deleteUser'); ?>">
                        <input type="hidden" id="tipedelete" name="tipe" value="puskesmas">
                        <input type="hidden" id="iddelete" name="iddelete" value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Hapus</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                </div>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
</div>
<script>
    $('#editModal').on('show.bs.modal', function(event) {
        var id = $(event.relatedTarget).data('id');
        $('#unitkerja').empty();

        $.getJSON("<?= base_url('api/getdatauser'); ?>", {
                username: id,
            })
            .done(function(data) {
                $.each(data, function(idx, e) {
                    $('#nama').val(e.nama);
                    $('#id').val(e.id);
                    $('#username').val(e.username);
                    $('#role').prop('selectedIndex', e.role_id - 1);
                    $('#aktif').prop('selectedIndex', e.aktif);
                    $('#unitkerja').append($('<option></option>').text(e.unitkerja));
                });
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
    $('#resetModal').on('show.bs.modal', function(event) {
        $('#editModal').fadeOut();
        var id = $('#id').val();
        $('#idreset').val(id);
    });
    $('#deleteModal').on('show.bs.modal', function(event) {
        var id = $(event.relatedTarget).data('id');
        $('#iddelete').val(id);
    });
</script>