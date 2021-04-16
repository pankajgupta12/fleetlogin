<?php  
 // ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
   include($_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php");
   include '../include/Db.php';
   
     // global $conn;
      $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
 
			if(mysqli_connect_errno()) {
				echo "Error: Could not connect to database.";
			        exit;
			}
 
            $fromdate = date('Y-m-d', strtotime('-6 day'));
            $todate = date('Y-m-d'); 		
            
            // $fromdate = date('Y-03-19');
            // $todate = date('Y-03-25'); 		
            
            
            $getInvoiceData = getInvoiceData($conn, $fromdate, $todate);	
            $regonuInfo =  getRegoNumber($conn);
            $RosterInfo = rosterInfo($conn, $fromdate, $todate);
    
      foreach($getInvoiceData as $driver_id=>$valueData) {
            if($driver_id > 0) 
            {
                 $filename =  date('jSM' , strtotime($fromdate)).'_to_'.date('jSF',  strtotime($todate)).'_'.date('Y').'.pdf';
     
                  $sql =mysqli_query($conn , "SELECT * FROM driver_staff where id = " .$driver_id."");
                            $driverinfo = mysqli_fetch_object( $sql);
                            $createdOn = date('Y-m-d H:i:s');
                            //$createdOn = date('Y-m-11 11:i:s');
	                        $filename =  date('jSM' , strtotime($fromdate)).'_to_'.date('jSF',  strtotime($todate)).'_'.date('Y').'.pdf';
	                       
	                       $getRosterInfo = $RosterInfo[$driver_id];
	                       
	                       $insertData = "INSERT INTO invoice_info (driver_id, createdOn, invoicedata,invoice_fromdate, filename,invoice_todate) 
	                       VALUES ('".$driver_id."', '".$createdOn."', '".serialize($valueData)."', '".$fromdate."', '".$filename."', '".$todate."')";
	                       
       						  $query = mysqli_query($conn ,  $insertData);  
       						  $lastid = mysqli_insert_id($conn);
       						  $invoiveid =  str_pad($lastid, 4, "0", STR_PAD_LEFT);
	           
                        ob_start(); // start buffer
                        include $_SERVER['DOCUMENT_ROOT'].'/fleetadmin/application/views/tpl/invoice_new.php';
                        // include $_SERVER['DOCUMENT_ROOT'].'/fleetlogin/cronsj/invoice_tpl.php';
                        $html_content = ob_get_contents(); // assign buffer contents to variable
                        ob_end_clean(); // end buffer and remove buffer contents
                        
                        mysqli_query($conn , "UPDATE `invoice_info` SET `fileinfodata` = '".base64_encode($html_content)."' , amount = ".$totalAMount." WHERE `invoice_info`.`id` = ".$lastid."");
                        
                        $fullPath =  $_SERVER['DOCUMENT_ROOT'].'/fleetadmin/files/invoice/'.$driver_id;
                        if (!is_dir($fullPath)) {
                        mkdir($fullPath, 0777, TRUE);
                        } 
                        
                        $filepathname = $fullPath.'/'.$filename;
                        
                        $dompdf = new Dompdf\Dompdf(['isHtml5ParserEnabled' => true]);
                        
                        $dompdf->set_paper(array(
                        0,
                        0,
                        500,
                        700
                        ) , 'portrait');
                        
                        
                        $dompdf->load_html($html_content);
                        $dompdf->render();
                        
                        //$dompdf->stream($file.'pdf', array("Attachment" => false));
                        
                        file_put_contents($filepathname, $dompdf->output());
            }
      } 
    
    
    

  




function getInvoiceData($conn, $fromdate, $todate){
    

     $sql = "SELECT id, form_type, submit_date, rego, run_number, driver_id, shiftid FROM `pre_shift` WHERE DATE(submit_date) >= '".$fromdate."' AND DATE(submit_date) <= '".$todate."'";
    
     $query = mysqli_query($conn ,  $sql);
     
     while($data =  mysqli_fetch_object( $query)) {
         // echo ($data->driver_id).'<br/>';
                $driverid = $data->driver_id;
                $shiftinfo[$driverid][] = $data;
     }
        return $shiftinfo;      
}


function rosterInfo($conn, $fromdate, $todate) {
    
    $rosterInfo= [];
    $sql1 =mysqli_query($conn , "SELECT id, status, driver_id ,  date FROM `driver_roster` WHERE  DATE(date) >= '".$fromdate."' AND DATE(date) <= '".$todate."' ");   
    
     while($data =  mysqli_fetch_assoc( $sql1)) {
         $rosterInfo[$data['driver_id']][$data['date']] = $data['status'];
     }
     
     return $rosterInfo;
}


function getRegoNumber($conn){
     
     $sql = "SELECT id, rego_number FROM `vehicle_list`";
    
     $query = mysqli_query($conn ,  $sql);
     
     while($data =  mysqli_fetch_object( $query)) {
                $id = $data->id;
                $getdata[$id] = $data->rego_number;
     }
     return $getdata;
}

 ?>