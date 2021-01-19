<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800"><i class="fas fa-first-aid text-primary"></i> Daftar Posyandu</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addPosyanduModal"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Posyandu</a>
    </div>
    <div class="col-lg-12 mb-4">
        <?php if ($this->session->flashdata('sukses')) { ?>
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <?= $this->session->flashdata('sukses'); ?>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="row d-flex justify-content-centerd-flex justify-content-center">
        <?php $type = ['bg-success', 'bg-warning', 'bg-info', 'bg-primary'];
        $i = 0;
        foreach ($posyandu as $p) : ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="<?= base_url('puskesmas/posyandu/detail/') . $p->id; ?>" class="card <?= $type[$i]; ?> card-link shadow text-white h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase text-white-50 mb-1">Dusun <?= $p->dusun . ' - ' . $p->desa; ?></div>
                                <div class="h5 mb-0 font-weight-bold"><?= $p->nama; ?></div>
                                <div class="text-s font-weight-bold"><?= $p->balita; ?> Balita</div>
                                <div class="text-s font-weight-bold"><?= $p->kegiatan; ?> Kegiatan</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fw fa-stethoscope fa-2x text-white-50"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php $i++;
            if ($i == 4) $i = 0;
        endforeach ?>
    </div>


</div>
<!-- /.container-fluid -->

<!-- Modal Tambah -->
<div class="modal fade" id="addPosyanduModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="vertical-align: middle;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddModalTitle">Tambah Posyandu</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="formAdd" action="">
                    <div class="form-group">
                        <select id="selDes" name="desa" class="form-control">
                            <option disabled>Pilih Desa</option>
                            <?php foreach ($desa as $d) : ?>
                                <option value="<?= $d->iddesa; ?>"><?= $d->nama; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nmpos" name="nama" placeholder="Nama Posyandu" value="" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nmdusun" name="dusun" placeholder="Nama Dusun" value="">
                    </div>
                    <input type="hidden" id="addtype" name="addtype" value="pospus">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
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
        act = '<?= base_url('/admin/tambahposyandu') ?>';

        $('#formAdd').attr("action", act);
        $('#selDes').prop('selectedIndex', 0);

    });
</script>