<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Statistik Perkembangan Balita</h1>



    <!-- Data Balita -->
    <div class="row d-flex justify-content-center mb-4">
        <div class=" col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Balita</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Nama Lengkap</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap Penduduk" value="<?= $balita->nama; ?>" readonly>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Jenis Kelamin*</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <input type="text" class="form-control" name="kelamin" id="kelamin" placeholder="Jenis Kelamin" value="<?php if ($balita->kelamin == "L") echo "Laki-laki";
                                                                                                                                        else echo "Perempuan"; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class=" row">
                        <div class="col-md-4">
                            <label>Tanggal Lahir</label>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="tgllahir" id="tgllahir" placeholder="Tanggal Lahir" value="<?= $balita->tgllahir; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label>Umur</label>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" class="form-control" name="umur" id="umur" placeholder="umur" value="<?= round($balita->umur) . ' bulan'; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Ayah</label>
                                <input type="text" class="form-control" name="ayah" id="ayah" placeholder="ayah" value="<?= $balita->ayah; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Ibu</label>
                                <input type="text" class="form-control" name="ibu" id="ibu" placeholder="ibu" value="<?= $balita->ibu; ?>" readonly>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-center mb-4">
        <div class="card col-md-8" style="padding-left:0rem; padding-right:0rem;">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Berat Badan</h6>
            </div>
            <div class="card-body">
                <canvas id="myChart" width="100" height="300"></canvas>
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-center mb-4">
        <div class="card shadow mb-4 col-md-8" style="padding-left:0rem; padding-right:0rem;">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Timbangan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered dataTable hover compact" id="tabelStatistik" cellspacing="0" role="grid" aria-describedby="dataTable_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending">Bulan</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Umur</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Berat</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending">Tinggi</th>
                                            <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending">Kepala</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th rowspan="1" colspan="1">Bulan</th>
                                            <th rowspan="1" colspan="1">Umur</th>
                                            <th rowspan="1" colspan="1">Berat</th>
                                            <th rowspan="1" colspan="1">Tinggi</th>
                                            <th rowspan="1" colspan="1">Kepala</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($stat as $s) { ?>
                                            <tr role="row">
                                                <td><?= date('F Y', strtotime($s->tglacara)); ?></td>
                                                <td class="text-center"><?= round($s->umur) . ' bln'; ?></td>
                                                <td class="text-center"><?= $s->berat . ' kg'; ?></td>
                                                <td class="text-center"><?php if ($s->tinggi != NULL) echo $s->tinggi . ' cm';
                                                                        else echo '-'; ?></td>
                                                <td class="text-center"><?php if ($s->kepala != NULL) echo $s->tinggi . ' cm';
                                                                        else echo '-'; ?></td>
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

<script>
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [<?php foreach ($stat as $s) echo '"' . date('F', strtotime($s->tglacara)) . '", '; ?>],
            datasets: [{
                label: 'Berat',
                data: [<?php foreach ($stat as $s) echo $s->berat . ', '; ?>],
                backgroundColor: "rgba(34, 74, 190, 0.5)",
                lineTension: 0.4,
                pointRadius: 5,
                pointHoverRadius: 10,
                borderColor: "rgba(78, 115, 223, 1)",
                borderWidth: 4
            }]
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: true,
                        drawBorder: true
                    },
                    ticks: {
                        maxTicksLimit: 60
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: false,
                        maxTicksLimit: 15,
                        padding: 10,
                        callback: function(value, index, values) {
                            return value + ' kg';
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function(tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ' ' + tooltipItem.yLabel + ' kg';
                    }
                }
            }
        }
    });
</script>