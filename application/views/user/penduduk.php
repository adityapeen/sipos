<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-address-card text-primary"></i> Data Penduduk</h1>

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
    <p class="text-center">
        <a href="<?= base_url('user/tambahpenduduk/') . $posyandu['idposyandu']; ?>" class="btn btn-primary btn-sm text-white-70 small"><b>Tambah Penduduk</b></a>
    </p>


    <div class="card striped-tabled-with-hover shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Penduduk <?= $posyandu['dusun']; ?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable" cellspacing="0" role="grid" aria-describedby="dataTable_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Nama</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending">JK</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending">Tanggal Lahir</th>
                                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">Nama</th>
                                        <th rowspan="1" colspan="1">JK</th>
                                        <th rowspan="1" colspan="1">Tanggal Lahir</th>
                                        <th rowspan="1" colspan="1">Aksi</th>

                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($penduduk as $p) { ?>
                                        <tr role="row">
                                            <td><?= $p->nama ?></td>
                                            <td><?= $p->kelamin ?></td>
                                            <td><?= $p->tgllahir ?></td>
                                            <td>
                                                <!-- <i href="#" class="btn btn-info btn-circle btn-sm"><i class="fas fa-info"></i></a> -->
                                                <a href="<?= base_url('user/penduduk/edit/') . $p->nik; ?>" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-edit"></i></a>
                                                <a href="#" class="btn btn-danger btn-circle btn-sm" data-id="<?= $p->nik; ?>" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></a>
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

<!-- Modal Hapus Penduduk-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="vertical-align: middle;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Penduduk</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Apakah anda yakin? <br>Data yang telah dihapus tidak dapat dikembalikan</div>
            <div class="modal-footer">
                <form id="deleteForm" action="" method="post" style="margin-block-end: 0em;">
                    <input type="hidden" name="idhapus" id="idhapus" value="">
                    <input type="hidden" name="idposyandu" id="idpos" value="<?= $posyandu['idposyandu']; ?>">
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
        var act = "<?= base_url('user/penduduk/delete'); ?>";
        $('#idhapus').attr("value", id);
        $('#deleteForm').attr("action", act);
    })
</script>