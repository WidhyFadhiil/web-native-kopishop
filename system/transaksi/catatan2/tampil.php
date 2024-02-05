<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Transaksi</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" cellspacing="0" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Kode Penjualan</th>
                        <th class="text-center">Kode Barang</th>
                        <th class="text-center">Qty</th>
                        <th class="text-center">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = mysqli_query($koneksi, "SELECT * FROM detail_penjualan ORDER BY kode_detail_penjualan ASC");
                    foreach ($query as $data) :
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $no++ ?></td>
                            <td><?php echo $data['kode_penjualan'] ?></td>
                            <td><?php echo $data['kode_barang'] ?></td>
                            <td><?php echo $data['qty'] ?></td>
                            <td><?php echo $data['sub_total'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
