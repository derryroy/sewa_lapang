<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation C-TRA ARENA</title>
</head>

<body style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;background:#FAFAFA;">
    <div style="width:400px;margin:auto;">
        <table style="margin:auto;width:100%;font-size:14px;" border="0">
            <tr>
                <td style="text-align:right;padding-top:30px;"><img src="<?php echo base_url() . 'assets/front/img/logo.png'; ?>" width="60"></td>
                <td style="text-align:left;font-size:20px;font-weight:bold;align-items:center;padding-top:30px;">ARENA</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center;padding-top:20px;font-size:24px;font-weight:bold;">Menunggu Pembayaran</td>
            </tr>
            <tr>
                <th colspan="2" style="padding-top:30px;text-align:left;">Metode Pembayaran</th>
            </tr>
            <tr>
                <td colspan="2"><img src="<?php echo base_url() . 'assets/front/img/logo-permata.png'; ?>" width="100"></td>
            </tr>
            <tr>
                <td style="padding-top:30px;">Nomor Virtual Account</td>
                <th style="padding-top:30px;text-align:right;"><?php echo $trx_id; ?></th>
            </tr>
            <tr>
                <td>Merchant</td>
                <th style="text-align:right;">C-Tra Arena</th>
            </tr>
            <tr>
                <td>Total Pembayaran</td>
                <th style="text-align:right;"><?php echo $grand_total; ?></th>
            </tr>
            <tr>
                <td>Tanggal Kadaluarsa</td>
                <th style="text-align:right;"><?php echo $date_exp; ?></th>
            </tr>
            <tr>
                <td colspan="2" style="padding-top:40px;">Cara Pembayaran:</td>
            </tr>
            <tr>
                <td colspan="2">Pembayaran Melalui ATM Permata</td>
            </tr>
            <tr>
                <td colspan="2">
                    <ol style="margin-top:0px;">
                        <li>Masukkan PIN</li>
                        <li>Pilih menu TRANSAKSI LAINNYA</li>
                        <li>Pilih menu PEMBAYARAN</li>
                        <li>Pilih menu PEMBAYARAN LAINNYA</li>
                        <li>Pilih VIRTUAL ACCOUNT</li>
                        <li>Masukkan NOMOR VIRTUAL ACCOUNT (Contoh: <?php echo $trx_id; ?>)</li>
                        <li>Jumlah yang harus dibayar dan nomor rekening akan muncul pada halaman konfirmasi pembayaran. Jika informasi sudah benar, pilih BENAR</li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td colspan="2">Pembayaran Melalui ATM Prima</td>
            </tr>
            <tr>
                <td colspan="2">
                    <ol style="margin-top:0px;">
                        <li>Masukkan PIN</li>
                        <li>Pilih menu TRANSFER</li>
                        <li>Pilih menu TRANSFER KE BANK LAIN</li>
                        <li>Masukkan KODE PermataBank (013) lalu tekan BENAR</li>
                        <li>Masukkan NOMOR VIRTUAL ACCOUNT (Contoh: <?php echo $trx_id; ?>)</li>
                        <li>Halaman konfirmasi pembayaran akan muncul. Jika informasi sudah benar, pilih BENAR
                            <ul>
                                <li>Note: Jika jumlah nominal tidak sesuai dengan tagihan akan menyebabkan transaksi gagal.</li>
                            </ul>
                        </li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td colspan="2">Pembayaran Melalui ATM Bersama</td>
            </tr>
            <tr>
                <td colspan="2">
                    <ol style="margin-top:0px;">
                        <li>Masukkan PIN</li>
                        <li>Pilih menu TRANSFER</li>
                        <li>Pilih menu TRANSFER KE BANK LAIN</li>
                        <li>Masukkan KODE PermataBank (013) + masukkan NOMOR VIRTUAL ACCOUNT (Contoh: 013<?php echo $trx_id; ?>)</li>
                        <li>Halaman konfirmasi pembayaran akan muncul. Jika informasi sudah benar, pilih BENAR
                            <ul>
                                <li>Note: Jika jumlah nominal tidak sesuai dengan tagihan akan menyebabkan transaksi gagal.</li>
                            </ul>
                        </li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td colspan="2">Pembayaran Melalui Permata Mobile</td>
            </tr>
            <tr>
                <td colspan="2">
                    <ol style="margin-top:0px;">
                        <li>Buka aplikasi PERMATAMOBILE</li>
                        <li>Masukkan USER ID & PASSWORD</li>
                        <li>Pilih BAYAR TAGIHAN</li>
                        <li>Pilih VIRTUAL ACCOUNT</li>
                        <li>Masukkan NOMOR VIRTUAL ACCOUNT (Contoh: <?php echo $trx_id; ?>)</li>
                        <li>Pilih REKENING</li>
                        <li>Masukkan NOMINAL PEMBAYARAN</li>
                        <li>Muncul konfirmasi pembayaran</li>
                        <li>Masukkan OTENTIKASI TRANSAKSI (TOKEN)</li>
                        <li>Transaksi Selesai</li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td colspan="2">Pembayaran Melalui Permata Net</td>
            </tr>
            <tr>
                <td colspan="2">
                    <ol style="margin-top:0px;">
                        <li>Buka website PermataNet : https://new.permatanet.com</li>
                        <li>Masukan USER ID & PASSWORD</li>
                        <li>Masukan KODE KEAMANAN (CAPTCHA)</li>
                        <li>Pilih PEMBAYARAN TAGIHAN</li>
                        <li>Pilih VIRTUAL ACCOUNT</li>
                        <li>Pilih REKENING</li>
                        <li>Masukkan NOMOR VIRTUAL ACCOUNT (Contoh: <?php echo $trx_id; ?>)</li>
                        <li>Masukkan NOMINAL PEMBAYARAN</li>
                        <li>Muncul KONFIRMASI PEMBAYARAN</li>
                        <li>Masukan OTENTIKASI TRANSAKSI (TOKEN)</li>
                        <li>Transaksi selesai</li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td colspan="2">Pembayaran Melalui BCA Mobile</td>
            </tr>
            <tr>
                <td colspan="2">
                    <ol style="margin-top:0px;">
                    <li>Daftar transfer antar bank</li>
                    <li>Isi nomor rekening bank (Contoh: <?php echo $trx_id; ?>)</li>
                    <li>Pilih bank lalu kirim</li>
                    <li>Pilih transfer antar bank</li>
                    <li>Pilih bank</li>
                    <li>Pilih nomor rekening tujuan</li>
                    <li>Isi jumlah nominal sesuai tagihan</li>
                    <li>Pilih layanan transfer</li>
                    <li>Bayar</li>
                    <li>Transaksi selesai</li>
                    </ol>
                </td>
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