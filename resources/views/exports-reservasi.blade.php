<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    body {
        background-color: blue;
    }
</style>

<body>
    <center>
        <h3>Laporan Reservasi Wisma Malaqbi</h3>
        <h4>Tanggal : <?= date('Y:m:d') ?></h4>
    </center>

    <table style="width: 100%;">
        <thead>
            <tr>
                <th style="width:100px; font-size:11px; white-space:nowrap;">Kode Reservasi</th>
                <th style="width:100px; font-size:11px; white-space:nowrap;">nama</th>
                <th style="width:100px; font-size:11px; white-space:nowrap;">Nomor HP</th>
                <th style="width:100px; font-size:11px; white-space:nowrap;">Tanggal Check-IN</th>
                <th style="width:100px; font-size:11px; white-space:nowrap;">Tanggal Check-OUT</th>
                <th style="width:100px; font-size:11px; white-space:nowrap;">Jumlah Tamu</th>
                <th style="width:100px; font-size:11px; white-space:nowrap;">Total</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($kas as $item)
                <tr>
                    <td style="padding: 5px 6px; text-align:center;">{{ $item->kode_reservasi }}</td>
                    <td style="padding: 5px 6px; text-align:center;">{{ $item->nama }}</td>
                    <td style="padding: 5px 6px; text-align:center;">{{ $item->no_hp }}</td>
                    <td style="padding: 5px 6px; text-align:center;">{{ $item->tgl_masuk }}</td>
                    <td style="padding: 5px 6px; text-align:center;">{{ $item->tgl_keluar }}</td>
                    <td style="padding: 5px 6px; text-align:center;">{{ $item->jumlah_tamu }}</td>
                    <td style="padding: 5px 6px; text-align:center;">Rp.{{ number_format($item->sub_total, 0, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
