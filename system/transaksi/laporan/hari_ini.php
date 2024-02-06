<?php
require_once '../../../koneksi/koneksi.php';
require_once '../../../koneksi/function.php';
require_once '../../../assets/library/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$tgl = tgl_indo(date('Y-m-d'));
$tgl_judul = date('d-m-Y');
$filename = "Laporan_" . $tgl_judul;
$grand_total = 0;

// Menyiapkan query untuk mengambil data
$query_hari = mysqli_query($koneksi, "SELECT * FROM penjualan JOIN user USING(kode_user) WHERE DATE(tanggal_penjualan) = CURDATE() ORDER BY kode_penjualan DESC");

// Membuat HTML dengan styling CSS
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; text-align: left; }
        th p { font-size: 20px; }
    </style>
</head>
<body>
    <h2>Laporan Penjualan Tanggal '.$tgl.'</h2>
    <table>
        <thead>
            <tr>
                <th>Kode Penjualan</th>
                <th>Tanggal</th>
                <th>Yang Melayani</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>';

foreach ($query_hari as $data_hari) {
    $grand_total += $data_hari['total_harga'];
    $html .= '
            <tr>
                <td>' . $data_hari['kode_penjualan'] . '</td>
                <td>' . tgl_indo($data_hari['tanggal_penjualan']) . '</td>
                <td>' . $data_hari['nama_user'] . '</td>
                <td style="text-align:right">' . rupiah($data_hari['total_harga']) . '</td>
            </tr>';
}

$html .= '
            <tr>
                <td colspan="3" style="text-align:right"><strong>Grand Total</strong></td>
                <td style="text-align:right">' . rupiah($grand_total) . '</td>
            </tr>
        </tbody>
    </table>
</body>
</html>';

// Menginstansiasi dan menggunakan kelas dompdf
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream($filename, array("Attachment" => 0));
?>
