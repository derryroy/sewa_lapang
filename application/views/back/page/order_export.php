<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Order</title>

    <style>
        #order th {
            border-bottom: 2px solid;
        }

        #order td {
            border-bottom: 1px solid;
        }
    </style>
</head>

<body style="background:#FAFAFA;font-family:xbriyaz;font-size:13px;">
    <div style="padding-top:70px;">
        <h1 style="text-align:center;">LAPORAN KEUANGAN SEWA LAPANG</h1>
        <table id="order" style="border-collapse:collapse;width:100%;">
            <thead>
                <tr>
                    <th style="padding:5px;">NO</th>
                    <th style="padding:5px;">TGL ORDER</th>
                    <th style="padding:5px;">TGL BAYAR</th>
                    <th style="padding:5px;">STATUS</th>
                    <th style="padding:5px;">USER</th>
                    <th style="padding:5px;">WEB / MANUAL</th>
                    <th style="padding:5px;">PERIODE</th>
                    <th style="padding:5px;">SESI : JAM</th>
                    <th style="padding:5px;">HARGA</th>
                    <th style="padding:5px;">GRAND TOTAL</th>
                    <th style="padding:5px;">AKUMULASI</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $table; ?>
            </tbody>
        </table>
    </div>
    <div style="padding-top:30px;text-align:right;">
        <p>Penanggung Jawab</p>
        <p style="padding-top:30px;">...........................</p>
    </div>
</body>

</html>