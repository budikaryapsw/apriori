<?php
$menu_active = '';
if (isset($_GET['menu'])) {
    $menu_active = $_GET['menu'];
}
?>

<div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a class="site_title"><i class="fa fa-database"></i> <span>Data Mining</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="assets/template/back/production/images/user.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Selamat Datang</span>
                <h2>Admin</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />
    <script type="text/javascript">
        try {
            ace.settings.loadState('sidebar')
        } catch (e) {
        }
    </script>
	<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
    <ul class="nav side-menu">
        <li <?php echo ($menu_active == '') ? "class='active'" : ""; ?> >
            <a href="index.php">
                <i class="menu-icon fa fa-home"></i>
                <span class="menu-text"> Halaman Utama </span>
            </a>
            <b class="arrow"></b>
        </li>
        <?php if($_SESSION['apriori_parfum_level']==1){?>
        <li <?php echo ($menu_active == 'data_transaksi') ? "class='active'" : ""; ?> >
            <a href="index.php?menu=data_transaksi">
                <i class="menu-icon fa fa-table"></i>
                <span class="menu-text"> Data Transaksi </span>
            </a>
            <b class="arrow"></b>
        </li>
		<?php }?>
		<li <?php echo ($menu_active == 'grafik_transaksi') ? "class='active'" : ""; ?> >
            <a href="index.php?menu=grafik_transaksi">
                <i class="menu-icon fa fa-bar-chart"></i>
                <span class="menu-text"> Grafik Transaksi </span>
            </a>
            <b class="arrow"></b>
        </li>
		<?php if($_SESSION['apriori_parfum_level']==1){?>
		<li <?php echo ($menu_active == 'proses_apriori') ? "class='active'" : ""; ?>  >
            <a href="index.php?menu=proses_apriori">
                <i class="menu-icon fa fa-bolt"></i>
                <span class="menu-text"> Proses Apriori </span>
            </a>
            <b class="arrow"></b>
        </li>
        <?php }?>
        <li <?php echo ($menu_active == 'hasil') ? "class='active'" : ""; ?>  >
            <a href="index.php?menu=hasil">
                <i class="menu-icon fa fa-book"></i>
                <span class="menu-text"> Hasil </span>
            </a>
            <b class="arrow"></b>
        </li>


        <li class="">
            <a href="logout.php">
                <!--<i class="menu-icon fa fa-tachometer"></i>-->
                <i class="menu-icon glyphicon glyphicon-off"></i>
                <span class="menu-text"> Logout </span>
            </a>
            <b class="arrow"></b>
        </li>
    </ul><!-- /.nav-list -->
	</div>
	</div>
</div>