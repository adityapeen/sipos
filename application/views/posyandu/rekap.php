<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="form-row justify-content-center">
        <div class="card md-8 mb-2">
            <div class="form-inline">
                <div class="col"><label> Lihat Rekap Posyandu </label></div>
                <div class="col">
                    <select class="form-control" id="tahun" name="tahun">
                        <?php foreach ($tahun as $t) { ?>
                            <option <?php if ($t->tahun == date('Y')) echo "selected"; ?> value="<?= $t->tahun; ?>"><?= $t->tahun; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col">
                    <select class="form-control" id="bulan" name="bulan">
                        <?php foreach ($bulan as $b) { ?>
                            <option <?php if ($b->nama == date('F')) echo "selected"; ?> value="<?= $b->bulan; ?>"><?= $b->nama; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col"><button class="btn btn-block btn-success" id="getRekap">Cari</button></div>
                <div class="col"><button class="btn btn-block btn-info" id="printRekap">Print</button></div>
            </div>
        </div>
    </div>
    <p class="text-center text-uppercase">FORMULIR PENILAIAN STATUS GIZI BAYI DAN BALITA <?= $posyandu['namaposyandu'] . " (DUSUN " . $posyandu['dusun'] . ")"; ?>
        <br> <b>Bulan <?= date('F', strtotime($beritaacara[0]->tglacara)); ?>
            &nbsp; &nbsp;Tahun <?= date('Y', strtotime($beritaacara[0]->tglacara)); ?></b></p>
    <div class="table-responsive2">
        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col">
                    <table class="table table-bordered dataTable hover compact" id="rekapPengukuran" cellspacing="0" role="grid" aria-describedby="dataTable_info">
                        <thead class="text-center">
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 20px;">No</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Nama Anak</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">L/P</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">TTL</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Nama Orang Tua</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 20px;">Umur (bln)</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 50px;">BB</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 50px;">TB</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 50px;">LK</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">N/T</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 20px;">Asi Eks</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 20px;">Vit A</th>
                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 20px;">Status</th>
                            </tr>
                        </thead>
                        <tfoot class="text-center">
                            <tr>
                                <th rowspan="1" colspan="1">No</th>
                                <th rowspan="1" colspan="1">Nama Anak</th>
                                <th rowspan="1" colspan="1">L/P</th>
                                <th rowspan="1" colspan="1">TTL</th>
                                <th rowspan="1" colspan="1">Nama Orang Tua</th>
                                <th rowspan="1" colspan="1">Umur</th>
                                <th rowspan="1" colspan="1">BB</th>
                                <th rowspan="1" colspan="1">TB</th>
                                <th rowspan="1" colspan="1">LK</th>
                                <th rowspan="1" colspan="1">N/T</th>
                                <th rowspan="1" colspan="1">ASI</th>
                                <th rowspan="1" colspan="1">Vit A</th>
                                <th rowspan="1" colspan="1">Status</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $no = 1;
                            foreach ($rekap as $p) { ?>
                                <tr role="row">
                                    <td><?= $no;
                                        $no++ ?></td>
                                    <td><?= $p->namabalita; ?></td>
                                    <td><?= $p->kelamin; ?></td>
                                    <td><?= date('j-M-Y', strtotime($p->tgllahir)); ?></td>
                                    <td><?= $p->ibu . " / " . $p->ayah; ?></td>
                                    <td class="text-center"><?= round($p->umur); ?></td>
                                    <td><?= $p->berat; ?></td>
                                    <td><?= $p->tinggi; ?></td>
                                    <td><?= $p->kepala; ?></td>
                                    <td class="text-center"><?= $p->keterangan; ?></td>
                                    <td class="text-center"><?= ($p->asi == 1 ? "Ya" : "Tidak"); ?></td>
                                    <td class="text-center"><?= ($p->vitamina == 1 ? "Ya" : "Tidak"); ?></td>
                                    <td class="text-center"><?= $p->statusbantuan; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <form id="printForm" method="post" action="<?= base_url('cetak/rekap'); ?>">
        <input type="hidden" id="idacara" name="idacara">
        <input type="hidden" id="idposyandu" name="idposyandu">
        <input type="hidden" id="header" name="header">
        <input type="hidden" id="ptahun" name="tahun">
        <input type="hidden" id="pbulan" name="bulan">
    </form>
</div>

<script>
    $('#getRekap').click(function() {
        var th = $('#tahun').val();
        var bl = $('#bulan').val();

        $.get("<?= base_url('api/getrekap'); ?>", {
                th: th,
                bl: bl,
                idp: <?= $user['idposyandu']; ?>,
            })
            .done(function(data) {
                $('#rekapPengukuran').dataTable({
                    destroy: true,
                    paging: false,
                    searching: false
                }).fnClearTable();
                var num = 1;
                var e = JSON.parse(data);
                if (e) {
                    $.each(e, function(idx, obj) {
                        if (obj.ayah == null) obj.ayah = "";
                        $('#rekapPengukuran').dataTable().fnAddData([
                            num,
                            obj.namabalita,
                            obj.kelamin,
                            obj.tgllahir,
                            obj.ibu + " / " + obj.ayah,
                            Math.round(obj.umur),
                            obj.berat,
                            obj.tinggi,
                            obj.kepala,
                            obj.keterangan,
                            obj.asi,
                            obj.vitamina,
                            obj.statusbantuan
                        ]);
                        num++;
                    });
                } else alert("Data Rekap tidak ditemukan!");

            });
    });

    $('#printRekap').click(function() {
        var th = $('#tahun').val();
        var bl = $('#bulan').val();
        var url = "<?= base_url('cetak'); ?>";

        $.post(url, {
                th: th,
                bl: bl,
                idp: <?= $user['idposyandu']; ?>,
            })
            .done(function(data) {
                // $(location).attr('href', url);
                // alert(data);
                var d = JSON.parse(data);
                $('#idacara').val(d.idacara);
                $('#idposyandu').val(d.idp);
                $('#header').val(d.nmpos + ' DUSUN ' + d.alamat);
                $('#ptahun').val($('#tahun option:selected').text());
                $('#pbulan').val($('#bulan option:selected').text());
                $('#printForm').submit()
            });
    });
</script>