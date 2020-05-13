<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-calendar-check text-primary"></i> Berita Acara</h1>
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
    <?php } else { ?>
        <div class="col-lg-12 mb-4">
            <div class="card bg-info text-white shadow">
                <div class="card-body">
                    Selamat Datang! <?= $user['nama']; ?>, Kader
                    <b><?= $posyandu['namaposyandu'] . ' Dusun ' . $posyandu['dusun']; ?></b>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php if ($beritaacara == NULL) { ?>
        <p class="text-center"><a href="#" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-flag"></i>
                </span>
                <span class="text" data-toggle="modal" data-target="#kegiatanModal">Mulai Kegiatan Posyandu</span>
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
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Balita ditimbang</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Judul Materi</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Aksi</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">Tanggal</th>
                                        <th rowspan="1" colspan="1">Balita Ditimbang</th>
                                        <th rowspan="1" colspan="1">Aksi</th>
                                        <th rowspan="1" colspan="1">Judul Materi</th>
                                    </tr>
                                </tfoot>
                                <tbody>

                                    <?php foreach ($acara as $a) { ?>
                                        <tr role="row">
                                            <td><?= $a->tglacara ?></td>
                                            <td><?= $a->balita . ' balita' ?></td>
                                            <td><?= $a->judul ?></td>
                                            <td>
                                                <a href="#" class="btn btn-info btn-circle btn-sm" data-id="<?= $a->idacara; ?>" data-toggle="modal" data-target="#infoModal"><i class="fas fa-info"></i></a>
                                                <a href="<?= base_url('posyandu/acara/edit/' . $a->idacara); ?>" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-edit"></i></a>
                                                <a href="#" id="hapus" class="btn btn-danger btn-circle btn-sm" data-id="<?= $a->idacara; ?>" data-act="<?= base_url('posyandu/delete'); ?>" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></a>
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
                <form method="post" class="eventInsForm" action="<?= base_url('/posyandu/buatkegiatan') ?>">
                    <div class="form-group">
                        <label>Nama Posyandu</label>
                        <input type="text" class="form-control" placeholder="Nama Posyandu" value="<?= $posyandu['namaposyandu']; ?>" readonly>
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
                        <input type="text" class="form-control" id="nmpemateri" placeholder="Pemateri (bisa diisi nanti)">
                        <input type="hidden" id="nikpem" name="pemateri" value="">
                    </div>
                    <div class="form-group">
                        <label>Notulen</label>
                        <input type="text" class="form-control" placeholder="Notulen" value="<?= $user['nama']; ?>" readonly>
                        <input type="hidden" name="notulen" value="<?= $user['nik']; ?>">
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

<!-- Modal Detail Acara-->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Kegiatan Posyandu</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Posyandu</label>
                    <input type="text" class="form-control" id="namaposyandu" placeholder="Nama Posyandu" value="" readonly>
                </div>
                <div class="form-row mb-1">
                    <div class="col md-6">
                        <div class="form-group">
                            <label>Tanggal Kegiatan</label>
                            <input type="text" name="tglacara" id="tglacara" class="form-control" placeholder="Tangal" value="" readonly>
                        </div>
                    </div>
                    <div class="col md-6">
                        <div class="form-group">
                            <label>Balita Ditimbang</label>
                            <input type="text" class="form-control" id="balita" placeholder="Nama Posyandu" value="" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group">
                            <a class="btn btn-block btn-success" id="btnRekap">Rekap</a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <a class="btn btn-block btn-primary" id="btnSkdn">SKDN</a>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Judul Materi</label>
                    <input type="text" class="form-control" id="judul" placeholder="(silahkan ubah lewat menu edit)" value="" readonly>
                </div>
                <div class="form-group">
                    <label>Pemateri</label>
                    <input type="text" class="form-control" id="pemateri" placeholder="(silahkan ubah lewat menu edit)" value="" readonly>
                </div>
                <div class="form-group">
                    <label>Notulen</label>
                    <input type="text" class="form-control" placeholder="Notulen" id="notulen" readonly>
                </div>
                <div class="form-group">
                    <label>Catatan Kegiatan</label>
                    <textarea rows="3" id="catatan" name="catatan" cols="80" class="form-control" placeholder="Catatan selama Kegiatan" readonly></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
            </div>
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
    $('#infoModal').on('show.bs.modal', function(event) {
        var id = $(event.relatedTarget).data('id');
        var rekap = "<?= base_url('posyandu/datarekap/'); ?>" + id;
        var skdn = "<?= base_url('posyandu/dataskdn/'); ?>" + id;

        $.getJSON("<?= base_url('api/getdetailacara'); ?>", {
                idacara: id,
            })
            .done(function(data) {
                $.each(data, function(idx, e) {
                    $('#namaposyandu').val(e.namaposyandu);
                    $('#tglacara').val(e.tglacara);
                    $('#balita').val(e.tertimbang + ' balita');
                    $('#judul').val(e.judul);
                    $('#pemateri').val(e.pemateri);
                    $('#notulen').val(e.notulen);
                    $('#catatan').val(e.catatan);
                });
            });
        $('#btnRekap').attr("href", rekap);
        $('#btnSkdn').attr("href", skdn);
    })
    $(document).ready(function() {
        $('#nmpemateri').autocomplete({
            minLength: 1,
            source: "<?php echo site_url('api/searchkader/?idp=') . $user['idposyandu']; ?>",

            select: function(event, ui) {
                $('#nmpemateri').val(ui.item.label);
                $('#nikpem').val(ui.item.nik);
            }
        });
        $('#nmpemateri').autocomplete("option", "appendTo", ".eventInsForm");
    })
</script>


<!-- End of Main Content -->