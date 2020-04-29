<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="col-lg-12 mb-4">
        <?php if ($this->session->flashdata('sukses')) { ?>
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <?= $this->session->flashdata('sukses'); ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <p class="text-center"><a href="#" class="btn btn-success btn-sm text-white-70 small" data-toggle="modal" data-target="#balitaModal"><b>Tambah Peserta Posyandu</b></a></p>
    <!-- Daftar Peserta Posyandu -->
    <div div class="row  justify-content-center mb-4">

        <div class="card striped-tabled-with-hover shadow mb-4 col-md-8" style="padding-left:0rem; padding-right:0rem;">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Peserta Posyandu</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered dataTable hover compact" id="tabelPengukuran" cellspacing="0" role="grid" aria-describedby="dataTable_info">
                                    <thead class="text-center">
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending">Tgl Lahir</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Nama Balita</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending">Umur (bln)</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="text-center">
                                        <tr>
                                            <th rowspan="1" colspan="1">Lahir</th>
                                            <th rowspan="1" colspan="1">Nama</th>
                                            <th rowspan="1" colspan="1">Umur</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($peserta as $p) { ?>
                                            <tr role="row">
                                                <td class="text-center"><?= $p->tgllahir; ?></td>
                                                <td class="sorting_1"><a href=<?= base_url('posyandu/stat/') . $p->nik; ?>><?= $p->nama; ?></a></td>
                                                <td class="text-center"><?= round($p->umur, 2); ?></td>
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
<!-- End of Main Content -->

<!-- Modal Tambah Balita-->
<div class="modal fade" id="balitaModal" tabindex="-1" role="dialog" aria-hidden="true" style="vertical-align: middle;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-input-title">Tambah Balita<label id="modal-title"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="inputBalita" id="inputBalita" method="post" action="<?= base_url('user/tambahpenduduk'); ?>">
                    <input type="hidden" name="idposyandu" value="<?= $user['idposyandu']; ?>">
                    <input type="hidden" name="daftar" value=1>
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik" id="nik" class="form-control" placeholder="NIK (angka saja)" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Balita*</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Balita" value="" required>
                    </div>

                    <div class="form-group">

                        <label>Jenis Kelamin</label>
                        <select id="jk" name="jk" class="form-control">
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggallahir" id="tanggallahir" required>
                    </div>
                    <div class="form-group">
                        <label>Agama</label>
                        <select id="agama" nama="agama" class="form-control" required>
                            <option value=1 selected>Islam</option>
                            <option value=2>Kristen</option>
                            <option value=3>Katolik</option>
                            <option value=4>Hindu</option>
                            <option value=5>Buddha</option>
                            <option value=6>Kong Hu Cu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <h6>
                            *Balita yang diinput dari sini belum memiliki data orang tua
                        </h6>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Simpan</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>