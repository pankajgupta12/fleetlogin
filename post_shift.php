<?php
    require_once('include/Shift.php');
    $shift = new Shift;
    $shift->logincheck();
     include('include/header.php');
     //getRego
?>

	<div style="text-align:center"><h3> RK: POST SHIFT CHECK </h3></div>
	<span id=-"errormessage"></span>
   <fieldset>
      <!-- Form Name -->
	  <form class="form-horizontal">
        <div class="row pre_shift">
         <div class="container">
            <div class="col-12">
               <div class="col-sm-3">
                  <!-- Text input-->
                  <label>Rego</label>  
                  <!--<input id="rego" name="rego" placeholder="Rego" class="form-control input-md"  type="text">-->
                  	<select class="form-control" id="rego" name="rego">
						<option value="0">Select</option>
						<?php   foreach($shift->getRego() as $rego) {  ?>
						<option value="<?php echo $rego['id']; ?>"><?php echo $rego['rego_number']; ?></option>
						<?php  } ?>
					</select>
               </div>
               
               <input type="hidden" id="session_id" name="session_id" value="<?php echo $_SESSION['id'];  ?>">
               <input type="hidden" id="shiftid" name="shiftid" value="<?php echo $checkids['shiftid'];  ?>">
               <input type="hidden" id="shiftquoteid" name="shiftquoteid" value="<?php echo $checkids['shiftquoteid'];  ?>">
               
               <div class="col-sm-3">
                  <!-- Text input-->
                  <label>Location</label>  
                  <input id="location" name="location" placeholder="Location" class="form-control input-md"  type="text">
               </div>
			   <div class="col-sm-3">
                  <!-- Text input-->
                  <label>Current Odometer</label>  
                  <input id="current_odometer" name="current_odometer" placeholder="Current Odometer" class="form-control input-md"  type="text">
               </div>
			   <div class="col-sm-3">
                  <!-- Text input-->
                  <label>have a vehicle temperature tracker ?</label>  
                  <input id="temperature_tracker" name="temperature_tracker" placeholder="Does your vehicle have a temperature tracker ?" class="form-control input-md"  type="text">
               </div>
            </div>
         </div>
        </div>
	
        <div class="row pre_shift">
         <div class="container">
            <div class="col-12">
                <div class="col-sm-3">
                  <!-- Text input-->
                  <label>Is the Fuel Tank Full ?</label>  
					<select class="form-control" id="fule_tank" name="fule_tank" onChange="showhide(this.value, 'fule_tank_reason');">
						<option value="0">Select</option>
						<option value="1">Yes</option>
						<option value="2">No</option>
					</select>
					
				<input id="fule_tank_reason"  name="fule_tank_reason" placeholder="Fuel Tank Full Reason" class="reason_field form-control input-md"  type="text">
					
                </div>
			   
			    <div class="col-sm-3">
                  <!-- Text input-->
                  <label>Comments-</label>  
					<select class="form-control" name="comments" id="comments" onChange="showhideyes(this.value, 'comments_reason');">
						<option value="0">Select</option>
						<option value="1">Yes</option>
						<option value="2">No</option>
					</select>
					
					<br/>
					<input id="comments_reason"  name="comments_reason" placeholder="Comments- Reason" class="reason_field form-control input-md"  type="text">
                </div>
				
                <div class="col-sm-3">
                  <!-- Text input-->
                   <label>Any Incident to Report </label>  
                    <select class="form-control" id="any_incident" name="any_incident" onChange="showhideyes(this.value, 'any_incident_reason');">
						<option value="0">Select</option>
						<option value="1">Yes</option>
						<option value="2">No</option>
					</select>
					
					<br/>
					<input id="any_incident_reason"  name="any_incident_reason" placeholder="Any Incident to Report reason" class="reason_field form-control input-md"  type="text">
					
                </div>
				 <div class="col-sm-3">
                  <!-- Text input-->
                  <label>Any other comments  :</label>  
                  <select class="form-control" id="any_other_comment"   name="any_other_comment" onChange="showhideyes(this.value, 'any_other_comment_reason');">
						<option value="0">Select</option>
						<option value="1">Yes</option>
						<option value="2">No</option>
					</select>
					
					<br/>
					<input id="any_other_comment_reason"  name="any_other_comment_reason" placeholder="Any other comments reason" class="reason_field form-control input-md"  type="text">
					
               </div>
            </div>
         </div>
        </div>
        
        <div class="row pre_shift">
        <div class="container">
            <div class="col-12">
              
			   
			   <div class="col-sm-3">
                  <!-- Text input-->
                  <label>Vehicle/Phone Issue</label>  
                  <input type="file" id="vehicle_photo" name="vehicle_photo[]" multiple="multiple" accept="image/jpg, image/jpeg ,image/png">
                  <i style="color: red;font-size: 13px;">Please upload  4 photos of Vehicle Photo</i>
               </div>
			   
			    <div class="col-sm-3">
                  <!-- Text input-->
                  <label>Work Phone - Front & Back</label>  
                    <input type="file" id="work_photo" name="work_photo[]" multiple="multiple" accept="image/jpg, image/jpeg ,image/png">
                    <i style="color: red;font-size: 13px;">Please upload  2 photos of Work Photo</i>
               </div>
			   
			   <div class="col-sm-3">
                  <!-- Text input-->
                  <label>Fuel Cap</label>  
                     <input type="file" id="fuel_cap_photo" name="fuel_cap_photo[]" multiple="multiple" accept="image/jpg, image/jpeg ,image/png">
                     <i style="color: red;font-size: 13px;">Please upload 1 photos of Fuel Cap</i>
                </div>
				
				<div class="col-sm-3">
                  <!-- Text input-->
                  <label>Key returned Photo</label>  
                     <input type="file" id="key_return_photo" name="key_return_photo[]" multiple="multiple" accept="image/jpg, image/jpeg ,image/png">
                     <i style="color: red;font-size: 13px;">Please upload 1 photos of Key returned</i>
                  </div>
				 
            </div>
        </div>
       </div>
		
		<div class="row pre_shift">
            <div class="container">
                <div class="col-12">
				  <div class="col-sm-3">
                  <!-- Text input-->
                  <label>Fuel receipt</label>  
					 <input type="file" id="fuel_receipt" name="fuel_receipt[]" multiple="multiple" accept="image/jpg, image/jpeg ,image/png">
					 <i style="color: red;font-size: 13px;">Please upload 1 photos of Tracker Fuel receipt</i>
                </div>
			    <div class="col-sm-3">
                  <!-- Text input-->
                  <label>Fuel Amount:</label>  
                    <input id="fuel_amount" name="fuel_amount" placeholder="fuel_amount" class="form-control input-md"  type="text">
                </div>
				
		         
                </div>
            </div>
        </div>
        
	  <div class="row pre_shift">
         <div class="container">
            <div class="col-12">
                
				
                <div class="col-sm-4">
                  <!-- Text input-->
                  <label>Interior of the vehicle has been left clean :</label>  
                     <select class="form-control" id="interior_vehicle"  name="interior_vehicle"  onChange="showhide(this.value, 'interior_vehicle_reason');">
						<option value="0">Select</option>
						<option value="1">Yes</option>
						<option value="2">No</option>
					</select>
					
					<br/>
					<input id="interior_vehicle_reason"  name="interior_vehicle_reason" placeholder="Interior of the vehicle- Reason" class="reason_field form-control input-md"  type="text">
					
                </div>
				 <div class="col-sm-4">
                  <!-- Text input-->
                  <label>Have you closed your route?</label>  
                    <select class="form-control" name="closed_route" id="closed_route" onChange="showhide(this.value, 'closed_route_reason');">
						<option value="0">Select</option>
						<option value="1">Yes</option>
						<option value="2">No</option>
					</select>
					
					 <br/>
					<input id="closed_route_reason"  name="closed_route_reason" placeholder="Have you closed your route- Reason" class="reason_field form-control input-md"  type="text">
					
					
			<input type="hidden" id="lat" name="lat">		
			<input type="hidden" id="lang" name="lang">		
               </div>
			     <div class="col-sm-4">
						<div id="sig" ></div><br/>
						<a href="javascript:void(0)" id="clear">Clear Signature</a>
						<textarea id="signature64" name="signed" style="display: none"></textarea>
						<br/>
				 </div>
            </div>
         </div>
      </div>
       
		 	<div class="row pre_shift">
		        <div class="container">
					<div class="col-sm-8">
				    </div>		
					
					<div class="col-sm-4">
						  <button type="submit" name="submit" id="submit" class="btn btn-primary btn-md btn-block">Submit</button>
					 </div>
		        </div>
		    </div>
		
      </form>	  
   </fieldset>
