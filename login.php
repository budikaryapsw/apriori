<?php
session_start();

if ( isset($_SESSION['apriori_parfum_id']) ) {
    header("location:index.php");
}

$login = 0;
if (isset($_GET['login'])) {
    $login = $_GET['login'];
}

if ($login == 1) {
    $komen = "Silahkan Login Ulang, Cek username dan Password Anda!!";
}

include_once "fungsi.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Data Mining | Apriori </title>

    <!-- Bootstrap -->
    <link href="assets/template/back/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="assets/template/back/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="assets/template/back/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="assets/template/back/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="assets/template/back/build/css/custom.min.css" rel="stylesheet">
    <style>
      body{
        background-image: url("assets/template/back/production/images/SelamaDatang.jpg");
      }
    </style>
  </head>
  
  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
	  <script type="text/javascript">
                try {
                    ace.settings.loadState('main-container')
                } catch (e) {
                }
       </script>
	   <h1 align="center"><i class="fa fa-cubes"></i> Penerapan Algoritma Data Mining</h1>
	   <h2 align="center">Market Basket Analysis 212 Mart - Kedaton </h2>
      <div class="login_wrapper">
        <div class="animate form login_form">
			<?php
                if (isset($komen)) {
                    display_error("Login failed");
                }
            ?>
          <section class="login_content">
			
            <form action="cek-login.php" method="post">
			  <h1>Login Form</h1>
			  <div>
                <input type="text" class="form-control" placeholder="Username" required="" name="username" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="password" />
              </div>
              
              <br/>
              <div>
                <button class="btn btn-round btn-success btn-lg" type="submit">Login</button>
                <button class="btn btn-round btn-primary btn-lg" type="reset">Reset</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div>
                  
                  <p>©2021 Copyright 212 Mart Kedaton</p>
                </div>
              </div>
            </form>
          </section>
        </div>

       
      </div>
    </div>
  </body>
</html>


        <script type="text/javascript">
                if ('ontouchstart' in document.documentElement)
                    document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
        </script>
        
        
    </body>
</html>


