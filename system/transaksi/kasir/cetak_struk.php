<?php 
include "../../../koneksi/koneksi.php";
include "../../../koneksi/function.php";

// Use CSS to improve the styling
$css = '
<style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
    }
    h3, h5 {
        margin: 0;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid black;
    }
    th, td {
        padding: 8px;
        text-align: left;
    }
    .total, .bayar, .kembalian {
        font-weight: bold;
    }
    .center {
        text-align: center;
    }
    .footer {
        text-align: center;
        margin-top: 20px;
    }
</style>
';

$html = $css;
$html .= '
<div>
    <div class="center">
        <h3>The Gymbo Caffe</h3>
        <h5>Jln pemuda ngabang, Landak</h5>
        <hr>
    </div>
    <table>
        <tbody>';
            $grand_total = 0;
            $bayar = 0;
            $kembalian = 0;
            $id = $_GET['cetak'];
            $query = mysqli_query($koneksi, "SELECT * FROM detail_penjualan JOIN barang using(kode_barang) WHERE kode_penjualan='$id'");
            $query2 = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE kode_penjualan='$id'");
            foreach ($query2 as $data2) {
                $bayar = $data2['total_bayar'];
                $kembalian = $data2['kembalian'];
            }

            foreach ($query as $data) :
                $grand_total += $data['sub_total'];
                $html.='
                    <tr>
                        <td>'.$data['nama_barang'].'</td>
                        <td style="text-align:right">'. rupiah($data['harga_jual']) .'</td>
                        <td style="text-align:right">'.$data['qty'].'x</td>
                        <td style="text-align:right">'.rupiah($data['sub_total']).'</td>
                    </tr>';
            endforeach;
            $html.='
        </tbody>
    </table>
    <hr>
    <table>
        <tbody>
            <tr class="total">
                <td style="text-align:right">Total</td>
                <td style="text-align:right">'. rupiah($grand_total) .'</td>
            </tr>
            <tr class="bayar">
                <td style="text-align:right">Bayar</td>
                <td style="text-align:right">'. rupiah($bayar) .'</td>
            </tr>
            <tr class="kembalian">
                <td style="text-align:right">Kembalian</td>
                <td style="text-align:right">'. rupiah($kembalian) .'</td>
            </tr>
        </tbody>
    </table>
    <div class="footer">
        <h6>Terima Kasih Atas Kunjungan anda</h6>
    </div>
</div>';

$filename = "Struk";

require_once '../../../assets/library/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream($filename, array("Attachment" => 0));
?>
