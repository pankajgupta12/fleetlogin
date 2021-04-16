<?php  
require_once('include/Shift.php');
		$shift = new Shift;
		 $shift->logincheck();
include('include/header.php');		 
?>
<style type="text/css">
    .pre_shift {
    margin: 0px;
    padding: 15px 0px;
}
</style>
	<div style="text-align:center"><h3> RK : PRE SHIFT CHECK</h3></div>
	<span id=-"error"></span>
   <fieldset>
      <!-- Form Name -->
	  <form class="form-horizontal" enctype="multipart/form-data" id="form_pre_shift" method="post" action="">
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
               <div class="col-sm-3">
                  <!-- Text input-->
                  <label>Run Number</label>  
                  <input id="run_number" name="run_number" placeholder="Run Number" class="form-control input-md"  type="text">
               </div>
               
               
                <div class="col-sm-3">
                  <!-- Text input-->
                  <label>Is the Fuel Tank Full?</label>  
					<select class="form-control" id="fule_tank" name="fule_tank" onChange="showhide(this.value, 'fule_tank_reason');">
						<option value="0">Select</option>
						<option value="1">Yes</option>
						<option value="2">No</option>
					</select>
					
			    	<input id="fule_tank_reason"  name="fule_tank_reason" placeholder="Fuel Tank Full Reason" class="reason_field form-control input-md"  type="text">
					
                </div>
                
                  <div class="col-sm-3">
                  <!-- Text input-->
                   <label>Have temperature tracker?</label>  
                    <select class="form-control" id="temperature_tracker" name="temperature_tracker" onChange="showhide(this.value, 'temperature_tracker_reason');">
						<option value="0">Select</option>
						<option value="1">Yes</option>
						<option value="2">No</option>
					</select>
					
				<input id="temperature_tracker_reason"  name="temperature_tracker_reason" placeholder="temperature tracker Reason" class="reason_field form-control input-md"  type="text">
					
                </div>
               
			   <!--<div class="col-sm-3">
                  <label>Current Odometer</label>  
                  <input id="current_odometer" name="current_odometer" placeholder="Current Odometer" class="form-control input-md"  type="text">
               </div>-->
			   
			    <!--<div class="col-sm-3">-->
                  <!-- Text input-->
       <!--           <label>Next Service Due - KM's</label>  -->
       <!--           <input id="next_service" name="next_service" placeholder="Next Service Due - KM's" class="form-control input-md"  type="text">-->
       <!--        </div>-->
			   
            </div>
         </div>
        </div>
        <div class="row pre_shift">
         <div class="container">
            <div class="col-12">
    <!--            <div class="col-sm-3">-->
                  <!-- Text input-->
    <!--              <label>Is the Fuel Tank Full?</label>  -->
				<!--	<select class="form-control" id="fule_tank" name="fule_tank" onChange="showhide(this.value, 'fule_tank_reason');">-->
				<!--		<option value="0">Select</option>-->
				<!--		<option value="1">Yes</option>-->
				<!--		<option value="2">No</option>-->
				<!--	</select>-->
					
				<!--<input id="fule_tank_reason"  name="fule_tank_reason" placeholder="Fuel Tank Full Reason" class="reason_field form-control input-md"  type="text">-->
					
    <!--            </div>-->
			   
			   
              
				<div class="col-sm-3">
                  <!-- Text input-->
                  <label>Faulty or Damaged</label>  
				  <input id="faulty_damage"  name="faulty_damage" placeholder="faulty or damaged or missing" class="form-control input-md"  type="text">
                 	
               </div>
			    
				<div class="col-sm-3">
                  <!-- Text input-->
                  <label>Shift you are working for</label>  
                  <select class="form-control" name="shif_for" id="shif_for">
						<option value="0">Select</option>
						<option value="RK Rahul">RK Rahul</option>
					</select>
                </div>
                
                <div class="col-sm-3">
                  <!-- Text input-->
                  <label>I am fit to undertake my allocated tasks</label>  
                  <select class="form-control" id="undertake_allocated"  name="undertake_allocated" onChange="showhide(this.value, 'undertake_allocated_reason');">
						<option value="0">Select</option>
						<option value="1">Yes</option>
						<option value="2">No</option>
					</select>
				<input id="undertake_allocated_reason"  name="undertake_allocated_reason" placeholder="Undertake my allocated Reason" class="reason_field form-control input-md"  type="text">
               </div>
               
			   <div class="col-sm-3">
                  <label>Have a current and valid license</label>  
                  <select class="form-control" id="current_valid_license" name="current_valid_license" onChange="showhide(this.value, 'current_valid_license_reason');">
						<option value="0">Select</option>
						<option value="1">Yes</option>
						<option value="2">No</option>
					</select>
					
				<input id="current_valid_license_reason"  name="current_valid_license_reason" placeholder="current and valid license Reason" class="reason_field form-control input-md"  type="text">
					
               </div>
			   
            </div>
         </div>
        </div>
        <div class="row pre_shift">
        <div class="container">
            <div class="col-12">
              
			   <div class="col-sm-3">
                  <!-- Text input-->
                  <label>Tracker Photo </label>  
                  <input type="file" id="tracker_photo" name="tracker_photo[]" multiple="multiple" accept="image/jpg, image/jpeg ,image/png">
                  <i style="color: red;font-size: 13px;">Please upload 1 photos of Tracker Photo</i>
               </div>
			   
			    <div class="col-sm-3">
                  <!-- Text input-->
                  <label>Vehicle Photo</label>  
                    <input type="file"  id="vehicle_photo" name="vehicle_photo[]" multiple="multiple" accept="image/jpg,image/png, image/jpeg">
                    <i style="color: red;font-size: 13px;">Please upload  4 photos of Vehicle Photo</i>
               </div>
			   
			   <!--<div class="col-sm-3">
                  <label>Vehicle Interior Photo</label>  
                     <input type="file"  id="vehicle_interior_photo" name="vehicle_interior_photo[]" multiple="multiple" accept="image/jpg, image/png ,image/jpeg">
                </div>--->
				
				 <div class="col-sm-3">
                  <!-- Text input-->
                  <label>Work Phone (Front & Back)</label>  
                     <input type="file"  id="work_photo" name="work_photo[]" multiple="multiple"  accept="image/jpg, image/png, image/jpeg">
                     <i style="color: red;font-size: 13px;">Please upload 2 photos of Work Phone</i>
                </div>
			
            </div>
        </div>
       </div>
	   <!--<div class="row pre_shift">
         <div class="container">
            <div class="col-12">
                <div class="col-sm-3">
                  <label>OPERATORS DECLARATION</label>  
                 <select class="form-control" id="operators" name="operators" onChange="showhide(this.value, 'operators_reason');">
						<option value="0">Select</option>
						<option value="1">Yes</option>
						<option value="2">No</option>
					</select>
					
				<input id="operators_reason"  name="operators_reason" placeholder="operators Reason" class="reason_field form-control input-md"  type="text">
					
               </div>
               
               <div class="col-sm-3">
                  <label>Operators declaration</label>  
                   <select class="form-control" id="operators" name="operators" onChange="showhide(this.value, 'operators_reason');">
						<option value="0">Select</option>
						<option value="1">Yes</option>
						<option value="2">No</option>
					</select>
					 <input type="file"  id="operators_photo" name="operators_photo[]" multiple="multiple" accept="image/jpg, image/png, image/jpeg">
				<input id="operators_reason"  name="operators_reason" placeholder="operators Reason" class="reason_field form-control input-md"  type="text">
				
                </div>
               
               <div class="col-sm-3">
                   Text input
                  <label>I am fit to undertake my allocated tasks</label>  
                  <select class="form-control" id="undertake_allocated"  name="undertake_allocated" onChange="showhide(this.value, 'undertake_allocated_reason');">
						<option value="0">Select</option>
						<option value="1">Yes</option>
						<option value="2">No</option>
					</select>
				<input id="undertake_allocated_reason"  name="undertake_allocated_reason" placeholder="Undertake my allocated Reason" class="reason_field form-control input-md"  type="text">
					
               </div>
			   <div class="col-sm-3">
                   Text input
                  <label>Have a current and valid license</label>  
                  <select class="form-control" id="current_valid_license" name="current_valid_license" onChange="showhide(this.value, 'current_valid_license_reason');">
						<option value="0">Select</option>
						<option value="1">Yes</option>
						<option value="2">No</option>
					</select>
					
				<input id="current_valid_license_reason"  name="current_valid_license_reason" placeholder="current and valid license Reason" class="reason_field form-control input-md"  type="text">
					
               </div>
            </div>
         </div>
      </div>-->
	  	

		<div class="row pre_shift">
         <div class="container">
            <div class="col-12">
		     <div class="col-sm-4">
                  <!-- Text input-->
                  <label>To the best of my knowledge, I have had NO driving infringements issued to me in the last 24hrs</label>  
                    <select class="form-control" id="best_knowledge" name="best_knowledge" onChange="showhide(this.value, 'best_knowledge_reason');">
						<option value="0">Select</option>
						<option value="1">Yes</option>
						<option value="2">No</option>
					</select>

				<input id="best_knowledge_reason"  name="best_knowledge_reason" placeholder="Best knowledge Reason" class="reason_field form-control input-md"  type="text">
					
               </div>
			    <div class="col-sm-4">
                  <!-- Text input-->
                  <label>I have NOT consumed alcohol and/or drugs(prescription) or otherwise that may impair my ability to work and drive</label>  
                  <select class="form-control" id="consumed_alcohol" name="consumed_alcohol" onChange="showhide(this.value, 'consumed_alcohol_reason');">
						<option value="0">Select</option>
						<option value="1">Yes</option>
						<option value="2">No</option>
					</select>
					
				<input id="consumed_alcohol_reason"  name="consumed_alcohol_reason" placeholder="Consumed Alcohol Reason" class="reason_field form-control input-md"  type="text">
					
					<input type="hidden" id="lat" name="lat">		
			         <input type="hidden" id="lang" name="lang">		
			
               </div>
               <br/>
			    <div class="col-sm-4">
						<div id="sig"></div><br/>
						<a href="javascript:void(0)" id="clear">Clear Signature</a>
						<textarea id="signature64" name="signed" style="display: none"></textarea>
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
	
	 $(document).ready(function(){

        $('form').on('submit', function (e) {
			
            var tracker_photo =  document.getElementById("tracker_photo").files;
            var vehicle_photo =  document.getElementById("vehicle_photo").files;
            //var vehicle_interior_photo =  document.getElementById("vehicle_interior_photo").files;
            var work_photo =  document.getElementById("work_photo").files;
            
            //var operators_photo =  document.getElementById("operators_photo").files;
			 
			 
			 
			
                if( tracker_photo.length == 0 ){
                  alert("Please select tracker photo");
				   return false;
                }else if(tracker_photo.length != 1){
					alert("You can only upload a maximum of 1 files in tracker");
				    return false;
				} 
				
				if( vehicle_photo.length == 0 ){
                  alert("Please select vehicle photo");
				   return false;
                }else if(vehicle_photo.length != 4){
					alert("You can only upload a maximum of 4 files in vehicle photo");
				    return false;
				} 
				
				// if( vehicle_interior_photo.length == 0 ){
    //               alert("Please select vehicle interior photo");
				//   return false;
    //             }else if(vehicle_interior_photo.length != 1){
				// 	alert("You can only upload a maximum of 1 files in vehicle interior");
				//     return false;
				// } 
				
				if( work_photo.length == 0 ){
                  alert("Please select Work photo");
				   return false;
                }else if(work_photo.length != 2){
					alert("You can only upload a maximum of 2 files in work photo");
				    return false;
				}  
				
				// if( operators_photo.length == 0 ){
    //               alert("Please select operators photo");
				//   return false;
    //             }else if(operators_photo.length != 1){
				// 	alert("You can only upload a maximum of 1 files in operators photo");
				//     return false;
				// }    
				
				
			   
		    $('#submit').attr('disabled',true);
			$('#submit').attr('opacity','0.6');
			$('#submit').attr('cursor','not-allowed');
			$('body').attr('cursor','not-allowed');
			$("body").css("background-color","#7969690d");
			  
			  // console.log(document.getElementById("tracker_photo").files.length);
			  // console.log(file);
			
          resetErrors();
          e.preventDefault();
			 var formData = new FormData(this);
          $.ajax({
            type: 'post',
			dataType: 'json',
            url: 'source/pre_shift_form.php',
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
					  alert('Preshift submitted successfully');
					 // location.reload(); //post_shift.php?task=post_shift
					  //window.location="post_shift.php?task=post_shift";
					  window.location.href = "post_shift.php?task=post_shift";
				  }else if(resp.done==='errormessage') {  
				      //	$('#sig').addClass('inputTxtError').css('border','')
				      	$('#error').html('<p class="error" style="color:red">Somthing going wrong Please check</p>');
				  } else {
					//  alert(resp);
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
	var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
	
	$('#clear').click(function(e) {
		//sig.signature('clear');
		e.preventDefault();
        sig.signature('clear');
        $("#signature64").val('');
	});
	
});
</script>	
	