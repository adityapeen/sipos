<!-- Begin Page Content -->
<div class="container-fluid">
    <p class="text-center text-uppercase">REGISTER LAPORAN PEMANTAUAN PERTUMBUHAN BALITA DI POSYANDU
        <!-- <br> <b>Bulan <?= date('F', strtotime($beritaacara[0]->tglacara)); ?>
            &nbsp; &nbsp;Tahun <?= date('Y', strtotime($beritaacara[0]->tglacara)); ?></b></p> -->
        <div class="col-md-6 mb-3">
            <?php foreach ($header as $h) : ?>
                <div class="row">
                    <div class="col"><?= $h['nama']; ?> </div>
                    <div class="col">: <?php if ($h['nama'] == 'Tanggal Penimbangan') echo date('d-m-Y', strtotime($h['data']));
                                        else echo $h['data']; ?> </div>
                </div>
            <?php endforeach ?>
        </div>
        <div class="table-responsive2 mb-3">
            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row-no-gutter">
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
                                <!-- Baris 1-2 manual karena sql beda sendiri -->
                                <?php foreach ($urai as $item1) { ?>
                                    <tr role="row">
                                        <td class="text-center"><?= 1  + @$number++ ?></td>
                                        <td><?= $item1["label"] ?></td>
                                        <?php
                                        $totalSemua = 0;
                                        foreach ($kelamin as $kel) {
                                            $totalTemp = 0;
                                            foreach ($umur as $item2) {
                                                $count = $this->db->select("count(penduduk.nik) AS jumlah")
                                                    ->from("penduduk")
                                                    ->where("FLOOR(DATEDIFF('" . $header[4]['data'] . "', penduduk.tgllahir)/30.40) >=", $item2["min"])
                                                    ->where("FLOOR(DATEDIFF('" . $header[4]['data'] . "', penduduk.tgllahir)/30.40) <=", $item2["max"])
                                                    ->where('idposyandu', $posyandu['idposyandu'])
                                                    ->where($kel['wer'])
                                                    ->get()->first_row();
                                                $totalTemp = $totalTemp + $count->jumlah;
                                                echo "<td class=\"text-center\">" . $count->jumlah . "</td>";
                                            }
                                            echo "<td class=\"text-center\">" . $totalTemp . "</td>";
                                            $totalSemua += $totalTemp;
                                        }
                                        ?>
                                        <td class="text-center"><?= $totalSemua ?></td>
                                    </tr>
                                <?php } ?>


                                <!-- Perulangan baris 2-11 -->
                                <?php foreach ($uraian as $item1) { ?>
                                    <tr role="row">
                                        <td class="text-center"><?= 1 + @$number++ ?></td>
                                        <td><?= $item1["label"] ?></td>
                                        <?php
                                        $totalSemua = 0;
                                        foreach ($kelamin as $kel) {
                                            $totalTemp = 0;
                                            foreach ($umur as $item2) {
                                                $count = $this->db->select("count(pengukuran.idpengukuran) AS jumlah")
                                                    ->from("pengukuran")
                                                    ->join("beritaacara", "beritaacara.idacara=pengukuran.idacara")
                                                    ->join("penduduk", "penduduk.nik=pengukuran.nik")
                                                    ->where("FLOOR(DATEDIFF(beritaacara.tglacara, penduduk.tgllahir)/30.40) >=", $item2["min"])
                                                    ->where("FLOOR(DATEDIFF(beritaacara.tglacara, penduduk.tgllahir)/30.40) <=", $item2["max"])
                                                    ->where("pengukuran.idacara =", $item1["id"])
                                                    ->where($kel['wer'])
                                                    ->where($item1['wer'])
                                                    ->get()->first_row();
                                                $totalTemp = $totalTemp + $count->jumlah;

                                                if (is_array(@$pengecualian[$item1["id"]]) && in_array($item2["id"], $pengecualian[$item1["id"]])) {
                                                    echo "<td style=\"background-color: #23384E\"></td>";
                                                } else {
                                                    echo "<td class=\"text-center\">" . $count->jumlah . "</td>";
                                                }
                                            }

                                            if ($item1["id"] === 11) {
                                                echo "<td style=\"background-color: #23384E\"></td>";
                                            } else {
                                                echo "<td class=\"text-center\">" . $totalTemp . "</td>";
                                            }
                                            $totalSemua += $totalTemp;
                                        }
                                        ?>

                                        <td class="text-center"><?= $totalSemua ?></td>
                                        <!-- <td class="text-center" style="background-color: black"><?= $totalLaki + $totalPerempuan ?></td> -->
                                    </tr>
                                <?php } ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            Daftar Bayi Mendapat ASI - Eksklusif (ASI-E)
        </div>

        <div class="table-responsive2 mb-3">
            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row-no-gutter">
                    <div class="col-sm-12">
                        <table class="table table-bordered dataTable hover compact" id="rekapPengukuran" cellspacing="0" role="grid" aria-describedby="dataTable_info">
                            <thead class="text-center align-middle">
                                <tr role="row">
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="2" colspan="1" style="width: 20px;">No</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="2" colspan="1">Nama Bayi</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="2" colspan="1" style="width: 250px;">Nama Orangtua</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="2" colspan="1" style="width: 120px;">Tanggal Lahir</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="2" colspan="1" style="width: 100px;">Jenis Kelamin</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="2" colspan="1" style="width: 75px;">BB (kg)</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="2" colspan="1" style="width: 75px;">PB (cm)</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="6">Asi Eksklusif Bulan ke</th>
                                </tr>
                                <tr>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 45px;">1</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 45px;">2</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 45px;">3</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 45px;">4</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 45px;">5</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 45px;">6</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($asie as $b) : ?>
                                    <tr role="row" class="text-center">
                                        <td><?= 1 + @$no++ ?></td>
                                        <td class="text-left"><?= $b->nama ?></td>
                                        <td class="text-left"><?= $b->ibu . ' / ' . $b->ayah ?></td>
                                        <td><?= $b->tgllahir ?></td>
                                        <td><?= $b->kelamin ?></td>
                                        <td><?= $b->berat ?></td>
                                        <td><?= $b->tinggi ?></td>
                                        <td><?php echo (floor($b->umur) == 1) ?  'V' : NULL  ?></td>
                                        <td><?php echo (floor($b->umur) == 2) ?  'V' : NULL  ?></td>
                                        <td><?php echo (floor($b->umur) == 3) ?  'V' : NULL  ?></td>
                                        <td><?php echo (floor($b->umur) == 4) ?  'V' : NULL  ?></td>
                                        <td><?php echo (floor($b->umur) == 5) ?  'V' : NULL  ?></td>
                                        <td><?php echo (floor($b->umur) == 6) ?  'V' : NULL  ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            Daftar Balita Bawah Garis Merah (BGM)
        </div>

        <div class="table-responsive2 mb-3">
            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row-no-gutter">
                    <div class="col-sm-12">
                        <table class="table table-bordered dataTable hover compact" id="rekapPengukuran" cellspacing="0" role="grid" aria-describedby="dataTable_info">
                            <thead class="text-center align-middle">
                                <tr role="row">
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 20px;">No</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Nama Balita</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 250px;">Nama Orangtua</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 120px;">Tanggal Lahir</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 100px;">Jenis Kelamin</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 75px;">Umur</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 75px;">BB (kg)</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width: 75px;">PB (cm)</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($bgm as $b) : ?>
                                    <tr role="row" class="text-center">
                                        <td><?= 1 + @$n++ ?></td>
                                        <td class="text-left"><?= $b->nama ?></td>
                                        <td class="text-left"><?= $b->ibu . ' / ' . $b->ayah ?></td>
                                        <td><?= $b->tgllahir ?></td>
                                        <td><?= $b->kelamin ?></td>
                                        <td><?= floor($b->umur) ?></td>
                                        <td><?= $b->berat ?></td>
                                        <td><?= $b->tinggi ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
</div>
</div>