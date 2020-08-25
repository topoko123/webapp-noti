<!DOCTYPE html>
<?php
	session_start();
	include('server.php');
	
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel = "stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel = "stylesheet" type = "text/css" href = "login.css" >
	<title>Login</title>
	

</head>
<body>

	
	
	<!-------------NavBar---------------->
	
	<!-------------NavBar---------------->
	<?php if (isset($_SESSION['error'])) : ?>
						<div class="error">
							<h3>
								<?php
									echo $_SESSION['error'];
									unset($_SESSION['error']);
								?><?php endif ?>
						</div>
<!--------------formlogin--------------->
	<div class="text-center">
	<!-- Button HTML (to Trigger Modal) -->
		<a href="#myModal" class="trigger-btn" data-toggle="modal">Click to Open Login Modal</a>
	</div>

<!-- Modal HTML -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<div class="modal-header">
				<div class="avatar">
					<!-- <img src="/examples/images/avatar.png" alt="Avatar"> -->
				</div>				
				<h4 class="modal-title">Member Login</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<form action="login_db.php" method="post">
					
						<div class="form-group">
							<input type="text" class="form-control" name="rusmail" placeholder="example@rmutsb.ac.th" required="required">		
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password" placeholder="Password" required="required">	
						</div>        
						<div class="form-group">
							<button type="submit" name="submit" class="btn btn-primary btn-lg btn-block login-btn">Login</button>
						</div>
				</form>
			</div>
			<div class="modal-footer">
				<a href="#">Forgot Password?</a>
			</div>
		</div>
	</div>
  </div>     
      <!--------------formlogin---------->



	<!-------------script---------------->
		<script src="node_modules/jquery/dist/jquery.min.js"></script>
		<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
	<!-------------script---------------->
</body>
</html>