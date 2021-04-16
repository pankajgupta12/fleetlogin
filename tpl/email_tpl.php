<!DOCTYPE html>
<html>
<body>

<?php  

$infodata = array('1'=>'Yes','2'=>'No');

?>

<table style="widtd:80%" border = "1" >
  <tr>
      <td  colspan="2" style="text-align:center;"><h3>RK : PRE SHIFT CHECK</h3></td>
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
    <td>Run Number</td>
   <td><?php echo $data['run_number']; ?></td> 
  </tr>
  
  
  <!--<tr>
    <td>Current Odometer</td>
    <td><?php // echo $data['current_odometer']; ?></td> 
  </tr>-->
  
   <tr>
    <td>Is the Fuel Tank Full?</td>
   <td><?php echo $infodata[$data['fule_tank']]; ?></td> 
  </tr>
  
    <tr>
    <td>Have temperature tracker?</td>
   <td><?php echo $infodata[$data['temperature_tracker']]; ?></td> 
  </tr>
  
  
  <tr>
    <td>Have temperature tracker?</td>
   <td><?php echo $infodata[$data['temperature_tracker']]; ?></td> 
  </tr>
  
     <tr>
    <td style="width:50%">If you notice anything faulty or damaged or missing with vehicle with regards to tyres, side mirrors,windscreens, lights, mudguards, reverse camera, wipers, washers, any leakage, guages, seatbelts, doors, windows, spare tyre etc.. please mention it below: </td>
    <td><?php echo $data['faulty_damage']; ?></td> 
  </tr>
  <tr>
    <td>Shift you are working for</td>
   <td><?php echo $data['shif_for']; ?></td> 
  </tr>
  
     <tr>
    <td>Tracker Photo</td>
    <td><?php foreach($data['trackerphoto'] as $key=>$val) { 
      
    $extension = end(explode(".", $val));
    if($extension != '') {
    ?>
     <a href="<?php echo $val; ?>" target="_blank"><?php echo end(explode("/",$val)); ?></a><br/>
    <?php } } ?>
    </td>
   </tr>
    
    <tr>
    <td>Vehicle Photo</td>
    <td><?php foreach($data['vehiclephoto'] as $key=>$val1) { 
    $extension = end(explode(".", $val1));
    if($extension != '') {
    ?>
     <a href="<?php echo $val1; ?>" target="_blank"><?php echo end(explode("/",$val1)); ?></a><br/>
    <?php } } ?>
    </td>
   </tr>
  
  <!--  <tr>
    <td>Vehicle Interior Photo</td>
    <td>
    <?php /* foreach($data['vehicleinteriorphoto'] as $key=>$val2) { 
        $extension = end(explode(".", $val2));
       if($extension != '') {
    ?>
     <a href="https://ramkripa.com.au/fleetlogin/photos/pre/<?php echo $val2; ?>" target="_blank"><?php echo $val2; ?></a><br/>
    <?php } } */ ?></td>
  </tr>-->
  
   <tr>
    <td>Work Phone (Front & Back)</td>
    <td>
    <?php foreach($data['workphoto'] as $key=>$val3) { 
      $extension = end(explode(".", $val3));
      if($extension != '') {
    ?>
     <a href="<?php echo $val3; ?>" target="_blank"><?php echo end(explode("/",$val3)); ?></a><br/>
    <?php } } ?>
   </tr>
   
    <!--<tr>
    <td style="width:50%">operator declaration images</td>
     <?php /* foreach($data['operators_photo'] as $key=>$val3) { 
      $extension = end(explode(".", $val3));
      if($extension != '') {
    ?>
     <a href="https://ramkripa.com.au/fleetlogin/photos/pre/<?php echo $val3; ?>" target="_blank"><?php echo $val3; ?></a><br/>
    <?php } } */ ?>
   </tr>-->
  
  <!--<tr>
    <td style="width:50%">OPERATORS DECLARATION (Must be signed at the start of your shift)As the driver of the above registered vehicle and company, I am responsible for ensuring all repairs required are notified to the owner of this vehicle.</td>
    <td><?php echo $infodata[$data['operators']]; ?></td> 
  </tr>-->
  
    <tr>
    <td style="width:50%">I am fit to undertake my allocated tasks</td>
    <td><?php echo $infodata[$data['undertake_allocated']]; ?></td> 
  </tr>
  
  
    <tr>
    <td>Have a current and valid license</td>
    <td><?php echo $infodata[$data['current_valid_license']]; ?></td> 
  </tr>
  
    <tr>
    <td>To the best of my knowledge, I have had NO driving infringements issued to me in tde last 24hrs</td>
    <td><?php echo $infodata[$data['best_knowledge']]; ?></td> 
  </tr>
  
   <tr>
    <td style="width:50%">I have NOT consumed alcohol and/or drugs(prescription) or otderwise tdat may impair my ability to work and drive</td>
    <td><?php echo $infodata[$data['consumed_alcohol']]; ?></td> 
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
