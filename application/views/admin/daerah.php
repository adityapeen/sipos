<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-globe-asia text-primary"></i> Data daerah</h1>
    <div class="col-lg-12 mb-4">
        <?php if ($this->session->flashdata('sukses')) {
        ?>
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <?= $this->session->flashdata('sukses'); ?>
                </div>
            </div>
        <?php
        } ?>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Desa</h6>
                    <a href="#" class="btn btn-primary btn-sm text-white-70 small" data-toggle="modal" data-tipe="des" data-target="#addDaerahModal"><b>Tambah Desa</b></a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row md-12">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable" id="desaTable" cellspacing="0" role="grid" aria-describedby="dataTable_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Nama</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Kecamatan</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($desa as $p) { ?>
                                                <tr role="row">
                                                    <td><?= $p->nama ?></td>
                                                    <td><?= $p->kec ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-circle btn-sm" data-id="<?= $p->iddesa ?>" data-tipe="des" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-danger btn-circle btn-sm" data-id="<?= $p->iddesa ?>" data-tipe="des" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></a>
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
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Kecamatan</h6>
                    <a href="#" class="btn btn-primary btn-sm text-white-70 small" data-toggle="modal" data-tipe="kec" data-target="#addDaerahModal"><b>Tambah Kecamatan</b></a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row md-12">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable" id="kecamatanTable" cellspacing="0" role="grid" aria-describedby="dataTable_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Nama</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Kabupaten</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($kecamatan as $p) { ?>
                                                <tr role="row">
                                                    <td><?= $p->nama ?></td>
                                                    <td><?= $p->kab ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-circle btn-sm" data-id="<?= $p->idkec ?>" data-tipe="kec" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-danger btn-circle btn-sm" data-id="<?= $p->idkec ?>" data-tipe="kec" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></a>
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
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Kabupaten</h6>
                    <a href="#" class="btn btn-primary btn-sm text-white-70 small" data-toggle="modal" data-tipe="kab" data-target="#addDaerahModal"><b>Tambah Kabupaten</b></a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row md-12">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable" id="kabupatenTable" cellspacing="0" role="grid" aria-describedby="dataTable_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Nama</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Provinsi</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($kabupaten as $p) { ?>
                                                <tr role="row">
                                                    <td><?= $p->nama ?></td>
                                                    <td><?= $p->prov ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-circle btn-sm" data-id="<?= $p->idkab ?>" data-tipe="kab" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-danger btn-circle btn-sm" data-id="<?= $p->idkab ?>" data-tipe="kab" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></a>
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
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Provinsi</h6>
                    <a href="#" class="btn btn-primary btn-sm text-white-70 small" data-toggle="modal" data-tipe="prov" data-target="#addDaerahModal"><b>Tambah Provinsi</b></a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive3">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row md-12">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable" id="provinsiTable" cellspacing="0" role="grid" aria-describedby="dataTable_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Nama</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($provinsi as $p) { ?>
                                                <tr role="row">
                                                    <td><?= $p->nama ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-circle btn-sm" data-id="<?= $p->idprov ?>" data-tipe="prov" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-danger btn-circle btn-sm" data-id="<?= $p->idprov ?>" data-tipe="prov" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></a>
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

<!-- Modal Tambah Daerah-->
<div class="modal fade" id="addDaerahModal" tabindex="-1" role="dialog" aria-hidden="true" style="vertical-align: middle;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalTitle"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="formAdd" action="">
                    <div class="form-group">
                        <select class="form-control" name="provinsi" id="provinsi"></select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="kabupaten" id="kabupaten"></select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="kecamatan" id="kecamatan"></select>
                    </div>
                    <input type="text" class="form-control" id="nmdaerah" name="nmdaerah" placeholder="" value="" required>
                    <input type="hidden" id="addType" name="tipe" value="">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Edit Daerah -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true" style="vertical-align: middle;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalTitle"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="formEdit" action="">
                    <input type="text" class="form-control" id="namadaerah" name="namadaerah" placeholder="Nama Daerah" value="" required>
                    <input type="hidden" id="tipeedit" name="tipe" value="">
                    <input type="hidden" id="idedit" name="idedit" value="">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus Daerah -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true" style="vertical-align: middle;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalTitle"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h7>Apakah anda yakin?<br>Data yang dihapus tidak dapat dikembalikan</h7>
                <form method="post" id="formDelete" action="">
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
    $('#addDaerahModal').on('show.bs.modal', function(event) {
        $('#provinsi').hide();
        $('#kabupaten').hide();
        $('#kecamatan').hide();
        var tipe = $(event.relatedTarget).data('tipe');
        var act = '<?= base_url('/admin/tambahdaerah') ?>';
        var title = "Tambah";

        if (tipe == "prov") {
            title = title + " Provinsi";
            $('#nmdaerah').attr('placeholder', 'Nama Provinsi');
        } else if (tipe == "kab") {
            title = title + " Kabupaten";
            $('#nmdaerah').attr('placeholder', 'Nama Kabupaten');
            $('#provinsi').show();
        } else if (tipe == "kec") {
            title = title + " Kecamatan";
            $('#nmdaerah').attr('placeholder', 'Nama Kecamatan');
            $('#provinsi').show();
        } else if (tipe == "des") {
            title = title + " Desa";
            $('#nmdaerah').attr('placeholder', 'Nama Desa');
            $('#provinsi').show();
        }
        $('.modal-title').html(title);
        $('#formAdd').attr("action", act);
        $('#addType').val(tipe);


        let dropdown = $('#provinsi');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>Pilih Provinsi</option>');
        dropdown.prop('selectedIndex', 0);

        const url = '<?= base_url('api/getallprov'); ?>';

        $.getJSON(url, function(data) {
            $.each(data, function(key, val) {
                dropdown.append($('<option></option>').attr('value', val.idprov).text(val.nama));
            })
        });
    });
    $('#provinsi').change(function() {
        var id = $('#provinsi').val();
        let sel = $('#kabupaten');
        if ($('#addType').val() != 'kab')
            sel.show();
        sel.empty();
        sel.append('<option selected="true" disabled>Pilih Kabupaten</option>');

        $.get("<?= base_url('api/getkab'); ?>", {
                kodeprov: id,
            })
            .done(function(data) {
                var e = JSON.parse(data);
                $.each(e, function(key, val) {
                    sel.append($('<option></option>').attr('value', val.idkab).text(val.nama));
                })
            });
    });
    $('#kabupaten').change(function() {
        var id = $('#kabupaten').val();
        let sel = $('#kecamatan');
        if ($('#addType').val() != 'kec')
            sel.show();
        sel.empty();
        sel.append('<option selected="true" disabled>Pilih Kecamatan</option>');

        $.get("<?= base_url('api/getkec'); ?>", {
                kodekab: id,
            })
            .done(function(data) {
                var e = JSON.parse(data);
                $.each(e, function(key, val) {
                    sel.append($('<option></option>').attr('value', val.idkec).text(val.nama));
                })
            });
    });
    $('#editModal').on('show.bs.modal', function(event) {
        var tipe = $(event.relatedTarget).data('tipe');
        var id = $(event.relatedTarget).data('id');
        var act = '<?= base_url('/admin/updatedaerah') ?>';
        var title = "Edit Nama";
        var url = "";
        if (tipe == 'des') {
            title += ' Desa';
            $('#namadaerah').attr("placeholder", "Nama Desa");
            url = "<?= base_url('api/getdesa'); ?>";
        } else if (tipe == 'kec') {
            title += ' Kecamatan';
            $('#namadaerah').attr("placeholder", "Nama Kecamatan");
            url = "<?= base_url('api/getkeca'); ?>";
        } else if (tipe == 'kab') {
            title += ' Kabupaten';
            $('#namadaerah').attr("placeholder", "Nama Kabupaten");
            url = "<?= base_url('api/getkabu'); ?>";
        } else if (tipe == 'prov') {
            title += ' Provinsi';
            $('#namadaerah').attr("placeholder", "Nama Provinsi");
            url = "<?= base_url('api/getprovi'); ?>";
        }
        $.get(url, {
                id: id,
            })
            .done(function(data) {
                var e = JSON.parse(data);
                $.each(e, function(key, val) {
                    $('#namadaerah').val(val.nama);
                })
            });


        $('.modal-title').html(title);
        $('#formEdit').attr("action", act);
        $('#tipeedit').val(tipe);
        $('#idedit').val(id);
    });

    $('#deleteModal').on('show.bs.modal', function(event) {
        var tipe = $(event.relatedTarget).data('tipe');
        var id = $(event.relatedTarget).data('id');
        var act = '<?= base_url('/admin/deletedaerah') ?>';
        var title = "Hapus ";
        if (tipe == 'des') title += 'Desa';
        else if (tipe == 'kec') title += 'Kecamatan';
        else if (tipe == 'kab') title += 'Kabupaten';
        else if (tipe == 'prov') title += 'Provinsi';

        $('.modal-title').html(title);
        $('#formDelete').attr("action", act);
        $('#tipedelete').val(tipe);
        $('#iddelete').val(id);
    });
</script>