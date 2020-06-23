<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-user-cog text-primary"></i> Role Management</h1>
    <div class="col-lg-12 mb-4">
        <?php if ($this->session->flashdata('sukses')) {
        ?>
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <?= $this->session->flashdata('sukses'); ?>
                </div>
            </div>
        <?php
        } else if ($this->session->flashdata('gagal')) { ?>
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <?= $this->session->flashdata('sukses'); ?>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="row ">
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Menu</h6>
                    <a href="#" class="btn btn-primary btn-sm text-white-70 small" data-tipe="add" data-toggle="modal" data-target="#MenuModal"><b>Tambah Menu</b></a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row md-12">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable" id="menuTable" cellspacing="0" role="grid" aria-describedby="dataTable_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Menu</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($menu as $p) { ?>
                                                <tr role="row">
                                                    <td><?= $p->menu; ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-circle btn-sm" data-id="<?= $p->id ?>" data-tipe="edit" data-toggle="modal" data-target="#MenuModal"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-danger btn-circle btn-sm" data-id="<?= $p->id ?>" data-tipe="menu" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></a>
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

        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar User Role</h6>
                    <!-- <a href="#" class="btn btn-primary btn-sm text-white-70 small" data-toggle="modal" data-tipe="addrole" data-target="#MenuModal"><b>Tambah Role</b></a> -->
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row md-12">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable" id="puskesmasTable" cellspacing="0" role="grid" aria-describedby="dataTable_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Role</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($role as $p) { ?>
                                                <tr role="row">
                                                    <td><?= $p->role ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-circle btn-sm" data-id="<?= $p->id ?>" data-tipe="editrole" data-toggle="modal" data-target="#MenuModal"><i class="fas fa-edit"></i></a>
                                                        <!-- <a href="#" class="btn btn-danger btn-circle btn-sm" data-id="<?= $p->id ?>" data-tipe="role" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></a> -->
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
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar User Sub Menu</h6>
                    <a href="#" class="btn btn-primary btn-sm text-white-70 small" data-toggle="modal" data-tipe="add" data-target="#SubMenuModal"><b>Tambah User Sub Menu</b></a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive2">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row md-12">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable" id="puskesmasTable" cellspacing="0" role="grid" aria-describedby="dataTable_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Menu</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Judul</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">URL</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Icon</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Aktif</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($submenu as $p) { ?>
                                                <tr role="row">
                                                    <td><?= $p->menu ?></td>
                                                    <td><?= $p->title ?></td>
                                                    <td><?= $p->url ?></td>
                                                    <td><?= $p->icon ?></td>
                                                    <td class="text-center"><?php if ($p->is_active == 1) echo '<div class="badge badge-success badge-pill">Aktif</div>';
                                                                            else echo '<div class="badge badge-warning badge-pill">Nonaktif</div>'; ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-circle btn-sm" data-id="<?= $p->id ?>" data-tipe="edit" data-toggle="modal" data-target="#SubMenuModal"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-danger btn-circle btn-sm" data-id="<?= $p->id ?>" data-tipe="submenu" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></a>
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

    <div class="row d-flex justify-content-center">
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar User Akses</h6>
                    <a href="#" class="btn btn-primary btn-sm text-white-70 small" data-toggle="modal" data-target="#AccessMenuModal"><b>Tambah User Akses</b></a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row md-12">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable" id="puskesmasTable" cellspacing="0" role="grid" aria-describedby="dataTable_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Role</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Akses</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($accessmenu as $p) { ?>
                                                <tr role="row">
                                                    <td><?= $p->role ?></td>
                                                    <td><?= $p->menu ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-danger btn-circle btn-sm" data-id="<?= $p->id ?>" data-tipe="accessmenu" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></a>
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



</div>
<!-- /.container-fluid -->

<!-- Modal -->
<div class="modal fade" id="MenuModal" tabindex="-1" role="dialog" aria-hidden="true" style="vertical-align: middle;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddModalTitle"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="formAdd" action="">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nmmenu" name="nmmenu" placeholder="" value="" required>
                    </div>
                    <input type="hidden" id="addtype" name="tipe">
                    <input type="hidden" id="idedit" name="id">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="SubMenuModal" tabindex="-1" role="dialog" aria-hidden="true" style="vertical-align: middle;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="SubMenuTitle"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="formAddSub" action="">
                    <div class="form-group">
                        <select class="form-control" id="selMenu" name="menu">
                        </select>
                    </div>
                    <div class="form-group">
                        <input type=text class="form-control" id="judul" name="judul" placeholder="Judul Sub Menu" required>
                    </div>
                    <div class="form-group">
                        <input type=text class="form-control" id="url" name="url" placeholder="URL" required>
                    </div>
                    <div class="form-group">
                        <input type=text class="form-control" id="icon" name="icon" placeholder="Icon" value="fas fa-fw fa-" required>
                    </div>
                    <div class="form-group">
                        <label>Aktif</label>
                        <select class="form-control" id="is_active" name="is_active">
                            <option value=1>Ya</option>
                            <option value=0>Tidak</option>
                        </select>
                    </div>
                    <input type="hidden" id="addtype2" name="tipe">
                    <input type="hidden" id="idedit2" name="id">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="AccessMenuModal" tabindex="-1" role="dialog" aria-hidden="true" style="vertical-align: middle;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah User Akses</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="formAccMenu" action="<?= base_url('/admin/accessmenu') ?>">
                    <div class="form-group">
                        <select class="form-control" id="selRole" name="role">
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Dapat Mengakses</label>
                        <select class="form-control" id="selMenu2" name="menu">
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true" style="vertical-align: middle;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalTitle"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h7>Apakah anda yakin?<br>Data yang dihapus tidak dapat dikembalikan</h7>
                <form method="post" id="formDelete" action="<?= base_url('admin/deleterole'); ?>">
                    <input type="hidden" id="tipedelete" name="tipe" value="">
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
<script>
    $('#MenuModal').on('show.bs.modal', function(event) {
        var tipe = $(event.relatedTarget).data('tipe');
        var id = $(event.relatedTarget).data('id');
        var act = '<?= base_url('/admin/menu') ?>';
        var title = 'Tambah ';
        if (tipe == 'add') {
            title += 'Menu';
        } else if (tipe == 'addrole') {
            title += 'Role';
        } else if (tipe == 'edit') {
            title = 'Edit Menu';
            $.getJSON("<?= base_url('api/getmenuid'); ?>", {
                    id: id,
                })
                .done(function(data) {
                    $.each(data, function(key, val) {
                        $('#nmmenu').val(val.menu);
                        $('#idedit').val(val.id);
                    })
                });
        } else if (tipe == 'editrole') {
            title = 'Edit Role';
            $.getJSON("<?= base_url('api/getroleid'); ?>", {
                    id: id,
                })
                .done(function(data) {
                    $.each(data, function(key, val) {
                        $('#nmmenu').val(val.role);
                        $('#idedit').val(val.id);
                    })
                });
        }
        $('#formAdd').attr('action', act);
        $('#AddModalTitle').text(title);
        $('#addtype').val(tipe);
    });

    $('#SubMenuModal').on('show.bs.modal', function(event) {
        var tipe = $(event.relatedTarget).data('tipe');
        var title = "";
        var act = "<?= base_url('/admin/submenu') ?>";
        let dropdown = $('#selMenu');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>Pilih Menu</option>');
        dropdown.prop('selectedIndex', 0);
        const url = '<?= base_url('api/getMenu'); ?>';
        $.getJSON(url, function(data) {
            $.each(data, function(key, val) {
                dropdown.append($('<option></option>').attr('value', val.id).text(val.menu));
            })
        });
        if (tipe == "add") {
            title = "Tambah Sub Menu";
        } else if (tipe == "edit") {
            title = "Edit Sub Menu";
            var id = $(event.relatedTarget).data('id');
            $.getJSON("<?= base_url('api/getsubmenuid'); ?>", {
                    id: id,
                })
                .done(function(data) {
                    $.each(data, function(key, val) {
                        $('#selMenu').prop('selectedIndex', val.menu_id);
                        $('#judul').val(val.title);
                        $('#url').val(val.url);
                        $('#icon').val(val.icon);
                        if (val.is_active == 1) $('#is_active').prop('selectedIndex', 0);
                        else $('#is_active').prop('selectedIndex', 1);
                        $('#idedit2').val(val.id);
                    })
                });
        }
        $('#SubMenuTitle').text(title);
        $('#formAddSub').attr('action', act);
        $('#addtype2').val(tipe);
    });
    $('#AccessMenuModal').on('show.bs.modal', function(event) {
        let dropdown = $('#selMenu2');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>Pilih Menu</option>');
        dropdown.prop('selectedIndex', 0);
        let url = '<?= base_url('api/getMenu'); ?>';
        $.getJSON(url, function(data) {
            $.each(data, function(key, val) {
                dropdown.append($('<option></option>').attr('value', val.id).text(val.menu));
            })
        });
        let dropdown2 = $('#selRole');
        dropdown2.empty();
        dropdown2.append('<option selected="true" disabled>Pilih Role</option>');
        dropdown2.prop('selectedIndex', 0);
        url = '<?= base_url('api/getRole'); ?>';
        $.getJSON(url, function(data) {
            $.each(data, function(key, val) {
                dropdown2.append($('<option></option>').attr('value', val.id).text(val.role));
            })
        });
    });
    $('#deleteModal').on('show.bs.modal', function(event) {
        var tipe = $(event.relatedTarget).data('tipe');
        var id = $(event.relatedTarget).data('id');
        var title = 'Hapus ';
        if (tipe == 'menu') title += 'Menu';
        else if (tipe == 'role') title += 'Role';
        else if (tipe == 'submenu') title += 'Sub Menu';
        else if (tipe == 'accessmenu') title += 'Access Menu';
        $('#deleteModalTitle').text(title);
        $('#tipedelete').val(tipe);
        $('#iddelete').val(id);
    });
</script>