<?php 
require_once ("include/initialize.php"); 
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add' :
	addProduct();
	break;
	
	case 'edit' :
	doEdit();
	break; 
	
	case 'delete' :
	doDelete();
	break;

	case 'submitorder' :
	doSubmitOrder();
	break;
  
} 

function addProduct(){
global $mydb;
    $productID = $_POST['ProductID'];
	$sql ="SELECT * FROM tblproduct p, tblcategory c WHERE p.CategoryID=c.CategoryID AND ProductID = '{$productID}'";
	$mydb->setQuery($sql);
	$cur = $mydb->executeQuery();
	$maxrow = $mydb->num_rows($cur);

	if ($maxrow>0) {
		# code...
		$res = $mydb->loadSingleResult(); 

		$pid = $res->ProductID;
		$product = $res->ProductName . ' | ' . $res->Description . ' | '.$res->Categories;
		$price = $res->Price;
	    $q = $_POST['QTY'.$pid];
		$subtotal = $price * $q;
		addtocart($pid,$product,$price,$q,$subtotal);
	}

	redirect("index.php?q=cart");
	
}
function doSubmitOrder(){

	global $mydb;

		$autonum = New Autonumber();
		$res = $autonum->set_autonumber('ORDERNO');
		//$orderno = $res->AUTO;
		$orderno = hash('ripemd160', date("Y-m-d h:i:sa"));
		$totalamount = 0;
		$zz = $_GET['zz']; //payment
		$xx = $_GET['xx'];	//reference
		$cc = $_GET['cc'];
		
		if (!empty($_SESSION['gcCart']))
		{
			$count_cart = count($_SESSION['gcCart']); 
			for ($i=0; $i < $count_cart  ; $i++) { 

			$customerID = $_SESSION['CustomerID'];
			$productID = $_SESSION['gcCart'][$i]['productID'];
			$qty = $_SESSION['gcCart'][$i]['qty']; 

			$sql="SELECT * FROM `tblinventory` WHERE `ProductID`='{$productID}'";
				$mydb->setQuery($sql);
				$row = $mydb->loadSingleResult();

				$remaining = $row->Remaining - $qty;
				$sold = $row->Sold + $qty; 


				$sql = "INSERT INTO `tblstockout`  (`CustomerID`, `ProductID`, `Quantity`, `DateSold`,OrderNO,HView, Payment_Type, Payment_Reference, Payment_Contact) VALUES('{$customerID}','{$productID}','{$qty}',Now(),'{$orderno}',1, '{$zz}', '{$xx}', '{$cc}')";
				$mydb->setQuery($sql);
				$mydb->executeQuery(); 

				$totalamount += $_SESSION['gcCart'][$i]['subtotal'];

			}

				$sql = "INSERT INTO `tblsummary` (`OrderNo`, `TotalAmount`, `TransDate`) VALUES ('{$orderno}','{$totalamount}',NOW())";
				$mydb->setQuery($sql);
				$mydb->executeQuery(); 

			$autonum = New Autonumber(); 
			$autonum->auto_update('ORDERNO');

			unset($_SESSION['gcCart']);

			message("Orders Created Successfully!", "success");

			redirect("customer/index.php");

		}
}
 

// if (isset($_POST['updateCart'])) {
// 	# code...  
// 	$productID=$_POST['ProductID']; 
// 	$qty=intval(isset($_POST['QTY']) ? $_POST['QTY'] : "");  
// 	editproduct($productID,$qty); 
      
// }

// if (isset($_POST['deleteCart'])) {
// 	# code...  
// 	$productID=$_POST['ProductID'];  
// 	removetocart($productID); 
      
// }
?>