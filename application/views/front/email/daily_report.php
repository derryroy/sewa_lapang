<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Report Booking Cour</title>
</head>

<body>
    <table border="1" style="border-collapse:collapse;font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">
        <tr>
            <th colspan="2" style="text-align:center;padding:10px;"><?php echo 'Jadwal booking lapangan <br>' . $date; ?></th>
        </tr>
        <tr>
            <th style="text-align:center;padding:10px;">Sesi</th>
            <th style="text-align:center;padding:10px;">Nama Klub</th>
        </tr>
        <?php foreach ($data as $row) { ?>
            <tr>
                <td style="padding:10px;"><?php echo 'Sesi ' . $row['sesi'] . ' : ' . $row['jam']; ?></td>
                <td style="padding:10px;"><?php echo $row['nama']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>