<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-download text-primary"></i> Import Data Penduduk</h1>
    <?php if ($this->session->flashdata('sukses')) { ?>
        <div class="col-lg-12 mb-4">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <?= $this->session->flashdata('sukses'); ?>
                </div>
            </div>
        </div>
    <?php    } else if ($this->session->flashdata('gagal')) {     ?>
        <div class="col-lg-12 mb-4">
            <div class="card bg-danger text-white shadow">
                <div class="card-body pb-0">
                    <?= $this->session->flashdata('gagal'); ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <div div class="row justify-content-center mb-4">
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4" style="padding-left:0rem; padding-right:0rem;">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Download Contoh Format File Import</h6>
                    <div class="col-auto">
                        <a href="<?= base_url('assets/uploads/contoh-data-penduduk.xlsx'); ?>" class="btn btn-success">Excel</a>
                        <a href="<?= base_url('assets/uploads/contoh-data-penduduk.csv'); ?>" class="btn btn-info">CSV</a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo base_url('excel/upload') ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Upload File Excel/CSV</label>
                            <input type="file" name="userfile" class="form-control">
                        </div>
                        <div class="form-group">
                            <label> Pilih Posyandu</label>
                            <select name="idposyandu" class="form-control">
                                <?php foreach ($posyandu as $p) : ?>
                                    <option value="<?= $p->id; ?>"><?= $p->nama . ' - ' . $p->dusun; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">Upload</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4" style="padding-left:0rem; padding-right:0rem;">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Kode Kabupaten</h6>
                </div>
                <div class="card-body">
                    <div class="row-no-gutter">*Untuk mengisi tempat lahir</div>
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row md-12">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable" id="desaTable" cellspacing="0" role="grid" aria-describedby="dataTable_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width : 50px;">Kode</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Kabupaten</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($kabupaten as $p) { ?>
                                                <tr role="row">
                                                    <td class="text-center"><?= $p->idkab ?></td>
                                                    <td><?= $p->nama . ' - ' . $p->prov  ?></td>
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

</div>

<!-- Modal Edit BGM -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true" style="vertical-align: middle;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Ketentuan BGM</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="formEdit" action="">
                    <div class=" form-row mb-2">
                        <div class="col">
                            <label>Umur (bulan)</label>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="idedit" name="idedit" placeholder="Umur" value="" readonly>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="col">
                            <label>Kenaikan L (kg)</label>
                        </div>
                        <div class="col">
                            <input type="number" step=".1" class="form-control" id="kenaikan_l" name="kenaikan_l" placeholder="Kenaikan Ideal" value="" required>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="col">
                            <label>Kenaikan P (kg)</label>
                        </div>
                        <div class="col">
                            <input type="number" step=".1" class="form-control" id="kenaikan_p" name="kenaikan_p" placeholder="Kenaikan Ideal" value="" required>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="col">
                            <label>Garis Merah L (kg)</label>
                        </div>
                        <div class="col">
                            <input type="number" step=".1" class="form-control" id="bgm_l" name="garis_merah_l" placeholder="Berat Garis Merah" value="" required>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="col">
                            <label>Garis Merah P (kg)</label>
                        </div>
                        <div class="col">
                            <input type="number" step=".1" class="form-control" id="bgm_p" name="garis_merah_p" placeholder="Berat Garis Merah" value="" required>
                        </div>
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
<script>
    $('#editModal').on('show.bs.modal', function(event) {
        var id = $(event.relatedTarget).data('id');
        var act = "<?= base_url('puskesmas/updatebgm'); ?>";
        $.getJSON("<?= base_url('api/getbgm'); ?>", {
                umur: id,
            })
            .done(function(data) {
                $.each(data, function(key, val) {
                    $('#kenaikan_l').val(val.kenaikan_l);
                    $('#kenaikan_p').val(val.kenaikan_p);
                    $('#bgm_l').val(val.garis_merah_l);
                    $('#bgm_p').val(val.garis_merah_p);
                })
            });
        $('#idedit').attr("value", id);
        $('#formEdit').attr("action", act);
    })
</script>