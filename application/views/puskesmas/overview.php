<!-- Begin Page Content -->
<div class="container-fluid ">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-chart-pie text-primary"></i> Overview</h1>

        <div class="d-sm-flex">
            <span class="mr-3 mt-2"> Riwayat</span>
            <div class="form-inline">
                <select class="form-control mb-1 mr-1" id="bulan" name="bulan">
                    <?php foreach ($bulan as $bl) : ?>
                        <option value="<?= $bl->bulan; ?>" <?php if ($bl->bulan == date('m') || $bl->bulan == $this->input->post('bl')) echo "selected"; ?>><?= $bl->nama; ?></option>
                    <?php endforeach ?>
                </select>
                <select class="form-control mb-1 mr-1" id="tahun" name="tahun">
                    <?php foreach ($tahun as $th) : ?>
                        <option value="<?= $th->tahun; ?>" <?php if ($th->tahun == date('Y') || $th->tahun == $this->input->post('th')) echo "selected"; ?>><?= $th->tahun; ?></option>
                    <?php endforeach ?>
                </select>
                <div class="col mb-1 p-1"><button class="btn btn-block btn-success" onclick="getHistory()">Lihat</button></div>
            </div>

        </div>
    </div>

    <!-- template -->
    <div class="row d-flex justify-content-center">
        <div class="col">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Perbandingan Balita</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="myPieChart" width="472" height="245" class="chartjs-render-monitor"></canvas>
                    </div>

                </div>
            </div>
        </div>
        <div class="col">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-12 col-md-6 mb-2">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Selamat Datang!</div>
                                    <div class="h6 mb-0 font-weight-bold text-info"><?= $user['nama']; ?></div>
                                </div>
                                <div class="col-auto">
                                    <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $puskesmas['namapuskesmas']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-2">
                    <a href="<?= base_url('puskesmas/posyandu'); ?>" class="card card-link border-bottom-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Posyandu</div>
                                </div>
                                <div class="col-auto">
                                    <div class="h2 mb-0 font-weight-bold text-gray-800"><?= $overview['posyandu']; ?></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-md-6 mb-2">
                    <a href="<?= base_url('puskesmas/userlist'); ?>" class="card card-link border-bottom-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Kader</div>
                                </div>
                                <div class="col-auto">
                                    <div class="h2 mb-0 font-weight-bold text-gray-800"><?= $overview['kader']; ?></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-xl-4 col-md-6 mb-2">
                    <div class="card border-bottom-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Balita</div>
                                </div>
                                <div class="col-auto">
                                    <div class="h2 mb-0 font-weight-bold text-gray-800"><?= $overview['balita']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-2">
                    <a href="#" class="card card-link border-bottom-success shadow h-100 py-2" onclick="getDetail('N')">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Timbangan<br>N</div>
                                </div>
                                <div class="col-auto">
                                    <div class="h2 mb-0 font-weight-bold text-gray-800"><?= $overview['N']; ?></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-md-6 mb-2">
                    <a href="#" class="card card-link border-bottom-warning shadow h-100 py-2" onclick="getDetail('T')">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Timbangan<br>T</div>
                                </div>
                                <div class="col-auto">
                                    <div class="h2 mb-0 font-weight-bold text-gray-800"><?= $overview['T']; ?></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-md-6 mb-2">
                    <a href="#" class="card card-link border-bottom-danger shadow h-100 py-2" onclick="getDetail('2T')">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Timbangan<br>2T</div>
                                </div>
                                <div class="col-auto">
                                    <div class="h2 mb-0 font-weight-bold text-gray-800"><?= $overview['2T']; ?></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-md-6 mb-2">
                    <a href="#" class="card card-link border-bottom-info shadow h-100 py-2" onclick="getDetail('O')">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Timbangan<br>O</div>
                                </div>
                                <div class="col-auto">
                                    <div class="h2 mb-0 font-weight-bold text-gray-800"><?= $overview['O']; ?></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-md-6 mb-2">
                    <a href="#" class="card card-link border-bottom-primary shadow h-100 py-2" onclick="getDetail('B')">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Timbangan<br>B</div>
                                </div>
                                <div class="col-auto">
                                    <div class="h2 mb-0 font-weight-bold text-gray-800"><?= $overview['B']; ?></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4 col-md-6 mb-2">
                    <a href="#" class="card card-link border-bottom-danger shadow h-100 py-2" onclick="getDetail('BGM')">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Timbangan<br>BGM</div>
                                </div>
                                <div class="col-auto">
                                    <div class="h2 mb-0 font-weight-bold text-gray-800"><?= $overview['BGM']; ?></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <form id="detail" action="<?= base_url('puskesmas/list'); ?>" method="POST">
            <input type="hidden" id="th" name="th" value="">
            <input type="hidden" id="bl" name="bl" value="">
            <input type="hidden" id="ket" name="ket" value="">
        </form>
        <form id="history" action="<?= base_url('puskesmas'); ?>" method="POST">
            <input type="hidden" id="thn" name="th" value="">
            <input type="hidden" id="bln" name="bl" value="">
        </form>


    </div>
    <!-- /.container-fluid -->
</div>
</div>
<script>
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [<?php foreach ($rasio as $r) echo '"' . $r->kelamin . '", '; ?>],
            datasets: [{
                data: [<?php foreach ($rasio as $r) echo $r->total . ', '; ?>],
                backgroundColor: ['#4e73df', '#e83e8c'],
                hoverBackgroundColor: ['#2e59d9', '#dc1c74'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: true
            },
            cutoutPercentage: 50,
        },
    });

    function getHistory() {
        $('#thn').val($('#tahun').val());
        $('#bln').val($('#bulan').val());
        $('#history').submit();
    }

    function getDetail(ket) {
        <?php if ($this->input->post() == NULL) { ?>
            var th = <?= date('Y'); ?>;
            var bl = <?= date('m'); ?>;
        <?php } else { ?>
            var th = $('#tahun').val();
            var bl = $('#bulan').val();
        <?php } ?>
        $('#th').val(th);
        $('#bl').val(bl);
        $('#ket').val(ket);
        $('#detail').submit();
    }

    $(document).ready(function() {
        //$('#deleteModal').show();
        $('.toast').toast({
            delay: 5000
        });
        $('.toast').toast('show');
    });
</script>