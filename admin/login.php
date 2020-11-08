<!DOCTYPE html>
<?php
	session_start();
	include_once('server.php');
  
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
    <meta name="google-signin-client_id" content="752846571001-b3es2ohl10jjgasnmomp9esdon720qlt.apps.googleusercontent.com">
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://apis.google.com/js/platform.js?onload=bindGpLoginBtn" async defer></script>
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/css.css" rel="stylesheet">

    <title>ล็อคอิน</title>
    
</head>
<body class="bg-gradient-primary">

<?php if (isset($_SESSION['error'])) : ?>
						<div class="error">
							<h3>
								<?php
									echo $_SESSION['error'];
									unset($_SESSION['error']);
								?><?php endif ?>
                        </div>



    
                        
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-5">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-3 d-none d-lg-block" >
                  <div class="header">
                        
                  </div>
              </div>
              <div class="col-lg-6">
                <div class="p-6">
                  <div class="text-center">
                  <img src="img/lg_rmutsb.ac.th2.png">
                  <br><br><br>
                    <h1 class="h4 text-gray-900 mb-1"><b>มหาวิทยาลัยเทคโนโลยีราชมงคลสุวรรณภูมิ</b></h1>
                    <span>Rajamangala University of Technology Suvarnabumi</span> <br><br>
                  </div>
                  
             <form action="login_db.php" method="POST">  
                  <form class="user">
                   
                  <form class="user">
                    <div class="form-group">

                    <div class="form-group">
                    <div class="text-center">
                    <label for="exampleInputEmail1">กรุณากรอก Email</label></div>
                      <input type="email" class="form-control form-control-user" name="rusmail" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="example@rmutsb.ac.th" required="required">
                    </div></div>
                    <hr>
                    <div class="form-group">
                    <div class="text-center">
                    <label for="exampleInputPassword">กรุณากรอก Password</label></div>                               
                      <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="password..." required="required">
                    </div>
                    <hr>
                    <div class="form-group">
                    <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-outline-success">ยืนยัน</button>
                    </div>
                    </div>
                  </form>
                
                  
                  <div class="text-center">
                    <a class="small" href="forgot-password.html"></a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="register.html"></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>


  
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>
</html>