<style>
     .pre_shift {
     margin: 0px;
     padding: 15px 0px;
    }
  .reason_field{
	  display:none;
  }
   .kbw-signature { width: 300px; height: 100px;}
        #sig canvas{
            width: 100% !important;
            height: auto;
        }
</style>

    <script>
		function showhide(id, fieldname){
			if(id == 2){
			   $('#'+fieldname).show();
		   }else{
			   $('#'+fieldname).hide();
		   }  
		}
		
		function showhideyes(id, fieldname){
			if(id == 1){
			   $('#'+fieldname).show();
		   }else{
			   $('#'+fieldname).hide();
		   }  
		}
		
		
		
		
		 $(document).ready(function(){

        $('form').on('submit', function (e) {
			
			var vehicle_photo =  document.getElementById("vehicle_photo").files;
			var work_photo =  document.getElementById("work_photo").files;
			var fuel_cap_photo =  document.getElementById("fuel_cap_photo").files;
			var key_return_photo =  document.getElementById("key_return_photo").files;
			var fuel_receipt =  document.getElementById("fuel_receipt").files;
			
                if( vehicle_photo.length == 0 ){
                  alert("Please select vehicle photo");
				  return false;
                }else if(vehicle_photo.length != 4){
					alert("You can only upload a maximum of 4 files in vehicle photo");
				    return false;
				} 
				
				if( work_photo.length == 0 ){
                  alert("Please select work photo");
				  return false;
                }else if(work_photo.length != 2){
					alert("You can only upload a maximum of 2 files in work photo");
				    return false;
				} 
				
				if( fuel_cap_photo.length == 0 ){
                  alert("Please select vehicle fuel Cap photo");
				  return false;
                }else if(fuel_cap_photo.length != 1){
					alert("You can only upload a maximum of 1 files in fuel Cap photo");
				    return false;
				} 
				
				if( key_return_photo.length == 0 ){
                  alert("Please select key return  photo");
				  return false;
                }else if(key_return_photo.length != 1){
					alert("You can only upload a maximum of 1 files in key return  photo");
				    return false;
				}   
				
				if( fuel_receipt.length == 0 ){
                  alert("Please select fuel receipt photo");
				  return false;
                }else if(fuel_receipt.length != 1){
					alert("You can only upload a maximum of 1 files in fuel receipt photo");
				    return false;
				}    
			
            resetErrors();
            e.preventDefault();
			var formData = new FormData(this);
			
			$('#submit').val('waiting..');
			$('#submit').attr('disabled',true);
			$('#submit').attr('opacity','0.6');
			$('#submit').attr('cursor','not-allowed');
			$('body').attr('cursor','not-allowed');
			$("body").css("background-color","#7969690d"); 
			
          $.ajax({
            type: 'post',
			dataType: 'json',
            url: 'source/post_shift_form.php',
            data: formData,
			cache: false,
			contentType: false,
			processData: false,
            success: function(resp) {
				 
				   $('#submit').attr('disabled',false);
			          $("body").css("background-color","");
					  $('#submit').attr('opacity','');
					$('#submit').attr('cursor','');
					$('body').attr('cursor','');
				
				  if(resp.done==='success'){
					 alert('Postshift Submitted Successfully');
					 //location.reload();
					//window.location="dashboard_page.php?task=dashboard_page";
					window.location.href = "dashboard_page.php?task=dashboard_page";
				  }else if(resp.done==='errormessage') {  
				      //	$('#sig').addClass('inputTxtError').css('border','')
				      	$('#errormessage').html('<p class="error" style="color:red">Somthing going wrong Please check</p>');
				  }  else {
                     
	                 $('#sig').addClass('inputTxtError').css('border','')		
					  $.each(resp, function(i, v) {
						  var msg = '<p class="error" style="color:red" for="'+i+'">'+v+'</p>';
						  
						  if(i == 'sig') {
							 $('#sig').addClass('inputTxtError').css('border','solid 1px #ff0000');
						  }else{
						     $('input[id="' + i + '"],textarea[id="' + i + '"], select[name="' + i + '"],select[id="' + i + '"]').addClass('inputTxtError').css('border','solid 1px #ff0000');
						  }
					  });
					  var keys = Object.keys(resp);
					  $('input[name="'+keys[0]+'"]').focus();
				  }
				  return false;
				},
				error: function() {
				  console.log('there was a problem checking the fields');
				}
			
          });

        });

      });
	
	function resetErrors() {
			$('form input, form select').removeClass('inputTxtError');
			$('form input, form select').css('border','');
			$('p.error').remove();
		} 
		
	
		getCurrLocation();	
    </script>	
    <script>$('#widget').draggable();</script>
<script type="text/javascript">
$(function() {
	//var sig = $('#sig').signature();
	var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
	
	/* $('#disable').click(function() {
		var disable = $(this).text() === 'Disable';
		$(this).text(disable ? 'Enable' : 'Disable');
		sig.signature(disable ? 'disable' : 'enable');
	}); */
	
	$('#clear').click(function(e) {
		//sig.signature('clear');
		e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
	});
	
});
</script>	
	