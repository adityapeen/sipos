<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-ruler-combined text-primary"></i> Pengukuran</h1>
    <!-- Jika Berita Acara Belum Dibuat -->
    <div class="col-lg-12 mb-4">
        <?php if ($this->session->flashdata('sukses')) {
        ?>
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <?= $this->session->flashdata('sukses'); ?>
                </div>
            </div>
        <?php
        } else if ($beritaacara == NULL) { ?>
            <div class="card bg-warning text-white shadow">
                <div class="card-body">
                    Berita Acara untuk kegiatan Posyandu hari ini belum dibuat.
                    <a href="#" class="btn btn-danger btn-sm text-white-70 small" data-toggle="modal" data-target="#kegiatanModal"><b>Buat Berita Acara</b></a>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- Jika Berita Acara Sudah Dibuat -->
    <!-- Overview Kegiatan Posyandu -->
    <?php foreach ($beritaacara as $a) { ?>
        <div class="row d-flex justify-content-center">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tanggal</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $a->tglacara; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fw fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Balita Ditimbang</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php $persen = round($a->tertimbang / $totalPeserta[0]->jml * 100);
                                                                                                    echo $persen . '%'; ?></div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: <?= $persen . "%"; ?>" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100"></div>
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
        <?php } ?>
        </div>
        <!-- Daftar Peserta Posyandu -->
        <div div class="row justify-content-center mb-4">
            <div class="card striped-tabled-with-hover shadow mb-4 col-md-8" style="padding-left:0rem; padding-right:0rem;">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Peserta Posyandu</h6>
                    <a href="#" class="btn btn-success btn-sm text-white-70 small" data-toggle="modal" data-target="#balitaModal"><b>Tambah Peserta Posyandu</b></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable hover compact" id="tabelPengukuran" cellspacing="0" role="grid" aria-describedby="dataTable_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending">Tgl Lahir</th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending">Nama</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending">Aksi</th>

                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th rowspan="1" colspan="1">Tgl Lahir</th>
                                                <th rowspan="1" colspan="1">Nama</th>
                                                <th rowspan="1" colspan="1">Aksi</th>

                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php foreach ($peserta as $p) { ?>
                                                <tr role="row">
                                                    <td class="text-center"><?= $p->tgllahir; ?></td>
                                                    <td class="sorting_1"><a href=<?= base_url('posyandu/stat/') . $p->nik; ?>><?= $p->nama; ?></a></td>
                                                    <td><?php if ($p->idpengukuran != "") { ?>
                                                            <!-- <?= base_url('posyandu/pengukuran/edit/' . $p->idpengukuran); ?> -->
                                                            <a href="#" data-ukuran="<?= $p->idpengukuran; ?>" data-title="Edit" data-toggle="modal" data-target="#timbanganModal" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                            <a href="#" class="btn btn-danger btn-sm" data-id="<?= $p->idpengukuran; ?>" data-act="<?= base_url('posyandu/timbangan/delete'); ?>" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i></a>
                                                        <?php } else { ?>
                                                            <a href="#" class="btn btn-success btn-icon-split btn-sm" data-nik="<?= $p->nik; ?>" data-title="Input" data-toggle="modal" data-target="#timbanganModal">
                                                                <span class="icon text-white-50">
                                                                    <i class="fas fw fa-edit"></i>
                                                                </span>
                                                                <span class="text">Input</span>
                                                            </a>
                                                        <?php } ?>
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
<!-- End of Main Content -->

<!-- Modal Input Timbangan-->
<div class="modal fade" id="timbanganModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="vertical-align: middle;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-input-title"><label id="modal-title"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="inputTimbangan" id="inputTimbangan" method="post" action="">
                    <input type="hidden" name="idacara" id="idacara" value="<?= $beritaacara[0]->idacara; ?>">
                    <input type="hidden" name="idpetugas" id="idpetugas" value="<?= $user['nik']; ?>">
                    <div class="form-group">
                        <label>Nama Balita</label>
                        <input type="text" name="namabalita" id="namabalita" class="form-control" disabled="" placeholder="Nama Balita" value="" readonly>
                        <input type="hidden" name="nik" id="nik" value="">
                        <input type="hidden" name="idpengukuran" id="idpengukuran" value="">
                        <input type="hidden" name="kelamin" id="kelamin" value="">
                    </div>
                    <div class="form-row">
                        <div class="col-md-6>">
                            <div class="form-group">
                                <label>Tanggal Kegiatan</label>
                                <input type="date" class="form-control" placeholder="Tanggal" value="<?= $beritaacara[0]->tglacara; ?>" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Umur (bulan)</label>
                                <input type="number" name="umur" id="umur" class="form-control" placeholder="Umur" value="" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Berat Badan (kg)</label>
                        <input type="number" name="berat" id="berat" class="form-control" placeholder="Berat badan" value="" step=".01" required>
                    </div>
                    <div class="form-row mb-1">
                        <div class="col md-6">
                            <div class="form-group">
                                <label>Tinggi Badan (cm)</label>
                                <input type="number" name="tinggi" id="tinggi" class="form-control" placeholder="(Boleh Kosong)" value="" step=".01">
                            </div>
                        </div>
                        <div class="col md-6">
                            <div class="form-group">
                                <label>Lingkar Kepala (cm)</label>
                                <input type="number" name="kepala" id="kepala" class="form-control" placeholder="(Boleh Kosong)" value="" step=".01">
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-1">
                        <div class="col md-6">
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan" value="">
                            </div>
                        </div>
                        <div class="col md-6">
                            <div class="form-group">
                                <label>Status Bantuan</label>
                                <select name="statusbantuan" id="statusbantuan" class="form-control">
                                    <option value="KIN" selected>KIN</option>
                                    <option value="NON">NON</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col" id="formvita">
                            <div class="form-group">
                                <div class="col-md-6 pr-1">
                                    <label>Vitamin A</label>
                                </div>
                                <div class="col-md-6 pr-1">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="vitamina" id="vitamina0" value=1>
                                        <label class="form-check-label" for="vitamina">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="vitamina" id="vitamina1" value=0 checked>
                                        <label class="form-check-label" for="vitamina">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group" id="formasi">
                                <div class="col-md-6 pr-1">
                                    <label>ASI Eksklusif</label>
                                </div>
                                <div class="col-md-6 pr-1">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="asie" id="asie1" value=1>
                                        <label class="form-check-label" for="asie">Ya</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="asie" id="asie0" value=0 checked>
                                        <label class="form-check-label" for="asie">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Simpan</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Balita-->
<div class="modal fade" id="balitaModal" tabindex="-1" role="dialog" aria-hidden="true" style="vertical-align: middle;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-input-title">Tambah Balita<label id="modal-title"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form name="inputBalita" id="inputBalita" method="post" action="<?= base_url('user/tambahpenduduk/') . $user['idposyandu']; ?>">
                    <input type="hidden" name="idposyandu" value="<?= $user['idposyandu']; ?>">
                    <input type="hidden" name="ukur" value=1>
                    <div class="form-group">
                        <label>NIK</label>
                        <input type="text" name="nik" id="nikadd" class="form-control" placeholder="NIK (angka saja)" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Balita*</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Balita" value="" required>
                    </div>

                    <div class="form-group">

                        <label>Jenis Kelamin</label>
                        <select id="jk" name="jk" class="form-control">
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggallahir" id="tanggallahir" required>
                    </div>
                    <div class="form-group">
                        <label>Agama</label>
                        <select id="agama" nama="agama" class="form-control" required>
                            <option value=1 selected>Islam</option>
                            <option value=2>Kristen</option>
                            <option value=3>Katolik</option>
                            <option value=4>Hindu</option>
                            <option value=5>Buddha</option>
                            <option value=6>Kong Hu Cu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <h6>
                            *Balita yang diinput dari sini belum memiliki data orang tua
                        </h6>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Simpan</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Hapus Data Timbangan-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="vertical-align: middle;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Timbangan</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Apakah anda yakin? <br>Data yang telah dihapus tidak dapat dikembalikan</div>
            <div class="modal-footer">
                <form id="deleteForm" action="" method="post" style="margin-block-end: 0em;">
                    <input type="hidden" name="idhapus" id="idhapus" value="">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger" id="linkDel">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function getIdUkur(nik, idacara) {
        var param = "nik=" + nik + "&idacara=" + idacara;
        var xhttp;
        var show;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                show = JSON.parse(this.responseText);
                alert(show[0]['idpengukuran']);
            }
        };
        xhttp.open("GET", "<?= base_url('api/getidukuran?'); ?>" + param, true);
        xhttp.send();

        // return alert(show.idpengukuran);
    }

    $('#berat').keyup(function() {
        var berat = $('#berat').val();
        var nik = $('#nik').val();
        var umur = $('#umur').val();
        var kelamin = $('#kelamin').val();

        //alert($('#berat').val());
        $.get("<?= base_url('api/getket'); ?>", {
                nik: nik,
                berat: berat,
                umur: umur,
                kelamin: kelamin,
            })
            .done(function(data) {
                var e = JSON.parse(data);
                $('#keterangan').val(e.ket);

            });
    });

    // function getDataPeserta() {
    //     alert("Hai!");
    // }

    // $(document).ready(function() {
    //     $("button").click(function() {
    //         var button = $(event.relatedTarget);
    //         var nik = button.data('nik');
    //         $.get("<?= base_url('api/getdatapeserta'); ?>", {
    //                 nik: "3403011203170001"
    //             },
    //             function(data, status) {
    //                 alert("Data: " + data + "\nStatus: " + status);
    //             });
    //     });
    // });

    $('#timbanganModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var title = button.data('title');
        var act = "";
        $('.modal-title').html(title + " Data Timbangan");
        if (title == "Input") {
            var nik = button.data('nik');
            act = "<?= base_url('/Posyandu/saveTimbangan') ?>";
            $.getJSON("<?= base_url('api/getdatapeserta'); ?>", {
                    nik: nik,
                })
                .done(function(data) {
                    $.each(data, function(idx, e) {
                        $('#inputTimbangan').trigger('reset');
                        $('#idpengukuran').val('');
                        $('#namabalita').val(e.nama);
                        $('#kelamin').val(e.kelamin);
                        $('#nik').val(e.nik);
                        $('#umur').val(e.umur);
                        if (e.umur >= 6) {
                            $('#formasi').hide();
                            $('#formvita').show();
                        } else {
                            $('#formasi').show();
                            $('#formvita').hide();
                        }
                        $('#statusbantuan').val(e.statusbantuan);
                    });
                });
            $('#inputTimbangan').attr("action", act);
        } else if (title == "Edit") {
            var idukuran = button.data('ukuran');
            act = "<?= base_url('/Posyandu/updateTimbangan') ?>";
            $.getJSON("<?= base_url('api/getukuranlengkap'); ?>", {
                    idpengukuran: idukuran,
                })
                .done(function(data) {
                    $.each(data, function(idx, e) {
                        $('#idpengukuran').val(e.idpengukuran)
                        $('#namabalita').val(e.namabalita);
                        $('#nik').val(e.nik);
                        $('#umur').val(e.umur);
                        $('#berat').val(e.berat);
                        $('#tinggi').val(e.tinggi);
                        $('#kepala').val(e.kepala);
                        $('#keterangan').val(e.keterangan);
                        //$('#vitamina').val(e.vitamina);
                        if (e.umur >= 6) {
                            $('#formasi').hide();
                            $('#formvita').show();
                        } else {
                            $('#formasi').show();
                            $('#formvita').hide();
                        }
                        (e.asi == 0) ? $('#asie0').prop('checked', true): $('#asie1').prop('checked', true);
                        (e.vitamina == 0) ? $('#vitamina0').prop('checked', true): $('#vitamina1').prop('checked', true);
                        //$('#asie').val(e.asi);
                        $('#statusbantuan').val(e.statusbantuan);
                    });
                });
            $('#inputTimbangan').attr("action", act);
        }
    });

    $('#deleteModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var act = button.data('act');
        $('#idhapus').attr("value", id);
        $('#deleteForm').attr("action", act);
    })
</script>