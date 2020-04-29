<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Statistik Posyandu</h1>

    <div class="row d-flex justify-content-centerd-flex justify-content-center">
        <?php $type = ['bg-success', 'bg-warning', 'bg-info', 'bg-primary'];
        $i = 0;
        foreach ($posyandu as $p) : ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="<?= base_url('puskesmas/posyandu/detail/') . $p->id; ?>" class="card <?= $type[$i]; ?> card-link shadow text-white h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase text-white-50 mb-1">Dusun <?= $p->dusun . ' - ' . $p->desa; ?></div>
                                <div class="h5 mb-0 font-weight-bold"><?= $p->nama; ?></div>
                                <div class="text-s font-weight-bold"><?= $p->balita; ?> Balita</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fw fa-stethoscope fa-2x text-white-50"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php $i++;
            if ($i == 4) $i = 0;
        endforeach ?>
    </div>

    <!-- template -->
    <div class="row d-flex justify-content-center">
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="#" class="card bg-success card-link text-white shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase text-white-50 mb-1">Dusun JETIS - HARGOMULYO</div>
                            <div class="h5 mb-0 font-weight-bold">PSOYANDU MELAYI</div>
                            <div class="text-s font-weight-bold">37 Balita</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fw fa-calendar fa-2x text-white-50"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Balita Ditimbang</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Ts</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fw fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
</div>