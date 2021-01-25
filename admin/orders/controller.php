<?php
require_once ("../../include/initialize.php");
if(!isset($_SESSION['ADMIN_USERID'])){
  redirect(web_root."admin/index.php");
 }

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add' :
	doInsert();
	break;
	
	case 'confirm' :
	doConfirm();
	break; 
	
	case 'cancel' :
	doCancel();
	break;

	case 'payment' :
	doPayment();
	break;
 

	}
   
	function doInsert(){
		global $mydb;
		if(isset($_POST['CartSubmit'])){
		$autonum = New Autonumber();
		$res = $autonum->set_autonumber('ORDERNO');
		$orderno = $res->AUTO;

			$stocks = 0;
			$sold = 0;
			$remaining = 0;
			  if (!empty($_SESSION['admin_gcCart'])){   
                $count_cart = count($_SESSION['admin_gcCart']); 
                    for ($i=0; $i < $count_cart  ; $i++) { 

                    	$customerID = $_POST['CustomerID'];
                    	$productID = $_SESSION['admin_gcCart'][$i]['productID'];
                    	$qty = $_SESSION['admin_gcCart'][$i]['qty']; 

                    	$sql="SELECT * FROM `tblinventory` WHERE `ProductID`='{$productID}'";
                     	$mydb->setQuery($sql);
                     	$row = $mydb->loadSingleResult();

                     	$remaining = $row->Remaining - $qty;
                     	$sold = $row->Sold + $qty; 


                    	$sql = "INSERT INTO `tblstockout`  (`CustomerID`, `ProductID`, `Quantity`, `DateSold`,Status,OrderNo) VALUES('{$customerID}','{$productID}','{$qty}',Now(),'Confirmed','{$orderno}')";
                    	$mydb->setQuery($sql);
                    	$mydb->executeQuery();

                    	$sql ="UPDATE `tblinventory` SET  `Sold`='{$sold}', `Remaining`='{$remaining}'  WHERE `ProductID`='{$productID}'";
                    	$mydb->setQuery($sql);
                    	$mydb->executeQuery();


                    }
                    unset($_SESSION['admin_gcCart']);

					$autonum = New Autonumber(); 
					$autonum->auto_update('ORDERNO');

                    message("Orders Created Successfully!", "success");
				// redirect("index.php?view=view&id=".$_POST['EMPLOYEEID']);
		    	   redirect("index.php");
                }else{
                	message("Transaction Is Invalid.", "success");
				// redirect("index.php?view=view&id=".$_POST['EMPLOYEEID']);
		    	   redirect("index.php?view=add");

                }

		}

	} 

	function doConfirm(){
		global $mydb;

			$stockoutID = $_GET['id'];
			$productID = $_GET['ProductID'];
			$qty = $_GET['qty'];
			$ordernumberrr = $_GET['OrderNo'];
			$Payment_Contact = $_GET['Payment_Contact'];


			$sql="SELECT * FROM `tblinventory` WHERE `ProductID`='{$productID}'"; 
			$mydb->setQuery($sql);
			$row = $mydb->loadSingleResult();

			$remaining = $row->Remaining - $qty;
			$sold = $row->Sold + $qty; 


			//$sql = "UPDATE `tblstockout`  SET Status  = 'Confirmed' WHERE StockoutID='{$stockoutID}'";
			$sql = "UPDATE `tblstockout`  SET Status  = 'Confirmed' WHERE OrderNo='{$ordernumberrr}'";
			$mydb->setQuery($sql);
			$mydb->executeQuery();

			$sql ="UPDATE `tblinventory` SET  `Sold`='{$sold}', `Remaining`='{$remaining}'  WHERE `ProductID`='{$productID}'";
			$mydb->setQuery($sql);
			$mydb->executeQuery();

			itexmo($Payment_Contact, "Orders Has Been Confirmed!");

			message("Orders Has Been Confirmed!", "success");
			// redirect("index.php?view=view&id=".$_POST['EMPLOYEEID']);
			redirect("index.php");

	}

	function doCancel(){
			global $mydb;
			$stockoutID = $_GET['id'];
			$ordernumberrr = $_GET['OrderNo'];
			$Payment_Contact = $_GET['Payment_Contact'];

			//$sql = "UPDATE `tblstockout`  SET Status  = 'Cancelled' WHERE StockoutID='{$stockoutID}'";
			$sql = "UPDATE `tblstockout`  SET Status  = 'Cancelled' WHERE OrderNo='{$ordernumberrr}'";
			$mydb->setQuery($sql);
			$mydb->executeQuery(); 

			itexmo($Payment_Contact, "Orders Has Been Cancelled!");

			message("Orders Has Been Cancelled!", "success");
			// redirect("index.php?view=view&id=".$_POST['EMPLOYEEID']);
			redirect("index.php");

	}
	function doPayment(){
			global $mydb;
			$stockoutID = $_GET['id'];
			$sql = "UPDATE `tblstockout`  SET Status  = 'Waiting Payment' WHERE StockoutID='{$stockoutID}'";
			$mydb->setQuery($sql);
			$mydb->executeQuery(); 

			message("Account Number Has Been Sent", "success");
			// redirect("index.php?view=view&id=".$_POST['EMPLOYEEID']);
			redirect("index.php");

	}
