<html>

<head>
    <title>Rekap Kegiatan Posyandu</title>
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body background="white">
    <p class="text-center text-uppercase text-dark font-weight-bold">
        FORMULIR PENILAIAN STATUS GIZI BAYI DAN BALITA <?= $beritaacara[0]->namaposyandu; ?> DUSUN <?= $beritaacara[0]->dusun; ?>
        <br>Bulan <?= date('F', strtotime($beritaacara[0]->tglacara)); ?>
        &nbsp; &nbsp;Tahun <?= date('Y', strtotime($beritaacara[0]->tglacara)); ?>
    </p>

    <div class="row-no-gutter">
        <div class="col">
            <table class="table-bordered text-xs" id="rekapPengukuran" cellspacing="0" role="grid" aria-describedby="dataTable_info">
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

</body>

</html>