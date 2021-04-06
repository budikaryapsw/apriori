<?php
//session_start();
if (!isset($_SESSION['apriori_parfum_id'])) {
    header("location:index.php?menu=forbidden");
}

include_once "database.php";
include_once "fungsi.php";
include_once "mining.php";
?>
<?php include "header.php";?>
 <body class="nav-md">
  <?php include "menu.php";?>
  <?php include "navar.php";?> 
   <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Hasil - Algoritma Apriori <small></small></h3>
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
                        <h2>Data mining <small>Apriori</small></h2>
                          <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                          </ul>
                          <div class="clearfix"></div>
                          </div>
                <div class="x_content">
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

$sql = "SELECT
        *
        FROM
         process_log ";
$query=$db_object->db_query($sql);
$jumlah=$db_object->db_num_rows($query);
?>

<div class="row">
    <div class="col-sm-12">
        <div class="widget-box">
            <div class="widget-body">
                <div class="widget-main">
<!--            <form method="post" action="">
                <div class="form-group">
                    <input name="submit" type="submit" value="Proses" class="btn btn-success">
                </div>
            </form>-->

            <?php
            if (!empty($pesan_error)) {
                display_error($pesan_error);
            }
            if (!empty($pesan_success)) {
                display_success($pesan_success);
            }


            //echo "Jumlah data: ".$jumlah."<br>";
            if($jumlah==0){
                    echo "Data kosong...";
            }
            else{
            ?>
            <table class='table table-bordered table-striped  table-hover'>
                <tr>
                <th>No</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Min Support</th>
                <th>Min Confidence</th>
                <th></th>
                <th>Pdf</th>
                </tr>
                <?php
                    $no=1;
                    while($row=$db_object->db_fetch_array($query)){
//                        if($no==1){
//                            echo "Min support: ".$row['min_support'];
//                            echo "<br>";
//                            echo "Min confidence: ".$row['min_confidence'];
//                        }
//                        $kom1 = explode(" , ",$row['kombinasi1']);
//                        $jika = implode(" Dan ", $kom1);
//                        $kom2 = explode(" , ",$row['kombinasi2']);
//                        $maka = implode(" Dan ", $kom2);
                            echo "<tr>";
                            echo "<td>".$no."</td>";
                            echo "<td>".format_date2($row['start_date'])."</td>";
                            echo "<td>".format_date2($row['end_date'])."</td>";
                            echo "<td>".$row['min_support']."</td>";
                            echo "<td>".$row['min_confidence']."</td>";
                            $view = "<a href='index.php?menu=view_rule&id_process=".$row['id']."'>View rule</a>";
                            echo "<td>".$view."</td>";
                            echo "<td>";
                            echo "<a href='export/CLP.php?id_process=".$row['id']."' "
                                    . "class='btn btn-app btn-light btn-xs' target='blank'>
                                    <i class='ace-icon fa fa-print bigger-160'></i>
                                    Print
                                </a>";
                            echo "</td>";
//                            echo "<td>Jika ".$jika.", Maka ".$maka."</td>";
//                            echo "<td>".price_format($row['confidence'])."</td>";
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
</div></div>
</div>
</div>
</div>
</div>
<?php include "footer.php";?>
</body>
</html>
