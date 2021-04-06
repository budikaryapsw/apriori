<?php
//session_start();
if (!isset($_SESSION['apriori_parfum_id'])) {
    header("location:index.php?menu=forbidden");
}

include_once "database.php";
include_once "fungsi.php";
include_once "import/excel_reader2.php";
?>

<?php
//object database class
$db_object = new database();

$pesan_error = $pesan_success = "";


if(isset($_GET['pesan_error'])){
    $pesan_error = $_GET['pesan_error'];
}
if(isset($_GET['pesan_success'])){
    $pesan_success = $_GET['pesan_success'];
}

if(isset($_POST['submit'])){
    // if(!$input_error){
    $data = new Spreadsheet_Excel_Reader($_FILES['file_data_transaksi']['tmp_name']);
      // var_dump(ASU);die();
        $baris = $data->rowcount($sheet_index=0);
        $column = $data->colcount($sheet_index=0);
        var_dump($baris."-".$column);
        die();
        //import data excel dari baris kedua, karena baris pertama adalah nama kolom
        // $temp_date = $temp_produk = "";
        for ($i=2; $i<=$baris; $i++) {
            for($c=1; $c<=$column; $c++){
                $value[$c] = $data->val($i, $c);
            }

            // if($i==2){
            //     $temp_produk .= $value[3];
            // }
            // else{
            //     if($temp_date == $value[1]){
            //         $temp_produk .= ",".$value[3];
            //     }
            //     else{
                    $table = "transaksi";
                    // $produkIn = get_produk_to_in($temp_produk);
                    $temp_date = format_date($value[1]);
                    $produkIn = $value[2];
                    
                    //mencegah ada jarak spasi
                    $produkIn = str_replace(" ,", ",", $produkIn);
                    $produkIn = str_replace("  ,", ",", $produkIn);
                    $produkIn = str_replace("   ,", ",", $produkIn);
                    $produkIn = str_replace("    ,", ",", $produkIn);
                    $produkIn = str_replace(", ", ",", $produkIn);
                    $produkIn = str_replace(",  ", ",", $produkIn);
                    $produkIn = str_replace(",   ", ",", $produkIn);
                    $produkIn = str_replace(",    ", ",", $produkIn);
                    //$item1 = explode(",", $produkIn);
                    
                    
//                    $field_value = array("transaction_date"=>($temp_date),
//                        "produk"=>$produkIn);
//                    $query = $db_object->insert_record($table, $field_value);
//                    INSERT INTO transaksi (transaction_date, produk)
//                    VALUES
//                    ('2016-06-01', 'nipple pigeon L'),
//                    ('2016-06-01', 'nipple ninio'),
//                    ('2016-06-01', 'mamamia L36'),
//                    ('2016-06-01', 'sweety FP XL34')
                    $sql = "INSERT INTO transaksi (transaction_date, produk) VALUES ";
                    $value_in = array();
                    //foreach ($item1 as $key => $isi) {
                      //  $value_in[] = "('$temp_date' , '$isi' )";
                    //}
                    //$value_to_sql_in = implode(",", $value_in);
                    //$sql .= $value_to_sql_in;
                    $sql .= " ('$temp_date', '$produkIn')";
                    $db_object->db_query($sql);

            //         $temp_produk = $value[3];
            //     }
            // }
            
            // $temp_date = $value[1];
        }
        ?>
        <script> location.replace("?menu=data_transaksi&pesan_success=Data berhasil disimpan"); </script>
        <?php
}

if(isset($_POST['delete'])){
    $sql = "TRUNCATE transaksi";
    $db_object->db_query($sql);
    ?>
        <script> location.replace("?menu=data_transaksi&pesan_success=Data transaksi berhasil dihapus"); </script>
        <?php
}

$sql = "SELECT
        *
        FROM
         transaksi";
$query=$db_object->db_query($sql);
$jumlah=$db_object->db_num_rows($query);
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
                <h3>Data Transaksi <small></small></h3>
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
                        <h2>Upload <small>Data Transaksi</small></h2>
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
			<div class="item form-group">
                      <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">File Data Transaksi <span class="required"></span>
                      </label>
                      <div class="col-md-6 col-sm-6 ">
                        <input type="file" id="id-input-file-2" required="required" name="file_data_transaksi" class="form-control ">
                      </div>
            
                        
                    </div>
					<div class="ln_solid"></div>
                    <div class="item form-group">
                      <div class="col-md-6 col-sm-6 offset-md-3">
						<button name="submit" type="submit" value="" class="btn btn-app btn-purple btn-sm">
						<i class="ace-icon fa fa-cloud-upload bigger-200"></i> Upload</button>
                        <button name="delete" type="submit" value="" class="btn btn-app btn-danger btn-sm" 
                                onclick="return confirm('Are you sure?')" >
                            <i class="ace-icon fa fa-trash-o bigger-200"></i> Delete </button>
                      </div>
                    </div>
					
            </div>
        </form>
        </div>
    </div>
</div>

            <br/>
                    <br/>
					<div class="x_panel">
                      <div class="x_title">
                    <h2>Data Transaksi</h2> 
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <div class="row">
                    <div class="col-sm-12">
                    <div class="card-box table-responsive">
					
					<?php
					if (!empty($pesan_error)) {
						display_error($pesan_error);
					}
					if (!empty($pesan_success)) {
						display_success($pesan_success);
					}

					echo "Jumlah data: ".$jumlah."<br>";
					if($jumlah==0){
						echo "Data kosong...";
					}
					else{
					?>
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
				<thead>
                <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Produk</th>
                </tr>
				</thead>
                <?php
                    $no=1;
                    while($row=$db_object->db_fetch_array($query)){
                        echo "<tr>";
                            echo "<td>".$no."</td>";
                            echo "<td>".format_date2($row['transaction_date'])."</td>";
                            echo "<td>".$row['produk']."</td>";
                        echo "</tr>";
                        $no++;
                    }
                    ?>
            </table>
            <?php
            }
            ?>
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
  