<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Posyandu</h1>
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

    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Posyandu</h6>
                    <a href="#" class="btn btn-primary btn-sm text-white-70 small" data-tipe="pos" data-toggle="modal" data-target="#addPosyanduModal"><b>Tambah Posyandu</b></a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row md-12">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable" id="posyanduTable" cellspacing="0" role="grid" aria-describedby="dataTable_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Nama</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Puskesmas</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($posyandu as $p) { ?>
                                                <tr role="row">
                                                    <td><?= $p->nama . ' dusun ' . $p->dusun; ?></td>
                                                    <td><?= $p->puskesmas ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-circle btn-sm" data-id="<?= $p->id ?>" data-tipe="pos" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-danger btn-circle btn-sm" data-id="<?= $p->id ?>" data-tipe="pos" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></a>
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
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Puskesmas</h6>
                    <a href="#" class="btn btn-primary btn-sm text-white-70 small" data-toggle="modal" data-tipe="pus" data-target="#addPosyanduModal"><b>Tambah Puskesmas</b></a>
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
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Nama</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Kabupaten</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($puskesmas as $p) { ?>
                                                <tr role="row">
                                                    <td><?= $p->nama ?></td>
                                                    <td><?= $p->kabupaten ?></td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary btn-circle btn-sm" data-id="<?= $p->id ?>" data-tipe="pus" data-toggle="modal" data-target="#editModal"><i class="fas fa-edit"></i></a>
                                                        <a href="#" class="btn btn-danger btn-circle btn-sm" data-id="<?= $p->id ?>" data-tipe="pus" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></a>
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

<!-- Modal Tambah -->
<div class="modal fade" id="addPosyanduModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="vertical-align: middle;">
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
                        <select id="selProv" name="provinsi" class="form-control" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <select id="selKab" name="kabupaten" class="form-control">
                        </select>
                    </div>
                    <div class="form-group">
                        <select id="selKec" name="kecamatan" class="form-control">
                        </select>
                    </div>
                    <div class="form-group">
                        <select id="selDes" name="desa" class="form-control">
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nmpos" name="nama" placeholder="" value="" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nmdusun" name="dusun" placeholder="Nama Dusun" value="">
                    </div>
                    <input type="hidden" id="addtype" val="">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
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
                    <input type="text" class="form-control" id="namapos" name="namapos" placeholder="" value="" required>
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
    $('#addPosyanduModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var tipe = button.data('tipe');
        var act = "";
        var title = "Tambah";
        if (tipe == "pos") {
            act = '<?= base_url('/admin/tambahposyandu') ?>';
            title = title + " Posyandu";
            $('#nmdusun').show();
            $('#nmpos').attr('placeholder', 'Nama Posyandu');
            $('#addtype').val('pos');
        } else if (tipe == "pus") {
            act = '<?= base_url('/admin/tambahpuskesmas') ?>';
            title = title + " Puskesmas";
            $('#nmdusun').hide();
            $('#nmpos').attr('placeholder', 'Nama Puskesmas');
            $('#addtype').val('pus');
        }
        $('.modal-title').html(title);
        $('#formAdd').attr("action", act);

        $('#selKab').hide();
        $('#selKec').hide();
        $('#selDes').hide();
        let dropdown = $('#selProv');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>Pilih Provinsi</option>');
        dropdown.prop('selectedIndex', 0);

        const url = '<?= base_url('api/getallprov'); ?>';

        // Populate dropdown with list of provinces
        $.getJSON(url, function(data) {
            $.each(data, function(key, val) {
                dropdown.append($('<option></option>').attr('value', val.idprov).text(val.nama));
            })
        });
    });

    $('#selProv').change(function() {
        let sel = $('#selKab');
        sel.show();
        sel.empty();
        sel.append('<option selected="true" disabled>Pilih Kabupaten</option>');
        var id = $('#selProv').val();

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
    $('#selKab').change(function() {
        let sel = $('#selKec');
        sel.show();
        sel.empty();
        sel.append('<option selected="true" disabled>Pilih Kecamatan</option>');
        var id = $('#selKab').val();

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
    $('#selKec').change(function() {
        if ($('#addtype').val() == "pos") {
            let sel = $('#selDes');
            sel.show();
            sel.empty();
            sel.append('<option selected="true" disabled>Pilih Desa</option>');
            var id = $('#selKec').val();

            $.get("<?= base_url('api/getdes'); ?>", {
                    kodekec: id,
                })
                .done(function(data) {
                    var e = JSON.parse(data);
                    $.each(e, function(key, val) {
                        sel.append($('<option></option>').attr('value', val.iddesa).text(val.nama));
                    })
                });
        }
    });

    $('#editModal').on('show.bs.modal', function(event) {
        var tipe = $(event.relatedTarget).data('tipe');
        var id = $(event.relatedTarget).data('id');
        var act = '<?= base_url('/admin/updatepos') ?>';
        var title = "Edit Nama";
        var url = "";
        if (tipe == 'pos') {
            title += ' Posyandu';
            $('#namapos').attr("placeholder", "Nama Posyandu");
            url = "<?= base_url('api/getpos'); ?>";
        } else if (tipe == 'pus') {
            title += ' Puskesmas';
            $('#namapos').attr("placeholder", "Nama Puskesmas");
            url = "<?= base_url('api/getpus'); ?>";
        }
        $.get(url, {
                id: id,
            })
            .done(function(data) {
                var e = JSON.parse(data);
                $.each(e, function(key, val) {
                    $('#namapos').val(val.nama);
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
        var act = '<?= base_url('/admin/deletepos') ?>';
        var title = "Hapus ";
        if (tipe == 'pos') title += 'Posyandu';
        else if (tipe == 'pus') title += 'Puskesmas';

        $('.modal-title').html(title);
        $('#formDelete').attr("action", act);
        $('#tipedelete').val(tipe);
        $('#iddelete').val(id);
    });
</script>