<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Log Aktivitas</h6>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" cellspacing="0" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Kode User</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Akses</th>
                        <th class="text-center">No Hp</th>
                        <th class="text-center">Keterangan</th>
                        <th class="text-center">Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = mysqli_query($koneksi, "SELECT * FROM log_aktifitas ORDER BY id_log_aktifitas ASC");
                    foreach ($query as $data) :
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $no++ ?></td>
                            <td><?php echo $data['kode_user'] ?></td>
                            <td><?php echo $data['nama_user'] ?></td>
                            <td><?php echo $data['akses'] ?></td>
                            <td><?php echo $data['no_hp'] ?></td>
                            <td><?php echo $data['keterangan'] ?></td>
                            <td><?php echo $data['date_time'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
