<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Data Penduduk</h1>
    <div class="row d-flex justify-content-center">
        <div class=" col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Penduduk</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= base_url('user/updatependuduk') ?>">
                        <b>* Wajib di isi</b>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>NIK*</label>
                                    <input type="text" class="form-control" name="nik" id="nik" placeholder="Nomor Induk Kependudukan" value="<?= $penduduk->nik; ?>" readonly required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama Lengkap*</label>
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap Penduduk" value="<?= $penduduk->nama; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Lahir*</label>
                                    <input type="date" class="form-control" id="tanggallahir" name="tanggallahir" placeholder="Tanggal Lahir" value="<?= $penduduk->tgllahir; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" id="nmtempatlahir" name="kablahir" class="form-control" placeholder="Tempat Lahir" value="<?= $penduduk->tempatlahir; ?>">
                                    <input type="hidden" name=tempatlahir id="idtempatlahir" value="<?= $penduduk->idkab; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="jk">Jenis Kelamin*</label>
                                    <select id="jk" name="jk" class="form-control">
                                        <option <?php if ($penduduk->kelamin == 'L') echo 'selected'; ?> value="L">Laki-laki</option>
                                        <option <?php if ($penduduk->kelamin == 'P') echo 'selected'; ?> value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Agama*</label>
                                    <select id="agama" class="form-control" value="<?= $penduduk->agama; ?>">
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
                                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan" value="<?= $penduduk->pekerjaan; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="<?= $penduduk->alamat; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Ibu</label>
                                    <input type="hidden" id="idibu" name="ibu" value="<?= $penduduk->idibu; ?>">
                                    <input type="text" class="form-control" id="nmibu" name="namaibu" placeholder="Nama Ibu" value="<?= $penduduk->ibu; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Ayah</label>
                                    <input type="hidden" id="idayah" name="ayah" value="<?= $penduduk->idayah; ?>">
                                    <input type="text" class="form-control" id="nmayah" name="namaayah" placeholder="Nama Ayah" value="<?= $penduduk->ayah; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Kartu KMS</label>
                                    <select id="kms" name="kms" class="form-control">
                                        <option <?php if ($penduduk->kms == 1) echo 'selected'; ?> value=1>Ya</option>
                                        <option <?php if ($penduduk->kms == 0) echo 'selected'; ?> value=0>Tidak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Status Bantuan</label>
                                    <input type="text" class="form-control" id="statusbantuan" name="statusbantuan" placeholder="Bantuan saat ini" value="<?= $penduduk->statusbantuan; ?>">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="idposyandu" value="<?= $user['idposyandu']; ?>">

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