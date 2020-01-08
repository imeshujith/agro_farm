<?php
/**
 * Created by PhpStorm.
 * User: Rebecca
 * Date: 7/17/2019
 * Time: 8:27 PM
 */

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>CM Distribution Management System</title>
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!--  Login css  -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/login.css">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
</head>
<body>
<section id="login">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 login-box">
				<div class="col-md-6 col-md-offset-3 col-sm-12 logo">
					<img src="<?php echo base_url() ?>assets/images/logo.png" class="img-responsive"/>
				</div>
				<div class="col-md-12">
					<hr/>
				</div>
				<form role="form" action="<?php echo base_url('login/confirm_signup'); ?>" method="post"
					  id="signup_form">
					<div class="form-group">
						<label class="sr-only">Email</label>
						<input type="email" name="email" value="<?php echo $email; ?>" class="form-control"
							   placeholder="Email" readonly>
					</div>
					<div class="form-group">
						<label class="sr-only">Password</label>
						<input type="password" name="password" class="form-control"
							   placeholder="Password">
					</div>
					<div class="form-group">
						<label class="sr-only">Re-Type Password</label>
						<input type="password" name="retype_password" class="form-control"
							   placeholder="Re-Type Password">
					</div>
					<div class="form-group">
						<label class="sr-only">OTP Code</label>
						<input type="text" name="otp" class="form-control"
							   placeholder="OTP Code">
					</div>
					<input type="submit" class="btn btn-custom btn-lg btn-block" value="Sing Up">
				</form>
				<footer id="footer">
					<p>Powered by <a href="#">AgroFarm</a> <br/> © - <?php echo date('Y'); ?></p>
				</footer>
				<hr/>
			</div>
		</div>
	</div>
</section>
<!-- jQuery 3 -->
<script src="<?php echo base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Custom JS -->
<script src="<?php echo base_url() ?>assets/js/custom.js"></script>
</body>
</html>


