<!-- Begin Page Content -->
<div class="container-fluid">
    <p class="text-center text-uppercase">REGISTER LAPORAN PEMANTAUAN PERTUMBUHAN BALITA DI POSYANDU
        <!-- <br> <b>Bulan <?= date('F', strtotime($beritaacara[0]->tglacara)); ?>
            &nbsp; &nbsp;Tahun <?= date('Y', strtotime($beritaacara[0]->tglacara)); ?></b></p> -->
        <div class="table-responsive">
            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered dataTable hover compact" id="rekapPengukuran" cellspacing="0" role="grid" aria-describedby="dataTable_info">
                            <thead class="text-center align-middle">
                                <tr role="row">
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="2" colspan="1" style="width: 20px;">No</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="2" colspan="1">Uraian</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="5">Laki-laki</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="5">Perempuan</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="2" colspan="1">Total</th>
                                </tr>
                                <tr>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 75px;">0-5 bln</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 75px;">6-12 bln</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 75px;">13-24 bln</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 75px;">25-59 bln</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 75px;">Total</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 75px;">0-5 bln</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 75px;">6-12 bln</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 75px;">13-24 bln</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 75px;">25-59 bln</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 75px;">Total</th>
                                </tr>
                            </thead>

                            <tbody>
                                <!-- <?php $no = 1;
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
                                <?php } ?> -->
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
</div>