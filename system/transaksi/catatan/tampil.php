<nav style="background-color:#0dcaf0" class="navbar navbar-expand-lg navbar-light">
    <img src="logokopi.png" width="100px" height="100px">
    <a class="navbar-brand" style="color:white" href="?halaman=kasir">The Gymbo Resto</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto mr-2">
            <li class="nav-item">
                <a class="nav-link" href="#" role="button" aria-haspopup="true" aria-expanded="false" style="color:white">
                    <span style="color:white"><?php echo $_SESSION['nama_user'] ?></span>
                </a>
                <div class="dropdown-menu" style="min-width:5em;" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

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
