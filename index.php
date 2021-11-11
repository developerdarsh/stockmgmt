<?php
	include("connect.php");
	$db->rplocation(SITEURL.'manage-product/');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php include('include/css.php'); ?>
  </head>
  <body>
	<div class="container-scroller">
	  <div class="container-fluid page-body-wrapper full-page-wrapper">
		<div class="content-wrapper d-flex align-items-center auth">
		  <div class="row flex-grow">
			<div class="col-lg-4 mx-auto">
			  <div class="auth-form-light text-left p-5">
				<div class="brand-logo text-center">
				  <img src="<?php echo SITEURL; ?>images/logo.png" title="<?php echo SITETITLE;?>" alt="<?php echo SITETITLE;?>">
				</div>
				<h4>Login</h4>
				<h6 class="font-weight-light">Sign in to continue.</h6>
				<form class="pt-3" name="frm" id="frm" method="post" action="<?php echo SITEURL."process-login/"; ?>">
				  <div class="form-group">
					<input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="Email" maxlength="100">
				  </div>
				  <div class="form-group">
					<input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Password" maxlength="20">
				  </div>
				  <div class="mt-3">
					<button class="btn btn-block btn-gradient-info btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
				  </div>
				  <div class="text-center mt-4 font-weight-light">
					<a href="<?php echo SITEURL; ?>forgot-password/" class="auth-link text-black">Forgot password?</a>
				  </div>
				  <!-- <div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="register.html" class="text-primary">Create</a></div> -->
				</form>
			  </div>
			</div>
		  </div>
		</div>
		<!-- content-wrapper ends -->
	  </div>
	  <!-- page-body-wrapper ends -->
	</div>
	<!-- container-scroller -->
	<?php include('include/js.php'); ?>
	<script type="text/javascript">
		$(function(){
			$("#frm").validate({
				rules: {
					email:{required:true, email:true},
					password:{required:true},
				},
				messages: {
					email:{required:"Please enter email address.", email:"Please enter valid email address."},
					password:{required:"Please enter password."},
				},
				errorPlacement: function(error, element) {
					error.insertAfter(element);
				}
			});
		});
	</script>
 </body>
</html>