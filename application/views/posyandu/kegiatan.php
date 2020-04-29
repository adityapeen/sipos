<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Berita Acara</h1>
    <?php if ($this->session->flashdata('sukses')) {
    ?>
        <div class="col-lg-12 mb-4">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <?= $this->session->flashdata('sukses'); ?>
                </div>
            </div>
        </div>
    <?php
    } else if ($this->session->flashdata('gagal')) {
    ?>
        <div class="col-lg-12 mb-4">
            <div class="card bg-danger text-white shadow">
                <div class="card-body">
                    <?= $this->session->flashdata('gagal'); ?>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php if ($beritaacara == NULL) { ?>
        <p class="text-center"><a href="#" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-flag"></i>
                </span>
                <span class="text" data-toggle="modal" data-target="#kegiatanModal">Buat Berita Acara</span>
            </a>
        </p>
    <?php } ?>
    <div class="card striped-tabled-with-hover shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Riwayat Kegiatan Posyandu</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive2">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="beritaAcara" cellspacing="0" role="grid" aria-describedby="dataTable_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Tanggal</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Aksi</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Judul Materi</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Pemateri</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Notulen</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">Tanggal</th>
                                        <th rowspan="1" colspan="1">Aksi</th>
                                        <th rowspan="1" colspan="1">Judul Materi</th>
                                        <th rowspan="1" colspan="1">Pemateri</th>
                                        <th rowspan="1" colspan="1">Notulen</th>

                                    </tr>
                                </tfoot>
                                <tbody>

                                    <?php foreach ($acara as $a) { ?>
                                        <tr role="row">
                                            <td><?= $a->tglacara ?></td>
                                            <td>
                                                <a href="#" class="btn btn-info btn-circle btn-sm"><i class="fas fa-info"></i></a>
                                                <a href="<?= base_url('posyandu/acara/edit/' . $a->idacara); ?>" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-edit"></i></a>
                                                <a href="#" id="hapus" class="btn btn-danger btn-circle btn-sm" data-id="<?= $a->idacara; ?>" data-act="<?= base_url('posyandu/delete'); ?>" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></a>
                                            </td>
                                            <td><?= $a->judul ?></td>
                                            <td><?= $a->pemateri ?></td>
                                            <td><?= $a->notulen ?></td>

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

<!-- Modal Berita Acara-->
<div class="modal fade" id="kegiatanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="vertical-align: middle;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mulai Kegiatan Posyandu</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url('/posyandu/buatkegiatan') ?>">
                    <div class="form-group">
                        <label>Nama Posyandu</label>
                        <input type="text" class="form-control" placeholder="Nama Posyandu" value="Posyandu Melati" readonly>
                        <input type="hidden" name="idposyandu" id="idposyandu" value="<?= $user['idposyandu']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Kegiatan</label>
                        <input type="date" class="form-control" name="tglacara" placeholder="Tanggal" value="<?= date('Y-m-d'); ?>" <?php if ($user['role_id'] != 1) echo "readonly"; ?>>
                    </div>
                    <div class="form-group">
                        <label>Judul Materi</label>
                        <input type="text" class="form-control" name="judul" placeholder="Judul Materi (bisa diisi nanti)" value="">
                    </div>
                    <div class="form-group">
                        <label>Pemateri</label>
                        <input type="text" class="form-control" name="pemateri" placeholder="Pemateri (bisa diisi nanti)" value="">
                    </div>
                    <div class="form-group">
                        <label>Notulen</label>
                        <input type="text" class="form-control" placeholder="Notulen" value="<?= $user['nama']; ?>" readonly>
                        <input type="hidden" name="notulen" id="notulen" value="<?= $user['nik']; ?>">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Buat Berita Acara</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Hapus Berita Acara-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="vertical-align: middle;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Berita Acara Posyandu</h5>
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
    $('#deleteModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var act = button.data('act');
        $('#idhapus').attr("value", id);
        $('#deleteForm').attr("action", act);
    })
</script>


<!-- End of Main Content -->