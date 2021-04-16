<!DOCTYPE html>
<html>
<head>
    	<title>Login Page</title>
<link rel="stylesheet" href="css/bootstrap.min.css" >
<!--Fontawesome CDN-->
<link rel="stylesheet" href="css/all.css">
<link rel="stylesheet" href="css/styale_new.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="js/jquery.min.js"></script>
<!--<script src="https://maps.google.com/maps/api/js?key=AIzaSyATI4bxxh1DZB4TvZsyfIzJB3nw8vkWg-8&libraries=geometry&sensor=true" type="text/javascript"></script>-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="./js/get_lat_log.js" ></script>


<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
<script src="js/jquery-ui.min.js"></script>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>-->
<script src="sign/jquery.signature.js"></script>
<!--<script src="sign/jquery.ui.touch-punch.min.js"></script>-->
<script src="sign/jquery.ui.touch-punch.js"></script>

<!--<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">-->
<link href="sign/jquery.signature.css" rel="stylesheet">

</head>
<body>
<?php  	//require_once('include/Shift.php'); ?>    

 <nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="javascript:void(0) ">
				Ram Kripa Pty Ltd
			</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      
		
			<ul class="nav navbar-nav navbar-right">
				<li><a href="javascript:void(0) "> Welcome : <?php if($_SESSION['name'] != '' && isset($_SESSION['name'])) { echo  ucfirst($_SESSION['name']); } ?></a></li>
    <?php   
      /*
        $notsubmit =  $shift->checkshift();
       $shiftinfo =explode(',', $notsubmit);
       
       if(!in_array(1 , $shiftinfo)) {
    ?>
      
      <li class="<?php if(isset($_GET['task']) && $_GET['task'] == 'pre_shift') { ?>active <?php  } ?>"><a href="pre_shift.php?task=pre_shift">Pre Shift</a></li>
      <?php  } 
      if(!in_array(2 , $shiftinfo) && in_array(1 , $shiftinfo)) {
      ?>
      <li class="<?php if(isset($_GET['task']) &&  $_GET['task'] == 'post_shift') { ?>active <?php  } ?>"><a href="post_shift.php?task=post_shift">Post Shift</a></li>
      <?php   }  */ ?>
      
      
       <?php   
    
        $checkids =  $shift->checkshift();
        $notsubmit = $checkids['checkpre'];
       if(($notsubmit) == 0) {
    ?>
      
      <li class="<?php if(isset($_GET['task']) && $_GET['task'] == 'pre_shift') { ?>active <?php  } ?>"><a href="pre_shift.php?task=pre_shift">Pre Shift</a></li>
      <?php  } else if ($notsubmit == 1) { 
      ?>
      <li class="<?php if(isset($_GET['task']) &&  $_GET['task'] == 'post_shift') { ?>active <?php  } ?>"><a href="post_shift.php?task=post_shift">Post Shift</a></li>
      <?php   }  ?>
      <li><a href="logout.php">Logout</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>  
	
	<style>
        body {
          background: #d4e5ed;  /*#d8d9ef;*/  /*#d4e5ed*/
        }
        .container-fluid {
          background:  #27acef;  /*#757bef;*/  /*#27acef*/
        }
        .navbar-default .navbar-brand {
           color: #fff;
        }
        .navbar-default .navbar-nav > li > a {
           color: #fff;
        }
        h3, .h3 {
            font-size: 21px;
            margin-bottom: -15px;
            font-weight: 600;
            color: #000;
        }
        .navbar-default .navbar-toggle .icon-bar {
          background-color: #fff;
        }
        
            .navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus {
                color: #000;
                font-weight: 600;
                background-color: #d4e5ed;
            }
	
	</style>