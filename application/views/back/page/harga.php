<?php $count = count($harga); ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manage Harga</h1>
</div>

<!-- DataTales -->
<div class="card shadow mb-4">
    <div class="card-header py-3"></div>
    <div class="card-body row">
        <div class="col-sm-6" style="font-size:14px;">
            <div class="form-group row">
                <label class="col-sm-7 col-form-label">Harga untuk hari Senin - Jumat pada sesi 1 - sesi 4</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control text-xs" name="harga1" min="0" value="<?php echo $count > 0 ? $harga[0] : 0; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-7 col-form-label">Harga untuk hari Senin - Jumat pada sesi 5 - sesi 6</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control text-xs" name="harga2" min="0" value="<?php echo $count > 0 ? $harga[1] : 0; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-7 col-form-label">Harga untuk hari Senin - Jumat pada sesi 7 - sesi 8</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control text-xs" name="harga3" min="0" value="<?php echo $count > 0 ? $harga[2] : 0; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-7 col-form-label">Harga untuk hari Sabtu dan Minggu sesi 1 - sesi 8</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control text-xs" name="harga4" min="0" value="<?php echo $count > 0 ? $harga[3] : 0; ?>">
                </div>
            </div>
            <button class="btn btn-primary text-xs float-right" onclick="simpan_harga()">Simpan</button>
        </div>
        <div class="col-sm-6" style="font-size:14px;">
            <h5>Pengatuaran Sesi :</h5>
            <table>
                <tr>
                    <td style="padding:5px;">Sesi 1</td>
                    <td style="padding:5px;">:</td>
                    <td style="padding:5px;">06.00 - 08.00</td>
                    <td style="padding:5px 5px 5px 50px;">Sesi 5</td>
                    <td style="padding:5px;">:</td>
                    <td style="padding:5px;">14.00 - 16.00</td>
                </tr>
                <tr>
                    <td style="padding:5px;">Sesi 2</td>
                    <td style="padding:5px;">:</td>
                    <td style="padding:5px;">08.00 - 10.00</td>
                    <td style="padding:5px 5px 5px 50px;">Sesi 6</td>
                    <td style="padding:5px;">:</td>
                    <td style="padding:5px;">16.00 - 18.00</td>
                </tr>
                <tr>
                    <td style="padding:5px;">Sesi 3</td>
                    <td style="padding:5px;">:</td>
                    <td style="padding:5px;">10.00 - 12.00</td>
                    <td style="padding:5px 5px 5px 50px;">Sesi 7</td>
                    <td style="padding:5px;">:</td>
                    <td style="padding:5px;">18.00 - 20.00</td>
                </tr>
                <tr>
                    <td style="padding:5px;">Sesi 4</td>
                    <td style="padding:5px;">:</td>
                    <td style="padding:5px;">12.00 - 14.00</td>
                    <td style="padding:5px 5px 5px 50px;">Sesi 8</td>
                    <td style="padding:5px;">:</td>
                    <td style="padding:5px;">20.00 - 22.00</td>
                </tr>
            </table>
        </div>
    </div>
</div>

<script>
    function simpan_harga() {
        $.ajax({
            url: base_url + 'back/harga/simpan_harga',
            type: 'POST',
            data: {
                csrf_name: csrf_hash,
                'harga1': $('input[name="harga1"]').val(),
                'harga2': $('input[name="harga2"]').val(),
                'harga3': $('input[name="harga3"]').val(),
                'harga4': $('input[name="harga4"]').val(),
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