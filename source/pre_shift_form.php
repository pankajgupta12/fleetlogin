<?php 

  		include('../include/Shift.php');
		//$shift->logincheck();
		$shift = new Shift;
   if(isset($_POST))
    {
		$fileerror=array();

		   
		  // print_r($_POST); die;
		   
			$rego = $shift->mrs($_POST['rego']);	
			$run_number = $shift->mrs($_POST['run_number']);	
		//	$current_odometer = $shift->mrs($_POST['current_odometer']);	
		//	$next_service = $shift->mrs($_POST['next_service']);	
			$fule_tank = $shift->mrs($_POST['fule_tank']);	
			$fule_tank_reason = $shift->mrs($_POST['fule_tank_reason']);	
			$temperature_tracker = $shift->mrs($_POST['temperature_tracker']);	
			$temperature_tracker_reason = $shift->mrs($_POST['temperature_tracker_reason']);	
			$faulty_damage = $shift->mrs($_POST['faulty_damage']);	
			$shif_for = $shift->mrs($_POST['shif_for']);	
			
			
			
// 			$operators = $shift->mrs($_POST['operators']);	
// 			$operators_reason = $shift->mrs($_POST['operators_reason']);	
			
			
			$undertake_allocated = $shift->mrs($_POST['undertake_allocated']);	
			$undertake_allocated_reason = $shift->mrs($_POST['undertake_allocated_reason']);	
			$current_valid_license = $shift->mrs($_POST['current_valid_license']);	
			$current_valid_license_reason = $shift->mrs($_POST['current_valid_license_reason']);	
			$best_knowledge = $shift->mrs($_POST['best_knowledge']);	
			$best_knowledge_reason = $shift->mrs($_POST['best_knowledge_reason']);	
			$consumed_alcohol = $shift->mrs($_POST['consumed_alcohol']);	
			$consumed_alcohol_reason = $shift->mrs($_POST['consumed_alcohol_reason']);	
			$signed = $_POST['signed'];
			
			$id_address = $_SERVER['REMOTE_ADDR'];
			
			
			$errors = array();
		
			if(empty($rego)){
					$errors['rego'] = 'Please enter a rego.';				
			}
				
			if(empty($run_number)){
				$errors['run_number'] = 'Please enter a run number.';				
			}
			
// 			if(empty($current_odometer)){
// 					$errors['current_odometer'] = 'Please enter a current odometer.';				
// 			}
			
// 			if(empty($next_service)){
// 					$errors['next_service'] = 'Please enter a Next service.';				
// 			}

			if(empty($fule_tank)){
					$errors['fule_tank'] = 'Please enter a fule tank.';				
			}else if($fule_tank == 2) {
					if(empty($fule_tank_reason)){
							$errors['fule_tank_reason'] = 'Please enter a fule tank reason.';				
					}
			}
			 
			if(empty($temperature_tracker)){
					$errors['temperature_tracker'] = 'Please enter a Temperature tracker.';				
			}else if($temperature_tracker == 2) {
					if(empty($temperature_tracker_reason)){
							$errors['temperature_tracker_reason'] = 'Please enter a Temperature tracker Reason.';				
					}
			}
			
			if(empty($faulty_damage)){
					$errors['faulty_damage'] = 'Please enter a faulty damage.';				
			}
			if(empty($shif_for)){
					$errors['shif_for'] = 'Please enter a shif for.';				
			}
// 			if(empty($operators)){
// 					$errors['operators'] = 'Please enter a operators.';				
// 			}
			
                // 			else if($operators == 2) {
                // 				if(empty($operators_reason)){
                // 						$errors['operators_reason'] = 'Please enter a operators reason.';				
                // 				}
                // 			}
                
			
			if(empty($undertake_allocated)){
					$errors['undertake_allocated'] = 'Please enter a undertake allocated.';				
			}else if($undertake_allocated == 2) {
				if(empty($undertake_allocated_reason)){
						$errors['undertake_allocated_reason'] = 'Please enter a undertake allocated reason.';				
				}
			}
			if(empty($current_valid_license)){
					$errors['current_valid_license'] = 'Please enter a current valid license.';				
			}else if($current_valid_license == 2) {
				if(empty($current_valid_license_reason)){
						$errors['current_valid_license_reason'] = 'Please enter a current valid license reason.';				
				}
			}
			
			if(empty($best_knowledge)){
					$errors['best_knowledge'] = 'Please enter a best knowledge.';				
			}else if($current_valid_license == 2) {
				if(empty($best_knowledge_reason)){
						$errors['best_knowledge_reason'] = 'Please enter a best knowledge reason.';				
				}
			}
			if(empty($consumed_alcohol)){
					$errors['consumed_alcohol'] = 'Please enter a consumed alcohol.';				
			}else if($consumed_alcohol == 2) {
				if(empty($consumed_alcohol_reason)){
						$errors['consumed_alcohol_reason'] = 'Please enter a consumed alcohol reason.';				
				}
			}
			if(empty($signed)) {
				$errors['sig'] = 'Please enter a your signed.';				
			}	
		    
		  
		    if(count($errors) > 0){
					if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
							echo json_encode($errors);
							exit;
						 }
				//This is when Javascript is turned off:
						   echo "<ul>";
						   foreach($errors as $key => $value){
						  echo "<li>" . $value . "</li>";
						   }
						   echo "</ul>";exit;
								   
			}else {
				        
			  $signature = $shift->signatureImages($signed);		
				
			  $data['rego'] = $rego;
			  $data['signature'] = $signature;
			  $data['run_number'] = $run_number;
			 // $data['current_odometer'] = $current_odometer;
			 // $data['next_service'] = $next_service;
			  $data['driver_id'] = $_SESSION['id'];
			  $data['fule_tank'] = $fule_tank;
			  $data['fule_tank_reason'] = $fule_tank_reason;
			  $data['temperature_tracker'] = $temperature_tracker;
			  $data['temperature_tracker_reason'] = $temperature_tracker_reason;
			  $data['faulty_damage'] = $faulty_damage;
			  $data['shif_for'] = $shif_for;
			 
			 // $data['operators'] = $operators;
			 // $data['operators_reason'] = $operators_reason;
			 
			  $data['undertake_allocated'] = $undertake_allocated;
			  $data['undertake_allocated_reason'] = $undertake_allocated_reason;
			  $data['current_valid_license'] = $current_valid_license;
			  $data['current_valid_license_reason'] = $current_valid_license_reason;
			  $data['best_knowledge'] = $best_knowledge;
			  $data['best_knowledge_reason'] = $best_knowledge_reason;
			  $data['consumed_alcohol'] = $consumed_alcohol;
			  $data['consumed_alcohol_reason'] = $consumed_alcohol_reason;
			  $data['form_type'] = 1;
			  $data['lat'] = $_POST['lat'];
			  $data['lang'] = $_POST['lang'];
			  $data['id_address'] = $id_address;
			  $data['submit_date'] = date('Y-m-d H:i:s');
			
                $shift_quote['driver_id'] = $_SESSION['id'];
                $shift_quote['rego'] = $rego;
                $shift_quote['run_number'] = $run_number;
                $shift_quote['createdOn'] = date('Y-m-d H:i:s');
			   $shiftinserid = $shift->InsertionData('shift_quote' ,$shift_quote);     
			   
			   $data['shiftquoteid']  = $shiftinserid;
			   
			   $inserid = $shift->InsertionData('pre_shift' ,$data);     
				
				if($inserid) {
				
        			$tracker_photo = $_FILES["tracker_photo"];
        			$vehicle_photo  = $_FILES["vehicle_photo"];
        			$vehicle_interior_photo = $_FILES["vehicle_interior_photo"];
        			$work_photo = $_FILES["work_photo"]; 
        			$operators_photo = $_FILES["operators_photo"]; 
        			
        		    if(!empty($tracker_photo)) {
        		      $shift->uploadPhotos($tracker_photo , 'pre', '1' ,$_SESSION['id'], $inserid);
        		    }
        		    if(!empty($vehicle_photo)) {
        		     $shift->uploadPhotos($vehicle_photo , 'pre', '2' , $_SESSION['id'] , $inserid);
        		    }
        		  
        		  //  if(!empty($vehicle_interior_photo)) {
        		  //    $shift->uploadPhotos($vehicle_interior_photo , 'pre', '3' , $_SESSION['id'],  $inserid);
        		  //  }
        		  
        		    if(!empty($work_photo)) {
        		      $shift->uploadPhotos($work_photo , 'pre', '4' , $_SESSION['id'] , $inserid);
        		    }
        		    
        		  //   if(!empty($operators_photo)) {
        		  //    $shift->uploadPhotos($operators_photo , 'pre', '10' , $_SESSION['id'] , $inserid);
        		  //  }
        		    
                   $shift->SendEmail(1);		 
				
	             	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

						$errors['done']='success';
						//$errors['MSG']='Work order has been added successfully.';
						echo json_encode($errors);
						//redirect('masterForm/raw_material_master');
						exit;
					}
					
				}else{
				    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

						$errors['done']='errormessage';
						echo json_encode($errors);
						exit;
					}
				}
			}
    }
	

?>