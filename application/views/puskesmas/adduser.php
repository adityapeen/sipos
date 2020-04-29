<!-- Begin Page Content -->
<div class="container-fluid">
    <?php if (!isset($penduduk)) { ?>
        <div class="row">
            <div class="form-row col-xl-12 col-lg-12 justify-content-center">
                <div class="card shadow mb-4">
                    <div class="card-header">Lihat Daftar Penduduk berdasarkan Desa</div>
                    <div class="card-body form-inline">
                        <div class="row md-12 col-sm-12 mb-2 justify-content-center">
                            <select class="form-group form-control" id="selDes">
                                <option selected disabled>Pilih Desa</option>
                                <?php foreach ($desa as $d) : ?>
                                    <option value="<?= $d->id; ?>"><?= $d->nama; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <button class="btn btn-block btn-success" id="getPendudukDaerah" onclick="getPendudukDaerah()">Cari</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <?php if (isset($penduduk) && $penduduk != NULL) { ?>
                    <div class="card-header">Daftar Penduduk Dusun <?= $posyandu['dusun']; ?></div>
                <?php } ?>
                <div class="card-body">
                    <div class="table-responsive2">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered dataTable hover compact" id="daftarPenduduk" cellspacing="0" role="grid" aria-describedby="dataTable_info">
                                        <thead class="text-center">
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Nama</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">L/P</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width : 145px;">Tanggal Lahir</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Dusun</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (isset($penduduk)) {
                                                foreach ($penduduk as $p) { ?>
                                                    <tr role="row">
                                                        <td><?= $p->nama ?></td>
                                                        <td><?= $p->kelamin ?></td>
                                                        <td><?= $p->tgllahir ?></td>
                                                        <td><?= $posyandu['dusun'] ?></td>
                                                        <td>
                                                            <a href="#" class="btn btn-success btn-sm text-white-70 small" data-toggle="modal" data-id="<?= $p->nik; ?>" data-target="#addUserModal">Input</a>
                                                        </td>
                                                <?php
                                                }
                                            } ?>
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

<!-- Modal Tambah User-->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="vertical-align: middle;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambahkan Akun Baru</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url('auth/register') ?>">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="nama" placeholder="Nama Lengkap" name="nama" value="" readonly>
                        <input type="hidden" name="nik" id="nik" value="">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="username" placeholder="Username" name="username" value="" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password" required>
                        </div>
                        <div class="col-sm-6">
                            <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Ulangi Password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label> Role </label>
                        <select name="role" id="role" class="form-control">
                            <?php foreach ($role as $r) { ?>
                                <option value="<?= $r->id; ?>"><?= $r->role; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label> Unit Kerja </label>
                        <select name="idposyandu" id="unitkerja" class="form-control">
                            <?php if (isset($penduduk)) echo "<option value=" . $posyandu['idposyandu'] . ">" . $posyandu['namaposyandu'] . "</option>"; ?>
                        </select>
                        <input type="hidden" name="tipe" value="puskesmas">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Tambah User</button>
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            </div>
            </form>
        </div>
    </div>
</div>

</div>
<script>
    $(document).ready(function() {
        $("#daftarPenduduk").DataTable({
            paging: false,
            searching: true,
            info: true,
        });
    });

    function getPendudukDaerah() {
        if ($('#selDes').prop('selectedIndex') != 0) {
            $('#daftarPenduduk').dataTable({
                destroy: true,
                paging: false
            }).fnClearTable();
            var id = $('#selDes').val();
            $.getJSON("<?= base_url('api/getpendudukdaerah'); ?>", {
                    kodedesa: id,
                })
                .done(function(data) {
                    if (data) {
                        $.each(data, function(idx, obj) {
                            $('#daftarPenduduk').dataTable().fnAddData([
                                obj.nama,
                                obj.kelamin,
                                obj.tgllahir,
                                obj.dusun,
                                '<a href="#" class="btn btn-success btn-sm text-white-70 small" data-toggle="modal" data-id="' + obj.id + '" data-target="#addUserModal">Input</a>'
                            ]);

                        });
                    }
                });
        } else alert('Pilih Desa!');
    };

    $('#addUserModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);

        var nik = button.data('id');
        $.getJSON("<?= base_url('api/getdatapenduduk'); ?>", {
                nik: nik,
            })
            .done(function(data) {
                $.each(data, function(idx, e) {
                    $('#nama').val(e.nama);
                    $('#nik').val(e.nik);
                });

            });
        if ($('#selDes').prop('selectedIndex') != 0) {
            $.getJSON("<?= base_url('api/getposyandudaerah'); ?>", {
                    id: $('#selDes').val(),
                })
                .done(function(data) {
                    $('#unitkerja').empty();
                    $.each(data, function(key, val) {
                        $('#unitkerja').append($('<option></option>').attr('value', val.id).text(val.nama));
                    })
                });
        }

    });

    $('#username').focusout(function() {
        var username = $('#username').val();
        if (username != '') {
            $.get("<?= base_url('api/getusername'); ?>", {
                    username: username,
                })
                .done(function(data) {
                    var e = JSON.parse(data);
                    if (e.terpakai == true) {
                        alert("Username sudah digunakan!");
                    }
                });
        }
    });

    $('#password2').focusout(function() {
        var pass1 = $('#password1').val();
        var pass2 = $('#password2').val();
        if (pass1 != pass2) {
            alert('Password Harus Sama!');
        }
    });
</script>