<?php $count = count($harga); ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manage Harga Event</h1>
</div>

<!-- DataTales -->
<div class="card shadow mb-4">
    <div class="card-header py-3"></div>
    <div class="card-body row">
        <div class="col-sm-6" style="font-size:14px;">
            <div class="form-group row">
                <label class="col-sm-7 col-form-label">Harga untuk hari Senin - Jumat</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control text-xs" name="harga1" min="0" value="<?php echo $count > 0 ? $harga[0] : 0; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-7 col-form-label">Harga untuk hari Sabtu dan Minggu</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control text-xs" name="harga2" min="0" value="<?php echo $count > 0 ? $harga[1] : 0; ?>">
                </div>
            </div>
            <button class="btn btn-primary text-xs float-right" onclick="simpan_harga()">Simpan</button>
        </div>
    </div>
</div>

<script>
    function simpan_harga() {
        $.ajax({
            url: base_url + 'back/harga/simpan_harga_event',
            type: 'POST',
            data: {
                csrf_name: csrf_hash,
                'harga1': $('input[name="harga1"]').val(),
                'harga2': $('input[name="harga2"]').val(),
            },
            dataType: 'JSON',
            success: function(data) {
                if (data.status == 1) {
                    toastr.success(data.message);
                    $(".modal .close").click();
                } else {
                    toastr.error(data.message);
                }
            }
        });
    }
</script>