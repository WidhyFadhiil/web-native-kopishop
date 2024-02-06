<?php
require_once '../../../koneksi/koneksi.php';
require_once '../../../koneksi/function.php';
require_once '../../../assets/library/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$tgl = date('F Y');
$tgl_judul = date('F-Y');
$filename = "Laporan_" . $tgl_judul;
$grand_total = 0;

// Menyiapkan query untuk mengambil data
$query_hari = mysqli_query($koneksi, "SELECT * FROM penjualan JOIN user USING(kode_user) WHERE MONTH(tanggal_penjualan) = MONTH(CURDATE()) AND YEAR(tanggal_penjualan) = YEAR(CURDATE()) ORDER BY kode_penjualan DESC");

// Membuat HTML dengan styling CSS
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        h2 { text-align: center; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <h2>Laporan Penjualan Bulan '.$tgl.'</h2>
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
                <td class="text-right">' . rupiah($data_hari['total_harga']) . '</td>
            </tr>';
}

$html .= '
            <tr>
                <td colspan="3" class="text-right"><strong>Grand Total</strong></td>
                <td class="text-right">' . rupiah($grand_total) . '</td>
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
