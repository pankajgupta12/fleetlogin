<!DOCTYPE html>
<html>
<body>

<?php  

$infodata = array('1'=>'Yes','2'=>'No');

?>

<table style="widtd:80%" border = "1" >
  <tr>
      <td  colspan="2" style="text-align:center;"><h3>RK : POST SHIFT CHECK</h3></td>
  </tr>
  
  
  <tr>
    <td>Driver Name</td>
    <td><?php echo $data['driver_id'];  ?></td> 
  </tr>
  
  <tr>
    <td>Driver Email</td>
    <td><?php echo $data['email'];  ?></td> 
  </tr>
  
  <tr>
    <td>Phone</td>
    <td><?php echo $data['phone'];  ?></td> 
  </tr>
  
  <tr>
    <td>Licence No</td>
   <td><?php  echo $data['licence_no']; ?></td> 
  </tr>
  
  <tr>
    <td>Licence Expiry</td>
   <td><?php  echo $data['licence_exp']; ?></td> 
  </tr>
  
  
  <tr>
    <td>Rego</td>
    <td><?php echo $data['rego']; ?></td> 
  </tr>
  
   <tr>
    <td>Next Services Due</td>
    <td><?php echo $data['next_services_due']; ?></td> 
  </tr>
  
  <tr>
    <td>Location</td>
   <td><?php echo $data['location']; ?></td> 
  </tr>
  
  
  <tr>
    <td>Current Odometer</td>
    <td><?php echo $data['current_odometer']; ?></td> 
  </tr>
  
   <tr>
    <td>s the Fuel Tank Full ?</td>
   <td><?php echo $infodata[$data['fule_tank']]; ?></td> 
  </tr>
  
    <tr>
    <td>Does your vehicle have a temperature tracker ?</td>
   <td><?php echo $infodata[$data['temperature_tracker']]; ?></td> 
  </tr>
  
  
     <tr>
    <td>Comments -PLEASE NOTIFY YOUR SUPERVISOR</td>
    <td><?php echo $infodata[$data['comments']]; ?></td> 
  </tr>
  <tr>
    <td>Any Incident to Report </td>
   <td><?php echo $infodata[$data['any_incident']]; ?></td> 
  </tr>
  
    <tr>
      <td> Any other comments : </td>
      <td><?php echo $infodata[$data['any_other_comment']]; ?></td> 
    </tr>
 
     <tr>
    <td>Vehicle/Phone Issue</td>
    <td><?php foreach($data['vehicle_photo'] as $key=>$val1) { ?>
     <!--<a href="https://ramkripa.com.au/fleetlogin/photos/post/<?php echo $val1; ?>" target="_blank"><?php echo $val1; ?></a><br/>-->
     <a href="<?php echo $val1; ?>" target="_blank"><?php echo end(explode("/",$val1)); ?></a><br/>
    <?php } ?>
    </td>
   </tr>
    
    <tr>
    <td>Upload photos of Work Phone - Front & Back</td>
    <td><?php foreach($data['work_photo'] as $key=>$val2) { ?>
     <a href="<?php echo $val2; ?>" target="_blank"><?php echo end(explode("/",$val2));  ?></a><br/>
    <?php } ?>
    </td>
   </tr>
  
 
   <tr>
    <td>Upload Photo of Fuel Cap </td>
    <td>
    <?php foreach($data['fuel_cap_photo'] as $key=>$val3) { ?>
     <a href="<?php echo $val3; ?>" target="_blank"><?php echo end(explode("/",$val3));  ?></a><br/>
    <?php } ?>
   </tr>
   
   <tr>
    <td>Key returned Photo</td>
    <td>
    <?php foreach($data['key_return_photo'] as $key=>$val4) { ?>
     <a href="<?php echo $val4; ?>" target="_blank"><?php echo end(explode("/",$val4));  ?></a><br/>
    <?php } ?>
   </tr>
   
   
   <tr>
    <td>Fuel receipt</td>
    <td>
    <?php foreach($data['fuel_receipt'] as $key=>$val5) { ?>
     <a href="<?php echo $val5; ?>" target="_blank"><?php echo end(explode("/",$val5)); ?></a><br/>
    <?php } ?>
   </tr>
  
  <tr>  
    <td>Fuel Amount:</td>
    <td><?php echo $data['fuel_amount']; ?></td> 
  </tr>
   
  <tr>  
    <td>Interior of the vehicle has been left clean :</td>
    <td><?php echo $infodata[$data['interior_vehicle']]; ?></td> 
  </tr>
  
    <tr>
    <td>Have you closed your route?</td>
    <td><?php echo $infodata[$data['closed_route']]; ?></td> 
  </tr>
  
  <tr>
    <td>Driver's Signature</td>
    <td><a href="https://ramkripa.com.au/fleetlogin/signatureimages/<?php echo $data['signature']; ?>" target="_blank"><?php echo $data['signature']; ?></a></td>
  </tr>
  
  <!--<tr>
    <td>Form Submit Date</td>
   <td><?php echo $data['submit_date']; ?></td> 
  </tr>-->
  
   <tr>
        <td>Device Info</td>
       <td>Lat|Long- <?php echo $data['lat'].' | '.$data['lang']; ?><br/>
        IP-<?php echo $data['id_address'];  ?> <br>
        DateTIme - <?php echo $data['submit_date']; ?>
       </td> 
   </tr>
  
</table>

</body>
</html>
