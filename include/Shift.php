<?php session_start();
include('Db.php');
//include($_SERVER['DOCUMENT_ROOT']."/shift/vendor/autoload.php");

include($_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php");

  use Aws\S3\S3Client;
 use Aws\S3\Exception\S3Exception;
 
class Shift  
  
{  
    public $db;
    public  function __construct() {  
         // session_start();
         date_default_timezone_set('Australia/Melbourne');          
       $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
 
			if(mysqli_connect_errno()) {
				echo "Error: Could not connect to database.";
			        exit;
			}
    }  
	
	public function logincheck(){
	    
	    if($_SESSION['id'] == '' &&  empty($_SESSION['id'])) {
		  // header('Location: index.php?task=login');   
		  echo  '<script>window.location="index.php";</script>';
	    }
	}
	
	public function mrs($val){
		
		return mysqli_real_escape_string($this->db , $val);
	}
	
	public function logout(){
		//echo  'logout';
		unset($_SESSION);
		session_destroy();
		//header('Location: index.php?task=login');
		 echo  '<script>window.location="index.php?task=login";</script>';
	}
	
	public function login( $mobile, $password ) {
		$mobile = mysqli_real_escape_string($this->db , $mobile);
		$password = mysqli_real_escape_string($this->db , $password);
		
		$result = mysqli_query($this->db , "SELECT * FROM driver_staff WHERE phone = '$mobile' AND password = '$password' AND status = 1");
		
		if ( mysqli_num_rows($result) == 1 ) {
			$data = mysqli_fetch_assoc( $result ); 
			$_SESSION[ 'login_time' ] = time();
			$_SESSION[ 'logged_in' ] = 1;
			$_SESSION[ 'name' ] = $data['name'];
			$_SESSION[ 'id' ] = $data['id'];
			
		//	print_r($_SESSION); die;
			
			return true;
		} else {
			return false;
		}
	}
	
    public function InsertionData($table_name , $notificationArrayData){	 
 	 // retrieve the keys of the array (column titles)
		$fields = array_keys($notificationArrayData);

		// build the query
		$sql = "INSERT INTO $table_name

		(`" . implode('`,`', $fields) . "`) VALUES('" . implode("','", $notificationArrayData) . "')";

        //echo  $sql;  die;
		 mysqli_query($this->db , $sql);
		 
		 return mysqli_insert_id($this->db);
    }
	
      	public function uploadPhotos($photosdata, $folder_type, $pictype ,  $sessionid = 0, $shiftid = 0){
		 
		 
            // error_reporting(E_ALL);
            // ini_set('display_errors', 1); 
            
            if(isset($_SESSION['id']) && $_SESSION['id'] != '') {
		       $driverid =  $_SESSION['id'];
		    }else{
		        $driverid = $sessionid;
		    }
		 
            $IAM_KEY = 'AKIAIR6YUGSFHCXQSNNQ';
            $IAM_SECRET = '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';
         
		    if(!empty($photosdata)) {
		        
		        foreach($photosdata["tmp_name"] as $key=>$tmp_name) {
					//$file_name= uniqid() . "-" . time(); // 5dab1961e93a7-1571494241;
					$file_name = time()."_".uniqid().".jpeg";
					$filename=$photosdata["name"][$key];
					$file_tmp=$photosdata["tmp_name"][$key];
					$error=$photosdata["error"][$key];
				
					$keyName = basename($file_name);		 
						if($folder_type == 'pre') { 
						    $type = 1; 
						    $bucketName = 'preshift';
						}else {
						    $type = 2; 
						    $bucketName = 'postshiftimages';
						}	 
						
                    $options = array('ftp' => array('overwrite' => true));
                    $stream = stream_context_create($options); 
                    
                    $image_url = 'https://'.$bucketName.'.s3.amazonaws.com/'.$file_name;	
 
                  
                  // Set Amazon S3 Credentials
                	$s3 = S3Client::factory(
                		array(
                			'credentials' => array(
                				'key' => $IAM_KEY,
                				'secret' => $IAM_SECRET
                			),
                			'version' => 'latest',
                			'region'  => 'us-east-1'
                		)
                	);	
        			
        			 
					  try {
        		    // Put on S3
            		$s3->putObject(
            			array(
            				'Bucket'=>$bucketName,
            				'Key' =>  $keyName,				
            				//'ContentEncoding' => 'base64',
            				'ContentType' => 'image/jpeg',
            				//'Body'   => fopen($file_tmp, 'r'),
            		     	'SourceFile' => $file_tmp,
            				'StorageClass' => 'REDUCED_REDUNDANCY',
            				'ACL' => 'public-read'
            				// 'StorageClass' => 'Standard'
            			)
            		);
            	
        			
        		} catch(S3Exception $e) {
        		    
        		 //    echo $e->getMessage() . "\n";
        		    
            		// Put on S3
            		$s3->putObject(
            			array(
            				'Bucket'=>$bucketName,
            				'Key' =>  $keyName,				
            				'ContentEncoding' => 'base64',
            				'ContentType' => 'image/jpeg',
            				'SourceFile' => $file_tmp,
            			    //'Body'   => fopen($file_tmp, 'r'),
            				//'StorageClass' => 'REDUCED_REDUNDANCY',
            				'ACL' => 'public-read'
            				// 'StorageClass' => 'Standard'
            			)
            		);
            		
        		}
                       
                        $data['driver_id'] = $driverid;	 
                        $data['form_type'] = $type;	 
                        $data['shift_id'] = $shiftid;	 
                        $data['images_name'] = $image_url;	 
                        $data['createdOn'] = date('Y-m-d H:i:s');	 
                        $data['images_type'] = $pictype;	 
                         $data['url_type'] = 2;	 
                        $this->InsertionData('upload_photo' , $data);
						
						  //$data['driver_id'] = $_SESSION['id'];	 
						  //$data['form_type'] = $type;	 
						  //$data['images_name'] = $image_url;	 
						  //$data['createdOn'] = date('Y-m-d H:i:s');	 
						  //$data['images_type'] = $pictype;	 
						  // $data['url_type'] = 2;	 
						  //$this->InsertionData('upload_photo' , $data);
                }
		    }
		 
	}
	
	 public function uploadPhotos_old111111($photosdata, $folder_type, $pictype ,  $sessionid = 0, $shiftid = 0){
		    
		    if(isset($_SESSION['id']) && $_SESSION['id'] != '') {
		       $driverid =  $_SESSION['id'];
		    }else{
		        $driverid = $sessionid;
		    }
		    
		  //  print_r($photosdata); die;
		  
		    if(!empty($photosdata['name'])  && count($photosdata['name']) > 0) {
		        foreach($photosdata["tmp_name"] as $key=>$tmp_name) {
					$file_name=$filename   = uniqid() . "-" . time(); // 5dab1961e93a7-1571494241;
					$filename=$photosdata["name"][$key];
					
					if($filename != '') {
					    
    					$file_tmp=$photosdata["tmp_name"][$key];
    					$error=$photosdata["error"][$key];
    					$ext=pathinfo($filename,PATHINFO_EXTENSION);
    					$basename   = $file_name . "." . $ext; // 5dab1961e93a7_1571494241.jpg
    						if(!file_exists("../photos/".$folder_type."/".$basename)) {
    							 move_uploaded_file($photosdata["tmp_name"][$key],"../photos/".$folder_type."/".$basename);
    							 
    						if($folder_type == 'pre') { $type = 1; }else { $type = 2; }	 
    						
    						  $data['driver_id'] = $driverid;	 
    						  $data['form_type'] = $type;	 
    						  $data['shift_id'] = $shiftid;	 
    						  $data['images_name'] = $basename;	 
    						  $data['createdOn'] = date('Y-m-d H:i:s');	 
    						  $data['images_type'] = $pictype;	 
    						  $this->InsertionData('upload_photo' , $data);
    						}
					}
                }
		    }
		 
	}
	
	function signatureImages($signed){
		
		     $folderPath = "../signatureimages/";
		     $image_parts = explode(";base64,", $signed);
			 if(!empty($image_parts)) {
				 $image_type_aux = explode("image/", $image_parts[0]);
				 $image_type = $image_type_aux[1];
				 $image_base64 = base64_decode($image_parts[1]);
				 $filename = uniqid() . '.'.$image_type;
				 $file = $folderPath .$filename;
				 file_put_contents($file, $image_base64);
			 
			    return $filename;
			 }
	}
	
	
	function checkshift(){
	    
	      $driverid = $_SESSION['id'];
	      $date = date('Y-m-d');
	      
	       $date1 = date('Y-m-d H:i:s');
	       $data['form_type'] = 0;
	      
	     // echo "SELECT group_concat(form_type) as shifttype FROM `pre_shift` where driver_id = ".$driverid." AND DATE(submit_date) = '".$date."'  ";
	     //SELECT * FROM `pre_shift` WHERE driver_id =1 and form_type = 8 AND submit_date > DATE_SUB(NOW(), INTERVAL 10 HOUR)
	     // id, driver_id ,  submit_date ,  form_type   DATE_SUB( '2021-03-21 23:23:39', INTERVAL 10 HOUR)
	      // echo $date1 . " = SELECT form_type FROM `pre_shift` where driver_id = ".$driverid." AND form_type = 1 AND submit_date >  DATE_SUB ( '".trim($date1)."' , INTERVAL 10 HOUR) ";
	      
	      //  echo  "SELECT id FROM `shift_quote` where driver_id = ".$driverid." AND createdOn > DATE_SUB( '".trim($date1)."' , INTERVAL 10 HOUR) ";
	      
	      // echo   "SELECT id, form_type FROM `pre_shift` where driver_id = ".$driverid." AND form_type = 1 AND submit_date > DATE_SUB( '".trim($date1)."' , INTERVAL 10 HOUR) ";
	      
	       $sql =  mysqli_query($this->db , "SELECT id, shiftquoteid , form_type FROM `pre_shift` where driver_id = ".$driverid." AND form_type = 1 AND submit_date > DATE_SUB( '".trim($date1)."' , INTERVAL 10 HOUR) ");
	      
	     $count = mysqli_num_rows($sql);
	      
	      $data = mysqli_fetch_assoc($sql);
	      
	      //print_r($data);
	      
	      return array('checkpre'=>$count , 'shiftid'=>$data['id'], 'shiftquoteid'=>$data['shiftquoteid'] );
	}
	
	function checkshift_111111(){
	    
	      $driverid = $_SESSION['id'];
	      $date = date('Y-m-d');
	      
	     // echo "SELECT group_concat(form_type) as shifttype FROM `pre_shift` where driver_id = ".$driverid." AND DATE(submit_date) = '".$date."'  ";
	      
	      $sql =  mysqli_query($this->db , "SELECT group_concat(form_type) as shifttype FROM `pre_shift` where driver_id = ".$driverid." AND DATE(submit_date) = '".$date."'  ");
	      
	     // $count = mysql_num_rows($sql);
	      
	      $data = mysqli_fetch_assoc($sql);
	      
	      //print_r($data);
	      
	      return $data['shifttype'];
	}
	
	function getRego(){
	    
	      $sql =  mysqli_query($this->db , "SELECT * FROM `vehicle_list`  ");
	      
	      
	      while($data = mysqli_fetch_assoc($sql)) {
	         
	          $getdata[] = $data;
	      }
	      return $getdata;
	}
	
	function SendEmail($type, $adminid = 0){
	     
	      if($adminid == 0) {
	         $driverid = $_SESSION['id'];
	      }else{
	          $driverid = $adminid;
	      }
	      $date =   date('Y-m-d'); //date('2021-02-21');    //
	      
	     // echo  "SELECT * FROM `pre_shift` where driver_id = ".$driverid." AND DATE(submit_date) = '".$date."' AND form_type = ".$type.""; 
	      $sql =  mysqli_query($this->db , "SELECT * FROM `pre_shift` where driver_id = ".$driverid." AND DATE(submit_date) = '".$date."' AND form_type = ".$type."");
	      $data = mysqli_fetch_assoc($sql);
	      
	      $regoinfosql =  mysqli_query($this->db , "SELECT rego_number , next_services_due FROM `vehicle_list` where id = ".$data['rego']."");
	      $regoinfo = mysqli_fetch_assoc($regoinfosql);
	      
         $data['rego'] = $regoinfo['rego_number'];
         $data['next_services_due'] = $regoinfo['next_services_due'];;
	      
	      $sql1 =  mysqli_query($this->db , "SELECT * FROM `driver_staff` where id = ".$driverid."");
	      $data1 = mysqli_fetch_assoc($sql1);
            
            $data['driver_id'] = $data1['name'];
            $data['phone'] = $data1['phone'];
            $data['email'] = $data1['email'];
            $data['licence_no'] = $data1['licence_no'];
            $data['licence_exp'] = $data1['licence_exp'];
            $shiftid = $data['id'];    
             
              ob_start(); // start buffer
         
         
          // print_r($data); die;
         
            if($type == 1) {
                
                $data['trackerphoto'] =  array_column($this->getImages($driverid , $type, 1, $shiftid), 'images_name');  
                $data['vehiclephoto'] =  array_column($this->getImages($driverid , $type, 2, $shiftid), 'images_name');  
               // $data['vehicleinteriorphoto'] =  array_column($this->getImages($driverid , $type, 3, $shiftid), 'images_name');  
                $data['workphoto'] =  array_column($this->getImages($driverid , $type, 4, $shiftid), 'images_name');  
                 
                // $data['operators_photo'] =  array_column($this->getImages($driverid , $type, 10, $shiftid), 'images_name');  
                
                    $subject = 'Pre Shift by '.$data['driver_id'].' on '.date('d M Y');
                    $file = 'email_tpl.php';
                    include ($_SERVER['DOCUMENT_ROOT'] . "/fleetlogin/tpl/" . $file);
                     $content = ob_get_contents(); // assign buffer contents to variable
                     ob_end_clean(); // end buffer and remove buffer contents
                   
            }else if($type == 2) {
                
                $data['vehicle_photo'] =  array_column($this->getImages($driverid , $type, 5, $shiftid), 'images_name');  
                $data['work_photo'] =  array_column($this->getImages($driverid , $type, 6, $shiftid), 'images_name');  
                $data['fuel_cap_photo'] =  array_column($this->getImages($driverid , $type, 7, $shiftid), 'images_name');  
                $data['key_return_photo'] =  array_column($this->getImages($driverid , $type, 8, $shiftid), 'images_name'); 
                $data['fuel_receipt'] =  array_column($this->getImages($driverid , $type, 9, $shiftid), 'images_name'); 
                
                  $subject = 'Post Shift by '.$data['driver_id'].' on '.date('d M Y');
                  
                  
                  
                   $file = 'post_email.php';
                   include ($_SERVER['DOCUMENT_ROOT'] . "/fleetlogin/tpl/" . $file);
                   $content = ob_get_contents(); // assign buffer contents to variable
                   ob_end_clean(); // end buffer and remove buffer contents
            }
            
         //   echo $content; die;
            
            
            $from = 'shift@ramkripa.com.au';
            $to_1 = 'pankajgupta7000@gmail.com';
            $to = 'ramkripa.info@gmail.com';
            
            // Always set content-type when sending HTML email
                $headers = 'From: <'.$from.'>' . "\r\n";
                $headers .='Reply-To: '. $to . "\r\n" ;
               // $headers .='X-Mailer: PHP/' . phpversion();
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
                
            mail($data['email'], $subject, $content,$headers);    
            mail($to, $subject, $content,$headers);
          //  mail($to_1, $subject, $content,$headers);
	     
	}
	
	
	function getImages($driver_id, $type, $images_type, $shift_id){
	    
	    $sql =  mysqli_query($this->db , "SELECT * FROM  upload_photo  where driver_id = ".$driver_id." AND shift_id = ".$shift_id."  AND DATE(createdOn) = '".date('Y-m-d')."' AND form_type = '".$type."' AND images_type = ".$images_type." ");
	    while($data = mysqli_fetch_assoc($sql)){
	      
	        $getdata[] = $data;
	    
	    }
	    return    $getdata;;
	}
	
	function getNameByID($table, $field , $id) {
	    
	    $sql =  mysqli_query($this->db , "SELECT {$field} FROM  {$table}  where id = ".$id."");
	    $data = mysqli_fetch_assoc($sql);
	     return  $data[$field];
	}
	
	function getsession(){
	     if($_SESSION['id'] != '') {
	      return $id = $_SESSION['id'];
	     }else{
	         return 0 ;
	     }
	}
	
	
	
	
  
}
	?>