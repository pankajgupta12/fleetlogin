 <?php 
  		include('../include/Shift.php');
		//$shift->logincheck();
		$shift = new Shift;
   if(isset($_POST))
    {
		    $adminid =  $_POST['session_id']; 
			$rego = $shift->mrs($_POST['rego']);	
			$location = $shift->mrs($_POST['location']);	
			$current_odometer = $shift->mrs($_POST['current_odometer']);	
			$temperature_tracker = $shift->mrs($_POST['temperature_tracker']);	
			$fule_tank = $shift->mrs($_POST['fule_tank']);	
			$fule_tank_reason = $shift->mrs($_POST['fule_tank_reason']);	
			$comments = $shift->mrs($_POST['comments']);	
			
			$comments_reason = $shift->mrs($_POST['comments_reason']);	
			$any_incident = $shift->mrs($_POST['any_incident']);	
			$any_incident_reason = $shift->mrs($_POST['any_incident_reason']);	
			$any_other_comment = $shift->mrs($_POST['any_other_comment']);	
			$any_other_comment_reason = $shift->mrs($_POST['any_other_comment_reason']);	
			$fuel_amount = $shift->mrs($_POST['fuel_amount']);	
			$interior_vehicle = $shift->mrs($_POST['interior_vehicle']);	
			$interior_vehicle_reason = $shift->mrs($_POST['interior_vehicle_reason']);	
			$closed_route = $shift->mrs($_POST['closed_route']);	
			$closed_route_reason = $shift->mrs($_POST['closed_route_reason']);	
			$signed = $_POST['signed'];
			$shiftid = $_POST['shiftid'];
			$id_address = $_SERVER['REMOTE_ADDR'];
			
			$shiftquoteid = $_POST['shiftquoteid'];
			//echo  $signed;
			
			$errors = array();

			if(empty($rego)){
					$errors['rego'] = 'Please enter a rego.';				
			}
			
			if(empty($location)){
					$errors['location'] = 'Please enter a location.';				
			}
			
			if(empty($current_odometer)){
					$errors['current_odometer'] = 'Please enter a current odometer.';				
			}
			if(empty($temperature_tracker)){
					$errors['temperature_tracker'] = 'Please enter a temperature tracker.';				
			}
			if(empty($fule_tank)){
					$errors['fule_tank'] = 'Please enter a next fule tank.';				
			}else if($fule_tank == 2) {
					if(empty($fule_tank_reason)){
							$errors['fule_tank_reason'] = 'Please enter a fule tank reason.';				
					}
			}
			if(empty($comments)){
					$errors['comments'] = 'Please enter a comments.';				
			}else if($comments == 1) {
				if(empty($comments_reason)){
						$errors['comments_reason'] = 'Please enter a comments reason.';				
				}
			}
			if(empty($any_incident)){
					$errors['any_incident'] = 'Please enter a any incident.';				
			}else if($any_incident == 1) {
			
				if(empty($any_incident_reason)){
						$errors['any_incident_reason'] = 'Please enter a any any incident reason.';				
				}
			}
			
			if(empty($any_other_comment)){
					$errors['any_other_comment'] = 'Please enter a any any any other comment.';				
			}else if($any_other_comment == 1) {
				if(empty($any_other_comment_reason)){
						$errors['any_other_comment_reason'] = 'Please enter a any any any_other comment reason.';				
				}
			}
	        
			if(empty($fuel_amount)){
					$errors['fuel_amount'] = 'Please enter a fuel amount.';				
			}
	         
			if(empty($interior_vehicle)){
					$errors['interior_vehicle'] = 'Please enter a interior vehicle.';				
			}else if($interior_vehicle == 2) {
				
				if(empty($interior_vehicle_reason)){
						$errors['interior_vehicle_reason'] = 'Please enter a interior vehicle reason.';				
				}
			}
			
			if(empty($closed_route)){
					$errors['closed_route'] = 'Please enter a closed route.';				
			}else if($closed_route == 2) {
				
				if(empty($closed_route_reason)){
						$errors['closed_route_reason'] = 'Please enter a  reason.';				
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
				$data['location'] = $location;
				$data['current_odometer'] = $current_odometer;
				$data['comments'] = $comments;
				$data['driver_id'] = $adminid;
				$data['fule_tank'] = $fule_tank;
				$data['fule_tank_reason'] = $fule_tank_reason;
				$data['temperature_tracker'] = $temperature_tracker;
				
				$data['shiftid'] = $shiftid;
				$data['shiftquoteid']  = $shiftquoteid;
				 
				$data['comments_reason'] = $comments_reason;
				$data['any_incident'] = $any_incident;
				$data['any_incident_reason'] = $any_incident_reason;
				$data['any_other_comment'] = $any_other_comment;
				$data['any_other_comment_reason'] = $any_other_comment_reason;
				$data['fuel_amount'] = $fuel_amount;
				$data['interior_vehicle'] = $interior_vehicle;
				$data['interior_vehicle_reason'] = $interior_vehicle_reason;
				$data['closed_route'] = $closed_route;
				$data['closed_route_reason'] = $closed_route_reason;
				$data['lat'] = $_POST['lat'];
				$data['lang'] = $_POST['lang'];
				$data['id_address'] = $id_address;
				
				$data['form_type'] = 2;
			    $data['submit_date'] = date('Y-m-d H:i:s');
				
			$insertid =	$shift->InsertionData('pre_shift' ,$data);    
				
			if($insertid) {
				
				$vehicle_photo = $_FILES["vehicle_photo"];
				$work_photo  = $_FILES["work_photo"];
				$fuel_cap_photo = $_FILES["fuel_cap_photo"];
				$key_return_photo = $_FILES["key_return_photo"]; 
				$fuel_receipt = $_FILES["fuel_receipt"]; 

				if(!empty($vehicle_photo)) {
				   $shift->uploadPhotos($vehicle_photo , 'post', '5' , $adminid, $insertid);
				}
				if(!empty($work_photo)) {
			    	$shift->uploadPhotos($work_photo , 'post', '6' ,$adminid , $insertid);
				}
				if(!empty($fuel_cap_photo)) {
				   $shift->uploadPhotos($fuel_cap_photo , 'post', '7' , $adminid ,$insertid);
				}
				if(!empty($key_return_photo)) {
			    	$shift->uploadPhotos($key_return_photo , 'post', '8' , $adminid , $insertid);
				}
                if(!empty($fuel_receipt)) {
			    	$shift->uploadPhotos($fuel_receipt , 'post', '9' ,$adminid , $insertid );
				}				
				 $shift->SendEmail(2 , $adminid);
            
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
						//$errors['MSG']='Work order has been added successfully.';
						echo json_encode($errors);
						//redirect('masterForm/raw_material_master');
						exit;
					}	
			    
			}
				
			}
			
	}