<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Data Timbangan</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Data Timbangan</h4>
                </div>
                <?php foreach ($ukuran as $u) { ?>
                    <div class="card-body">
                        <form method="post" action="<?= base_url('/Posyandu/update') ?>">
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>Nama Balita</label>
                                        <input type="text" class="form-control" placeholder="Nama Posyandu" value="<?= $u->namabalita; ?>" readonly>
                                        <input type="hidden" name="idpengukuran" value="<?= $u->idpengukuran; ?>">
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <input type="date" class="form-control" placeholder="Tanggal Lahir" value="<?= $u->tgllahir; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label>Nama Ayah</label>
                                        <input type="text" id="ayah" name="ayah" class="form-control" placeholder="Nama Ayah" value="<?= $u->ayah; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-5 pr-1">
                                    <div class="form-group">
                                        <label>Nama Ibu</label>
                                        <input type="text" class="form-control" placeholder="Nama Ibu" value="<?= $u->ibu; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2 pr-1">
                                    <div class="form-group">
                                        <label>Tanggal Kegiatan</label>
                                        <input type="date" class="form-control" placeholder="Tanggal Kegiatan" value="<?= $u->tglacara; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 pr-1">
                                    <div class="form-group">
                                        <label>Umur (bulan)</label>
                                        <input type="number" class="form-control" placeholder="Tanggal Lahir" value="<?= $u->umur; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3 pr-1">
                                    <div class="form-group">
                                        <label>Berat Badan (kg)</label>
                                        <input type="number" class="form-control" placeholder="Berat badan" value="<?= $u->berat; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3 pr-1">
                                    <div class="form-group">
                                        <label>Tinggi Badan (cm)</label>
                                        <input type="number" class="form-control" placeholder="Tinggi badan" value="<?= $u->tinggi; ?>">
                                    </div>
                                </div>
                                <div class="col-md-3 pr-1">
                                    <div class="form-group">
                                        <label>Lingkar Kepala (cm)</label>
                                        <input type="number" class="form-control" placeholder="(Boleh Kosong)" value="<?= $u->kepala; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <div class="col-md-6 pr-1">
                                            <label>Vitamin A</label>
                                        </div>
                                        <div class="col-md-6 pr-1">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="vitamina" id="vitamina" value=1 <?php if ($u->vitamina == 1) echo "checked"; ?>>
                                                <label class="form-check-label" for="vitamina">Ya</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="vitamina" id="vitamina" value=0 <?php if ($u->vitamina == NULL) echo "checked"; ?>>
                                                <label class="form-check-label" for="vitamina">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <div class="col-md-6 pr-1">
                                            <label>ASI Eksklusif</label>
                                        </div>
                                        <div class="col-md-6 pr-1">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="asie" id="asie" value=1 <?php if ($u->asi == 1) echo "checked"; ?>>
                                                <label class="form-check-label" for="asie">Ya</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="asie" id="asie" value=0 <?php if ($u->asi != 1) echo "checked"; ?>>
                                                <label class="form-check-label" for="asie">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 pr-1">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Status Perkembangan Balita" value="<?= $u->keterangan; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill pull-right">Simpan</button>
                            <button onclick="goBack()" type="button" class="btn btn-warning btn-fill pull-right">Batal</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->