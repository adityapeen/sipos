<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tambah Penduduk</h1>
    <div class="row d-flex justify-content-center">
        <div class=" col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Penduduk</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= base_url('user/tambahpenduduk/') . $posyandu['idposyandu']; ?>">
                        <b>* Wajib di isi</b>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>NIK*</label>
                                    <?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
                                    <input type="text" class="form-control" name="nik" id="nik" placeholder="Nomor Induk Kependudukan" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama Lengkap*</label>
                                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap Penduduk" value="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Lahir*</label>
                                    <input type="date" class="form-control" id="tanggallahir" name="tanggallahir" placeholder="Tanggal Lahir" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <?= form_error('tgllahir', '<small class="text-danger pl-3">', '</small>'); ?>
                                    <input type="text" id="nmtempatlahir" name="kablahir" class="form-control" placeholder="Tempat Lahir" value="">
                                    <input type="hidden" name=tempatlahir id="idtempatlahir" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="jk">Jenis Kelamin*</label>
                                    <select id="jk" name="jk" class="form-control">
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Agama*</label>
                                    <select id="agama" class="form-control">
                                        <option value=1>Islam</option>
                                        <option value=2>Kristen</option>
                                        <option value=3>Katolik</option>
                                        <option value=4>Hindu</option>
                                        <option value=5>Buddha</option>
                                        <option value=6>Kong Hu Cu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pekerjaan</label>
                                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <?= form_error('idposyandu', '<small class="text-danger pl-3">', '</small>'); ?>
                                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Ibu</label>
                                    <input type="hidden" id="idibu" name="ibu" value="">
                                    <input type="text" class="form-control" id="nmibu" name="namaibu" placeholder="Nama Ibu" value="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Ayah</label>
                                    <input type="hidden" id="idayah" name="ayah" value="">
                                    <input type="text" class="form-control" id="nmayah" name="namaayah" placeholder="Nama Ayah" value="">

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Kartu KMS</label>
                                    <select id="kms" name="kms" class="form-control">
                                        <option value=1>Ya</option>
                                        <option value=0>Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Status Bantuan</label>
                                    <select class="form-control" id="statusbantuan" name="statusbantuan">
                                        <option value="NON">NON</option>
                                        <option value="KIN">KIN</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="idposyandu" value="<?= $posyandu['idposyandu']; ?>">

                        <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>
                        <button onclick="goBack()" href="#" type="button" class="btn btn-warning btn-fill pull-right">Batal</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<script type="text/javascript">
    $(document).ready(function() {
        $('#nmayah').autocomplete({
            minLength: 3,
            source: "<?php echo site_url('api/searchayah/?'); ?>",

            select: function(event, ui) {
                $('#nmayah').val(ui.item.label);
                $('[name="ayah"]').val(ui.item.nik);
            }
        });

        $('#nmibu').autocomplete({
            minLength: 3,
            source: "<?php echo site_url('api/searchibu/?'); ?>",

            select: function(event, ui) {
                $('#nmibu').val(ui.item.label);
                $('[name="ibu"]').val(ui.item.nik);
            }
        });

        $('#nmtempatlahir').autocomplete({
            minLength: 3,
            source: "<?php echo site_url('api/searchkab/?'); ?>",

            select: function(event, ui) {
                $('#nmtempatlahir').val(ui.item.label);
                $('[name="tempatlahir"]').val(ui.item.idkab);
            }
        });

    });
</script>


</div>
<!-- End of Main Content -->