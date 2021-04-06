<?php
//session_start();
if (!isset($_SESSION['apriori_parfum_id'])) {
    header("location:index.php?menu=forbidden");
}

include_once "database.php";
include_once "fungsi.php";
include_once "import/excel_reader2.php";
?>


<html lang="en">
 <?php include "header.php";?>
 <body class="nav-md">
  <?php include "menu.php";?>
  <?php include "navar.php";?>           
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Grafik Transaksi <small></small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-12 col-sm-12 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="clearfix"></div>
                    <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Menampilkan <small>Grafik Transaksi</small></h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                          </ul>
                          <div class="clearfix"></div>
                          </div>
                <div class="x_content">
                  <br />
        <!--UPLOAD EXCEL FORM-->
		<form method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left" action="">
			<div class="form-group">
                <label>Tanggal: </label>
                <div class="input-group">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
                </div>
                <input type="date" class="form-control" name="tanggal">
				<input type="submit" value="Tampilkan">
				</div><!-- /.input group -->
            </div><!-- /.form group -->
			</br>
				</div>	
					<div style="width: 800px;margin: 0px auto;">
		<canvas id="mybarChart"></canvas

	<br/>
	<br/>
	<script>
		var ctx = document.getElementById("mybarChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: ["Teh", "Gula", "Roti", "Susu"],
				datasets: [{
					label: '',
					data: [
					<?php 
					if(isset($_GET['tanggal'])){
					$tgl = $_GET['tanggal'];
					$jumlah_teknik = mysqli_query($koneksi,"select * from transaksi where transaction_date='$tgl' and produk LIKE '%teh%'");
					echo mysqli_num_rows($jumlah_teknik);}
					
					?>, 
					
					<?php
					if(isset($_GET['tanggal'])){
					$tgl = $_GET['tanggal'];
					$jumlah_ekonomi = mysqli_query($koneksi,"select * from transaksi where transaction_date='$tgl' and produk LIKE '%gula%'");
					echo mysqli_num_rows($jumlah_ekonomi);}
					?>, 
					<?php 
					if(isset($_GET['tanggal'])){
					$tgl = $_GET['tanggal'];
					$jumlah_fisip = mysqli_query($koneksi,"select * from transaksi where transaction_date='$tgl' and produk LIKE '%Roti%'");
					echo mysqli_num_rows($jumlah_fisip);}
					?>, 
					<?php 
					if(isset($_GET['tanggal'])){
					$tgl = $_GET['tanggal'];
					$jumlah_pertanian = mysqli_query($koneksi,"select * from transaksi where transaction_date='$tgl' and produk LIKE '%susu%'");
					echo mysqli_num_rows($jumlah_pertanian);}
					?>
					],
					backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)'
					],
					borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)'
					],
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>



	
            </div>	
		
		</div>
        </div>
    </div>
</div>

            
    </div>
	</div>
    </div>
	</div>
</div>
<?php include "footer.php";?>
</body>
</html>




<?php
function get_produk_to_in($produk){
    $ex = explode(",", $produk);
    //$temp = "";
    for ($i=0; $i < count($ex); $i++) { 

        $jml_key = array_keys($ex, $ex[$i]);
        if(count($jml_key)>1){
            unset($ex[$i]);
        }

        //$temp = $ex[$i];
    }
    return implode(",", $ex);
}

?>
  