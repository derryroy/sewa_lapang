<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification C-TRA ARENA</title>
</head>

<body style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;background:#FAFAFA;">
    <div style="width:400px;margin:auto;">
        <table style="margin:auto;width:100%;font-size:14px;" border="0">
            <tr>
                <td style="text-align:right;padding-top:30px;width:50%;"><img src="<?php echo base_url() . 'assets/front/img/logo.png'; ?>" width="60"></td>
                <td style="text-align:left;font-size:20px;font-weight:bold;align-items:center;padding-top:30px;width:50%;">ARENA</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center;padding-top:20px;font-size:24px;font-weight:bold;"><?php echo $data2['payment_status_desc']; ?></td>
            </tr>
            <tr>
                <td style="padding-top:30px;">ID Order</td>
                <th style="padding-top:30px;text-align:right;"><?php echo $data2['bill_no']; ?></th>
            </tr>
            <tr>
                <td>Metode Pembayaran</td>
                <th style="text-align:right;"><?php echo $data2['payment_channel']; ?></th>
            </tr>
            <tr>
                <td>Nomor Virtual Account</td>
                <th style="text-align:right;"><?php echo $data2['trx_id']; ?></th>
            </tr>
            <tr>
                <td>Status Pembayaran</td>
                <th style="text-align:right;"><?php echo $data2['payment_status_desc']; ?></th>
            </tr>
            <tr>
                <td>Nama / Nama Club</td>
                <th style="text-align:right;"><?php echo $data1['clubname']; ?></th>
            </tr>
            <tr>
                <td>Total Pembayaran</td>
                <th style="text-align:right;"><?php echo 'Rp ' . number_format($data2['bill_total'], 0, ',', '.'); ?></th>
            </tr>
            <tr>
                <td>Tanggal Order</td>
                <th style="text-align:right;"><?php echo $data1['date_add']; ?></th>
            </tr>
            <tr>
                <th style="text-align:center;">Whatsapp</th>
                <th style="text-align:center;">Email Kami</th>
            </tr>
            <tr>
                <td style="text-align:center;"><a href="https://wa.me/628122121668" target="_blank">08122121668</a></td>
                <td style="text-align:center;"><a href="mailto:cs@c-traarena.id">cs@c-traarena.id</a></td>
            </tr>
            <tr>
                <td colspan="2" style="padding:30px 0px 20px 0px;font-size:10px;">Email ini dibuat otomatis, mohon untuk tidak
                    membalas. <br> Terima kasih.</td>
            </tr>
        </table>
    </div>
</body>

</html>