?>

<?php
//##########################################################################
// ITEXMO SEND SMS API - PHP - CURL-LESS METHOD
// Visit www.itexmo.com/developers.php for more info about this API
//##########################################################################
function itexmo($number,$message){
		$url = 'https://www.itexmo.com/php_api/api.php';
		$itexmo = array('1' => $number, '2' => $message, '3' => 'TR-JHETR718537_DRWD6', 'passwd' => 'kvs(fpsbtj');
		$param = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($itexmo),
			),
		);
		$context  = stream_context_create($param);
		return file_get_contents($url, false, $context);
}
//##########################################################################
if (isset($_POST['sendSms'])) {

$stockoutID = $_POST['stockoutID'];
$send_id = $_POST['sendId'];
$sql="SELECT * FROM tblcustomer WHERE CustomerID ='$send_id'";
$fetch = mysqli_fetch_assoc($sql);
$phone = $fetch['CustomerContact'];

$result = itexmo($phone,"Your Order Has Been Confirm - Xelina's Closet","", "");
if ($result == ""){
echo "iTexMo: No response from server!!!
Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.	
Please CONTACT US for help. ";	
}else if ($result == 0){
	$sql = "UPDATE `tblstockout`  SET Status  = 'Confirmed' WHERE CustomerID='{$stockoutID}'";
	echo "<script>alert('Message Sent!')</script>";
	redirect("index.php");
}
else{	
echo "Error Num ". $result . " was encountered!";
}
}

if (isset($_POST['cancelSms'])) {

$stockoutID = $_POST['stockoutID'];
$send_id = $_POST['sendId'];
$sql="SELECT * FROM tblcustomer WHERE CustomerID ='$send_id'";
$fetch = mysqli_fetch_assoc($sql);
$phone = $fetch['CustomerContact'];

$result = itexmo($phone,"Your Order Has Been Cancelled - Xelina's Closet","", "");
if ($result == ""){
echo "iTexMo: No response from server!!!
Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.	
Please CONTACT US for help. ";	
}else if ($result == 0){
	$sql = "UPDATE `tblstockout`  SET Status  = 'Cancelled' WHERE CustomerID='{$stockoutID}'";
	echo "<script>alert('Message Sent!')</script>";
	redirect("index.php");
}
else{	
echo "Error Num ". $result . " was encountered!";
}
}

if (isset($_POST['paymentSms'])) {

$stockoutID = $_POST['stockoutID'];
$send_id = $_POST['sendId'];
$sql="SELECT * FROM tblcustomer WHERE CustomerID ='$send_id'";
$fetch = mysqli_fetch_assoc($sql);
$phone = $fetch['CustomerContact'];

$result = itexmo($phone,"Waiting For Payment ACCT# CONTACT# - Xelina's Closet","", "");
if ($result == ""){
echo "iTexMo: No response from server!!!
Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.	
Please CONTACT US for help. ";	
}else if ($result == 0){
	$sql = "UPDATE `tblstockout`  SET Status  = 'Waiting Payment' WHERE CustomerID='{$stockoutID}'";
	echo "<script>alert('Message Sent!')</script>";
	redirect("index.php");
}
else{	
echo "Error Num ". $result . " was encountered!";
}
}
?>