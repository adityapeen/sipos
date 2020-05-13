<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Berita Acara</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Berita Acara</h4>
                </div>
                <div class="card-body">
                    <?php foreach ($acara as $a) { ?>
                        <form method="post" action="<?= base_url('/Posyandu/updatekegiatan') ?>">
                            <input type="hidden" name="idacara" value="<?= $a->idacara; ?>">
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Nama Posyandu</label>
                                        <input type="text" class="form-control" placeholder="Nama Posyandu" value="<?= $a->namaposyandu; ?>" <?php if ($user['role_id'] != 1) echo "readonly"; ?>>
                                        <input type="hidden" name="idposyandu" value="<?= $a->idposyandu; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Tanggal Kegiatan</label>
                                        <input name="tglacara" type="date" class="form-control" placeholder="Tanggal Kegiatan" value="<?= $a->tglacara; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Pemateri</label>
                                        <input type="text" id="pemateri" class="form-control" placeholder="Pemateri" value="<?= $a->pemateri; ?>">
                                        <input type="hidden" id="nikpem" name="pemateri" value="<?= $a->nikpem; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Notulen</label>
                                        <input type="text" id="notulen" class="form-control" placeholder="Notulen" value="<?= $a->notulen; ?>" <?php if ($user['role_id'] != 1) echo "readonly"; ?>>
                                        <input type="hidden" name="notulen" value="<?= $a->niknot; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Judul Materi</label>
                                        <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul Materi" value="<?= $a->judul; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Catatan</label>
                                        <textarea rows="4" id="catatan" name="catatan" cols="80" class="form-control" placeholder="Catatan selama Kegiatan"><?= $a->catatan; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="notulen" id="notulen" value="<?= $user['nik']; ?>">
                            <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>
                            <a href="#" type="button" class="btn btn-warning btn-fill pull-right" onclick="goBack()">Batal</a>
                            <div class="clearfix"></div>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
    $(document).ready(function() {
        $('#pemateri').autocomplete({
            minLength: 1,
            source: "<?php echo site_url('api/searchkader/?idp=') . $user['idposyandu']; ?>",

            select: function(event, ui) {
                $('#pemateri').val(ui.item.label);
                $('#nikpem').val(ui.item.nik);
            }
        });
    })
</script>