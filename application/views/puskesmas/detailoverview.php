<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-list text-primary"></i> Detail Overview</h1>

    <div class="row">
        <div class="col-xl-6 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Balita <?= $tipe; ?></h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row md-12">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable" id="listOverviewTable" cellspacing="0" role="grid" aria-describedby="dataTable_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Nama Posyandu</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Balita</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($list as $p) { ?>
                                                <tr role="row">
                                                    <td><?= $p->posyandu . ' - ' . $p->alamat ?></td>
                                                    <td class="text-center"><?= $p->total ?></td>
                                                    <td>
                                                        <a class="btn btn-primary btn-icon-split btn-sm text-white" id="<?= $p->id ?>" name="<?= $p->posyandu ?>" onclick="getList(this.id, this.name)">
                                                            <span class="icon text-white-50"><i class="fas fa-list"></i></span>
                                                            <span class="text">Lihat</span>
                                                        </a>
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
        <div class="col-xl-6 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark" id="headList">Daftar Balita</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row md-12">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable" id="listTable" cellspacing="0" role="grid" aria-describedby="dataTable_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Nama Balita</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Umur</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Berat</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->
</div>
<script>
    function getList(id, nama) {
        var head = "Daftar Balita " + nama;
        $('#headList').text(head);
        $.getJSON("<?= base_url('api/getlistoverview'); ?>", {
                idp: id,
                ket: "<?= $tipe; ?>",
                th: <?= date('Y'); ?>,
                bl: <?= date('m'); ?>,
            })
            .done(function(data) {
                $('#listTable').dataTable({
                    destroy: true,
                    paging: false,
                    searching: false
                }).fnClearTable();
                $.each(data, function(idx, e) {
                    $('#listTable').dataTable().fnAddData([
                        e.nama,
                        e.umur,
                        e.berat
                    ]);
                    //     $('#nama').val(e.nama);
                    //     $('#id').val(e.id);
                    //     $('#username').val(e.username);
                    //     $('#role').prop('selectedIndex', e.role_id - 1);
                    //     $('#aktif').prop('selectedIndex', e.aktif);
                    //     $('#unitkerja').append($('<option></option>').text(e.unitkerja));
                });
            });
    }
</script>