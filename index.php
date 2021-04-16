<?php 
    @ob_start();
    include('include/Shift.php');
    $shift = new Shift;
     //print_r($_SESSION); die;
    //     if(isset($_SESSION['id']) && $_SESSION['id'] != '') {
		  // header('Location: index.php');
		  // exit();
	   // }
 
   if(isset($_POST['submit']) && !empty($_POST)) {
        
	    //print_r($_POST);
		 if(empty($_POST['phone'])) {
			 $erro['phone'] = 'Please enter mobile number';
		 }
		 
		 if(empty($_POST['password'])) {
			 $erro['password'] = 'Please enter password';
		 }
		 
		 if(empty($erro)) {
			 //$shift = new Shift;
             $phone = 			$_POST['phone']; 
             $password = 			$_POST['password']; 
			 $loginstatus = $shift->login($phone,$password);
			 
			// print_r($loginstatus);  die;
			 
			 
			  if($loginstatus) {
			     //  print_r($_SESSION); die;dashboard_page.php
			    // echo  '<script>window.location="home.php?task=pre_shift";</script>';
				 // header('Location:  pre_shift.php?task=pre_shift');
				  header('Location:  dashboard_page.php?task=dashboard_page');
				  exit();
				 // echo  'test';  die;
			  }else{
				 $erro['message'] = 'Your phone number & password missmatch'; 
			  }
		 }
    } 
 
 @ob_end_flush();
?>      
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Page</title>
   <!--Made with love by Mutiullah Samim -->
	<!--Bootsrap 4 CDN-->
	<!--<link rel="stylesheet" href="css/log_bootstrap.min.css" >-->
	<link rel="stylesheet" href="css/log_bootstrap_min.css">
	
    <!--Fontawesome CDN-->
	<!--<link rel="stylesheet" href="css/all.css">-->
	<!--<link rel="stylesheet" href="css/font-awesome.min.css">-->
	
	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="container">
  
  <div class="row login_main"> 
            <div class="col-md-7">
               <div class="login_img"><img src="img/login_left.jpg" alt="login"/></div> 
            </div>
            
            <div class="col-md-5">
            	<div class="d-flex justify-content-center h-100">
            		<div class="card">
            			<div class="card-header">
            				<h3>Sign In</h3>
            				<?php  
            				   if(!empty($erro)) {
            					    foreach($erro as $key=>$val) {
            							echo '<span style="color:#f38686;">'.$val.'</span><br/>';
            						}
            				   }
            				
            				 ?>
            				
            			</div>
            			<div class="card-body">
            				<form method="post" action="">
            					<div class="input-group form-group">
            						<div class="input-group-prepend">
            							<span class="input-group-text"><i class="fa fa-user"></i></span>
            						</div>
            						<input type="text" value="<?php if(isset($_POST['phone'])) { echo $_POST['phone'];} ?>" name="phone" class="form-control" placeholder="Phone">
            						
            					</div>
            					<div class="input-group form-group">
            						<div class="input-group-prepend">
            							<span class="input-group-text"><i class="fa fa-key"></i></span>
            						</div>
            						<input type="password" name="password" class="form-control" placeholder="password">
            					</div>
            					<div class="row align-items-center remember">
            						<input type="checkbox">Remember Me
            					</div>
            					<div class="form-group">
            						<!--<input type="submit"  name="submit" value="Login" class="btn float-right login_btn">-->
            						<input type="submit"  name="submit" value="Login" class="btn  login_btn">
            					</div>
            				</form>
            			</div>
            			<!--<div class="card-footer">
            				<div class="d-flex justify-content-center links">
            					Don't have an account?<a href="#">Sign Up</a>
            				</div>
            				<div class="d-flex justify-content-center">
            					<a href="#">Forgot your password?</a>
            				</div>
            			</div>-->
            		</div>
            	</div>
	        </div>
	
	
    </div> 	
</div>
</body>
</html>