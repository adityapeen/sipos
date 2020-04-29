<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="form-row col-xl-12 col-lg-12 justify-content-center">
            <div class="card shadow mb-4">
                <div class="card-header">
                    Lihat Daftar Penduduk berdasarkan lokasi
                </div>
                <div class="card-body form-inline">
                    <div class="row md-12 col-sm-12 mb-1">
                        <div class="form-group">
                            <input type="text" class="form-control" id="title" placeholder="Title" style="width:500px;">
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="description" class="form-control" placeholder="Description" style="width:500px;"></input>
                        </div>
                    </div>
                    <button class="btn btn-block btn-success" id="getPendudukDaerah" onclick="getPendudukDaerah()">Cari</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('#title').autocomplete({
            minLength: 3,
            source: "<?php echo site_url('api/cari/?'); ?>",

            select: function(event, ui) {
                $('[name="title"]').val(ui.item.label);
                $('[name="description"]').val(ui.item.nik);
            }
        });

    });
</script>