<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
		<img src="logokopi.png" width="100px" height="100px">
		<div class="sidebar-brand-text mx-3">the gymbo Caffe<sup></sup></div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">
		Data Master
	</div>

	<!-- Nav Item - Charts -->
	

	<li class="nav-item <?php if($_GET['halaman'] == "barang") {echo"active";} ?>">
		<a class="nav-link" href="?halaman=barang">
			<i class="fas fa-edit"></i>
			<span>Daftar Menu</span></a>
	</li>

	<li class="nav-item <?php if($_GET['halaman'] == "kategori_barang") {echo"active";} ?>">
		<a class="nav-link" href="?halaman=kategori_barang">
			<i class="fas fa-edit"></i>
			<span>Daftar Kategori Menu</span></a>
	</li>

	<li class="nav-item <?php if($_GET['halaman'] == "laporan") {echo"active";} ?>">
		<a class="nav-link" href="?halaman=laporan">
			<i class="fas fa-print"></i>
			<span>Laporan</span></a>
	</li>
	
	<li class="nav-item <?php if($_GET['halaman'] == "logaktifitas") {echo"active";} ?>">
		<a class="nav-link" href="?halaman=logaktifitas">
		<i class="fas fa-network-wired"></i>
			<span>Log Aktifitas</span></a>
	</li>

	<li class="nav-item <?php if($_GET['halaman'] == "catatan") {echo"active";} ?>">
		<a class="nav-link" href="?halaman=catatan">
		<i class="fas fa-print"></i>
			<span>Transaksi</span></a>
	</li>

	
	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block">

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>

</ul>