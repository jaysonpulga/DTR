<?php
session_start();
include('database.php');  
$db = new Database();  
$db->connect(); 
$action = $_REQUEST["action"];




if(isset($_REQUEST["request"]) && $_REQUEST["request"] == 'ajax'){

	switch($action)
	{
	
		case "login";
	
		$Id_Number = $_REQUEST["Id_Number"];
		$Password = $_REQUEST["Password"];
		
		
		if($db->select('tbl_employee','*','Id_Number = "'.$Id_Number.'" AND password = "'.$Password.'"  ' )){
						if(count($db->getResult()) > 0){
							$result = $db->getResult();
							
								
									$date = date("Y-m-d");
									$time = date("H:i:s");
							 
									$rows ="Id_Number,date1,check_in";
									
									$values = array($Id_Number,$date,$time);
									$db->insert('time',$values,$rows);
									
									
									 $insertID = mysql_insert_id();
							
						
									 $db->select("tbl_employee a,time b","a.*,b.date1,b.check_in",'a.Id_Number = "'.$Id_Number.'" AND b.date1 ="'.$date.'"    AND b.id= "'.$insertID.'"','b.id desc');
										$result = $db->getResult();
							 
									 foreach($result as $info)
									 {
										 $fullname= $info["First_Name"]." ".$info["Middle_Name"]." ".$info["Last_Name"];
										
										setcookie('fullname',$fullname,time() + (60 * 30),'/');
										
										
										setcookie('Date',$info["date1"],time() + (60 * 30),'/');
										setcookie('Timein',$info["check_in"],time() + (60 * 30),'/');
										
										
									 }
									
									setcookie('timeID',$insertID,time() + (60 * 30),'/');
									setcookie('Id_Number',$Id_Number,time() + (60 * 30),'/');
						
							
							print "YOSH!";
						} else {
							print "ERROR: ID number or password did not match.";
						}
					}else{
						print "ERROR: ID number or password did not match.";
					}
		break;
		
		
		
		
		
		case "check_logout";
		
		
		$Id_Number = $_REQUEST["Id_Number"];
		$Password = $_REQUEST["Password"];
		
		
		if($db->select('tbl_employee','*','Id_Number = "'.$Id_Number.'" AND password = "'.$Password.'"  ' )){
						if(count($db->getResult()) > 0){
							$result = $db->getResult();
							
								
									$date = date("Y-m-d");
									$time = date("H:i:s");
							 
									$rows ="Id_Number,date2,check_out,checkin_id";
									
									$values = array($_COOKIE['Id_Number'],$date,$time,$_COOKIE['timeID']);
									$db->insert('check_out',$values,$rows);
				
				
	
									setcookie('Id_Number','',time()-60*60*24,'/');
									setcookie('fullname','',time()-60*60*24,'/');
									setcookie('Date','',time()-60*60*24,'/');
									setcookie('Timein','',time()-60*60*24,'/');
									setcookie('timeID','',time()-60*60*24,'/');
									print "logout!";
								
								
			
						} else {
							print "ERROR: ID number or password did not match.";
						}
					}else{
						print "ERROR: ID number or password did not match.";
					}

		break;
		
		
	
	case "fetch_allemployee";
	
				$rows="*";
				$db->select('tbl_employee',$rows);
				$res = $db->getResult();
				
				print json_encode($res);
	
	
	break;
	
	case "admin_login";
	
		$username = $_REQUEST["username"];
		$password = $_REQUEST["password"];
		
		
		if($db->select('admin_user','*','username = "'.$username.'" AND password = "'.$password.'"  ' )){
						if(count($db->getResult()) > 0){
							$result = $db->getResult();
							
								
									
									
							
						
									 $db->select("admin_user","*",'username = "'.$username.'" AND password ="'.$password.'"  ');
										$result = $db->getResult();
							 
									 foreach($result as $info)
									 {
										 
										
										
										setcookie('username',$info["username"],time() + (60 * 30),'/');
										setcookie('Fullname',$info["Fullname"],time() + (60 * 30),'/');
										
										
									 }
									
									 
									
						
							
							print "login!";
						} else {
							print "ERROR: username or password did not match.";
						}
					}else{
						print "ERROR: username or password did not match.";
					}
	break;
	
	
	case "check_logout_admin";

									setcookie('username','',time()-60*60*24,'/');
									setcookie('Fullname','',time()-60*60*24,'/');
									print "logout!";
	
	
	break;
	
	
	
	
	}
	

}
	

?>
