<?php
//session_start();
if (!isset($_SESSION['apriori_parfum_id'])) {
    header("location:index.php?menu=forbidden");
}

include_once "database.php";
include_once "fungsi.php";
include_once "mining.php";
include_once "import/excel_reader2.php";
?>
<?php
$db_object = new database();
// function get_produk_to_in($produk){
//     $ex = explode(",", $produk);
//     //$temp = "";
//     for ($i=0; $i < count($ex); $i++) { 

//         $jml_key = array_keys($ex, $ex[$i]);
//         if(count($jml_key)>1){
//             unset($ex[$i]);
//         }

//         //$temp = $ex[$i];
//     }
//     return implode(",", $ex);
// }
// if (isset($_POST['submit'])) {
// 	$can_process = true;
// 	if($can_processa){
// 		$tgl = $_POST['tanggal'];
// 		$hasil= mining_grafik($db_object,$tgl);
		
// 	}
// }
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
                <h3>Grafik Transaksi<small></small></h3>
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
					  <?php echo $hasil;?>
                        <h2>Menampilkan<small>Grafik Transaksi</small></h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                          </ul>
                          <div class="clearfix"></div>
                          </div>
                <div class="x_content">
                  <br />
        
		<form enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left" action="#">
			<div class="form-group">
                <label>Dari Tanggal: </label>
                <div class="input-group">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
                </div>
                <input type="date" id="tanggal" class="form-control" value="<?php echo $_POST['tanggal']; ?>" name="tanggal">
				
				
				</div>
            </div>
			<div class="form-group">
                <label>Hingga Tanggal: </label>
                <div class="input-group">
                <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
                </div>
                <input type="date" id="tanggal2" class="form-control" value="<?php echo $_POST['tanggal2']; ?>" name="tanggal2">
				
				<!-- <input type="submit" value="Tampilkan"> -->
				
				</div>
            </div>
			<div class="form-group">
			<a href="#" class="btn btn-primary" onclick="getData()">Tampilkan</a>
			</div>
		</form>
			</br>
				</div>	
					<div style="width: 800px;margin: 0px auto;" id="canvas_father">
						<canvas id="mybarCharta"></canvas>
            		</div>	
			<br/>
			<div id="palinglaku"></div>
			<div id="kuranglaku"></div>
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



<script>
	
	function endProp( mathFunc, array, property ) {
		return Math[ mathFunc ].apply(array, array.map(function ( item ) {
			return item[ property ];
		}));
	}

	function getData(){
		var dataPointsA = []
		
		
		var tgl = $('#tanggal').val();
		var tgl2 = $('#tanggal2').val();
		$.ajax({
			url: 'cek_grafik.php',
			data: 'tanggal='+tgl+'&tanggal2='+tgl2,
			type: 'POST',
			dataType: 'JSON',
			success: function(data){
				var hasil=data;
				console.log(hasil);
				// var nenen=Math.max.apply(Math, array.map(function(o) { return o.item; }));
				// var nenen =data.reduce((acc, shot) => acc = acc > shot.item ? acc : shot.item, 0);
				// var maxY = endProp( "max", hasil, "item" ); // 8.389
			
				var label = [];
				var value = [];
				var arr=[];
				var warna=[];
				const r = Math.round (Math.random () * 255);
				const g = Math.round (Math.random () * 255);
				const b = Math.round (Math.random () * 255);
				
				var warna1=[
					"#FF0000",//red
					"#FFD700",//gold
					"#7CFC00",//hijaumuda

					"#FF8C00",
					"#808000",//olive
					"#00FFFF",   //cyan

					"#008080",//teal
					"#0000FF"   ,//ungu
					"#FF00FF",//fuchsia

					"#000000",    //black     
					"#A52A2A",//brown
					"#2E8B57",
					"#00FF7F",//hijau biru

					"#FA8072",
					"#228B22",

					"#40E0D0",
					"#000080",
					"#FF00FF",

					"#2F4F4F",
					"#D2691E",
					"#B22222",
				];
				var lowest = Number.POSITIVE_INFINITY;
				var namelowest;
				var namehighest;
				var highest = Number.NEGATIVE_INFINITY;
				var tmp;
				for (var i in data) {
					label.push(data[i].item);
					value.push(data[i].jumlah);
					arr.push({item: data[i].item, jumlah: data[i].jumlah});
					tmp = data[i].jumlah;
					if (tmp < lowest) {lowest = tmp;namelowest=data[i].item};
					if (tmp > highest) {highest = tmp;namehighest=data[i].item};
					warna.push(dynamicColors());
				}
				
				
				
			 	var maxY = Math.max.apply(Math, arr.map(function(o) { return o.item; })); // 8.389
				// var maxY=return array_reduce($arr, function ($a, $b) {
				// 				return $a ? ($a['jumlah'] > $b['jumlah'] ? $a : $b) : $b;
				// 			});
				var minY = endProp( "min", arr, "item" );
				// var maxY =arr.reduce((acc, shot) => acc = acc > shot.item ? acc : shot.item, 0);
				console.log(namehighest);
				console.log(namelowest);
				// console.log(minY);
				document.getElementById("palinglaku").innerHTML = "Produk Paling Laku : "+namehighest;
				document.getElementById("kuranglaku").innerHTML = "Produk Kurang Laku : "+namelowest;
				$('#mybarCharta').remove();
				$('#canvas_father').append('<canvas id="mybarCharta"></canvas>');
				var ctx = document.getElementById('mybarCharta').getContext('2d');

				var chart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: label,
						datasets: [{
							label: 'Jumlah Produk',
							backgroundColor: warna,
							// borderColor: dynamicColors(),
							data: value
						}]
					},
					options: {
						indexAxis: 'y',
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero: true
								}
							}]
						}
					}
				});
				
			}
		});
		// console.log(tgl);
	}

	function getRandomColor() {
		var letters = '0123456789ABCDEF'.split('');
		var color = '#';
		for (var i = 0; i < 6; i++ ) {
			color += letters[Math.floor(Math.random() * 16)];
		}
		return color;
    }
	var dynamicColors = function() {
		var r = Math.floor(Math.random() * 255);
		var g = Math.floor(Math.random() * 255);
		var b = Math.floor(Math.random() * 255);
		return "rgb(" + r + "," + g + "," + b + ")";
	}
</script>

  
