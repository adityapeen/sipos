<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-first-aid text-primary"></i> Daftar Posyandu</h1>

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


</div>
<!-- /.container-fluid -->
</div>