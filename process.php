<?php  
require_once ("include/initialize.php");
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
switch ($action) { 
  
	case 'register' :
	doInsert();
	break;  


	case 'registerstore' :
	doInsertStore();
	break;  

	case 'login' :
	doLogin();
	break; 
	}
 
 
function doInsert() {
	if (isset($_POST['btnRegister'])) {   

			// $autonum = New Autonumber();
			// $auto = $autonum->set_autonumber('APPLICANT');
			 
		 	// `CustomerName`, `CustomerAddress`, `CustomerContact`, `Sex`, `Customer_Username`, `Customer_Password`
			$customer =New Customer(); 
			$customer->CustomerName 		= $_POST['CustomerName']; 
			$customer->CustomerAddress 		= $_POST['CustomerAddress'];
			$customer->Sex 					= $_POST['optionsRadios']; 
			$customer->Customer_Username	= $_POST['Customer_Username'];
			$customer->Customer_Password 	= sha1($_POST['Customer_Password']);
			$customer->CustomerContact 		= $_POST['CustomerContact']; 
			$customer->create(); 

			message("You are successfully registered to the site. You can login now!","success");
			redirect("index.php?q=success");

		 
}
}

	function doInsertStore(){
		global $mydb;
		if(isset($_POST['save'])){

 // `COMPANYNAME`, `COMPANYADDRESS`, `COMPANYCONTACTNO`
		if ( $_POST['StoreName'] == "" || $_POST['StoreAddress'] == "" || $_POST['ContactNo'] == "" ) {
			$messageStats = false;
			message("All field is required!","error");
			redirect('index.php?view=add');
		}else{	
			$store = New Store();
			$store->StoreName		= $_POST['StoreName'];
			$store->StoreAddress	= $_POST['StoreAddress'];
			$store->ContactNo		= $_POST['ContactNo']; 
			$store->create();

			$storID = $mydb->insert_id();

			$user = New User();
			$user->UserID 			= $storID;
			$user->FullName 		= $_POST['StoreName'];
			$user->Username			= $_POST['Username'];
			$user->Password			= sha1($_POST['Password']);
			$user->Role				="Store";
			$user->create();

			message("You are successfully registered to the site. You can login now!","success");
			redirect("index.php?q=success");
			
		}
		}

	}

 
function doLogin(){
	
	$email = trim($_POST['USERNAME']);
	$upass  = trim($_POST['PASS']);
	$h_upass = sha1($upass);
 
  //it creates a new objects of member
    $customer = new Customer();
    //make use of the static function, and we passed to parameters
    $res = $customer->CustomerAuthentication($email, $h_upass);
    if ($res==true) { 

       	message("You Are Now Successfully Login!","success");
       
       // $sql="INSERT INTO `tbllogs` (`USERID`,USERNAME, `LOGDATETIME`, `LOGROLE`, `LOGMODE`) 
       //    VALUES (".$_SESSION['USERID'].",'".$_SESSION['FULLNAME']."','".date('Y-m-d H:i:s')."','".$_SESSION['UROLE']."','Logged in')";
       //    mysql_query($sql) or die(mysql_error()); 
         redirect(web_root."customer/");
     
    }else{ 

    	$user = new User();
	    //make use of the static function, and we passed to parameters
	    $res = $user->userAuthentication($email, $h_upass);
	    if ($res==true) { 
	       message("You login as ".$_SESSION['ROLE'].".","success");
	      // if ($_SESSION['ROLE']=='Administrator' || $_SESSION['ROLE']=='Cashier'){

	        $_SESSION['ADMIN_USERID'] = $_SESSION['USERID'];
	        $_SESSION['ADMIN_FULLNAME'] = $_SESSION['FULLNAME'] ;
	        $_SESSION['ADMIN_USERNAME'] =$_SESSION['USERNAME'];
	        $_SESSION['ADMIN_ROLE'] = $_SESSION['ROLE'];
	        $_SESSION['ADMIN_PICLOCATION'] = $_SESSION['PICLOCATION'];

	        unset( $_SESSION['USERID'] );
	        unset( $_SESSION['FULLNAME'] );
	        unset( $_SESSION['USERNAME'] );
	        unset( $_SESSION['PASS'] );
	        unset( $_SESSION['ROLE'] );
	        unset($_SESSION['PICLOCATION']);

	         redirect(web_root."admin/index.php");
	      // } 
	    }else{
	      	echo "Account does not exist! Please contact Administrator.";
	        
	    } 
    } 
}
 
function UploadImage($jobid=0){
	$target_dir = "customer/photos/";
	$target_file = $target_dir . date("dmYhis") . basename($_FILES["picture"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	
	
	if($imageFileType != "jpg" || $imageFileType != "png" || $imageFileType != "jpeg"
|| $imageFileType != "gif" ) {
		 if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
			return  date("dmYhis") . basename($_FILES["picture"]["name"]);
		}else{
			message("Error Uploading File","error");
			// redirect(web_root."index.php?q=apply&job=".$jobid."&view=personalinfo");
			// exit;
		}
	}else{
			message("File Not Supported","error");
			// redirect(web_root."index.php?q=apply&job=".$jobid."&view=personalinfo");
			// exit;
		}
} 


?>