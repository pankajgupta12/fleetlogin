<?php  
	//echo  'logout';
    	session_start();
		unset($_SESSION);
		$_SESSION = '';
		$_SESSION['id'] ='';
		$_SESSION['admin'] ='';
		session_destroy(); 
		header('Location: index.php');
	//	 echo  '<script>window.location="index.php?task=login";</script>';

 ?>