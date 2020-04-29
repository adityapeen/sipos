<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Detail Posyandu</h1>

    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-2">
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
                                                <th tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Tanggal</th>
                                                <th tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Ditimbang</th>
                                                <th tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width :200px;">Aksi</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php foreach ($acara as $a) { ?>
                                                <tr role="row">
                                                    <td><?= $a->tglacara ?></td>
                                                    <td><?= $a->balita ?> Balita</td>
                                                    <td>
                                                        <!-- <a href="<?= base_url('puskesmas/peserta/') . $a->idposyandu . '/' . $a->idacara; ?>" class="btn btn-warning btn-sm">Peserta</a> -->
                                                        <a href="<?= base_url('puskesmas/rekap/') . $a->idacara; ?>" class="btn btn-success btn-sm">Rekap</a>
                                                        <a href="<?= base_url('puskesmas/skdn/') . $a->idacara; ?>" class="btn btn-primary btn-sm">SKDN</a>
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
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <h6 class="m-0 font-weight-bold text-primary">Profil Posyandu</h6>
                </div>
                <div class="card-body text-center">
                    <div class="row mb-2">
                        <div class="col">
                            <i class="fas fw fa-hospital fa-5x text-gray-500"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><?= $posyandu['nama']; ?></h4>
                            <p>Dusun <?= $posyandu['dusun']; ?> Desa <?= $posyandu['desa']; ?> </p>
                        </div>
                    </div>
                    <hr class="sidebar-divider d-none d-md-block">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Kader</h5>
                            <?php foreach ($kader as $p) : ?>
                                <?= $p->nama ?><br>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <hr class="sidebar-divider d-none d-md-block">
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="<?= base_url('puskesmas/adduser/') . $posyandu['id']; ?>" class="btn btn-block btn-primary">Tambah Akun</a>
                            <a href="<?= base_url('puskesmas/penduduk/') . $posyandu['id']; ?>" class="btn btn-block btn-success">Daftar Penduduk</a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>