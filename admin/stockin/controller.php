
<?php
require_once ("../../include/initialize.php");
 	 if (!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/index.php");
     }


$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add' :
	doInsert();
	break;
	
	case 'edit' :
	doEdit();
	break;
	
	case 'delete' :
	doDelete();
	break;

 
	}
   
	function doInsert(){
		global $mydb; 
		$product_quantity=0;
		$total_quanity=0;

		if(isset($_POST['btnSubmit'])){ 
		if ( $_POST['Quantity'] == "" || $_POST['Quantity'] == 0) {
			$messageStats = false;
			message("All field is required!","error");
			redirect('index.php');
		}else{	
			$ProductID = $_POST['ProductID'];
			$Quantity = $_POST['Quantity'];
		 	
			$sql = "SELECT  * FROM `tblinventory` WHERE `ProductID`='{$ProductID}'";
		 	$mydb->setQuery($sql);
		 	$cur = $mydb->executeQuery(); 
		 	$maxrow = $mydb->num_rows($cur);
		 	if ($maxrow > 0) {
		 		$row  = $mydb->loadSingleResult();
		 	    $total_quanity = $row->Stocks + $Quantity;
		 		$product_quantity = $row->Remaining + $Quantity;
		 		# code...
				$sql = "UPDATE `tblinventory` SET `Stocks`= '{$product_quantity}', Remaining =  '{$total_quanity}' WHERE `ProductID`='{$ProductID}'";
				$mydb->setQuery($sql);
				$mydb->executeQuery(); 

				$sql = "INSERT INTO `tblstockin` (`ProductID`, `Quantity`, `DateReceive`) 
				VALUES ('{$ProductID}','{$Quantity}',Now())";
				$mydb->setQuery($sql);
				$mydb->executeQuery();

				message("Stock Has Been Added!", "success");
				redirect("index.php");
		 	}
			
		}
		}

	}

	function doEdit(){
		global $mydb;
		$product_quantity=0;
		$total_quanity=0;
		if(isset($_POST['btnSubmit'])){ 
 
		if ( $_POST['Quantity'] == "" || $_POST['Quantity'] == 0) {
			$messageStats = false;
			message("All field is required!","error");
			redirect('index.php');
		}else{	
			$ProductID = $_POST['ProductID'];
			$StockinID = $_POST['StockinID'];
			$Trans_Quantity = $_POST['TransQuantity'];
			$Quantity = $_POST['Quantity'];


			$sql = "SELECT * FROM `tblinventory` WHERE `ProductID`='{$ProductID}'";
		 	$mydb->setQuery($sql);
		 	$cur = $mydb->executeQuery(); 
		 	$maxrow = $mydb->num_rows($cur);
		 	if ($maxrow > 0) {
		 		$row  = $mydb->loadSingleResult();

		 		 $total_quanity = $row->Remaining - $Trans_Quantity;
		 		 $total_quanity = $total_quanity + $Quantity;

		 		 $product_quantity = $row->Stocks - $Trans_Quantity;
		 		 $product_quantity = $product_quantity + $Quantity;
		 		# code...
				$sql = "UPDATE `tblinventory` SET `Stocks`= '{$product_quantity}',Remaining='{$total_quanity}' WHERE `ProductID`='{$ProductID}'";
				$mydb->setQuery($sql);
				$mydb->executeQuery(); 

				$sql = "UPDATE `tblstockin` SET `Quantity` ='{$Quantity}' WHERE `StockinID`='{$StockinID}'";
				$mydb->setQuery($sql);
				$mydb->executeQuery();

				message("Stock Has Been Updated!", "success");
				redirect("index.php");
		 	}

			
			
		}
		}


	}


	function doDelete(){
		global $mydb;
		// if (isset($_POST['selector'])==''){
		// message("Select a records first before you delete!","error");
		// redirect('index.php');
		// }else{

		 

		// $id = $_POST['selector'];
		// $key = count($id);

		// for($i=0;$i<$key;$i++){

		// 	$category = New Category();
		// 	$category->delete($id[$i]);

		// 	message("Category already Deleted!","info");
		// 	redirect('index.php');
		// }
		// }
		$ProductID = $_GET['ProductID'];
		$StockinID = $_GET['id'];
		$Trans_Quantity = $_GET['TransQuantity']; 

		$sql = "SELECT * FROM `tblinventory` WHERE `ProductID`='{$ProductID}'";
		$mydb->setQuery($sql);
		$cur = $mydb->executeQuery(); 
		$maxrow = $mydb->num_rows($cur);
		if ($maxrow > 0) {
			$row  = $mydb->loadSingleResult();

			 $total_quanity = $row->Remaining - $Trans_Quantity;    

			 $product_quantity = $row->Stocks - $Trans_Quantity; 
			# code...
		$sql = "UPDATE `tblinventory` SET `Stocks`= '{$product_quantity}',Remaining='{$total_quanity}' WHERE `ProductID`='{$ProductID}'";
		$mydb->setQuery($sql);
		$mydb->executeQuery(); 

		$sql = "DELETE FROM `tblstockin`  WHERE `StockinID`='{$StockinID}'";
		$mydb->setQuery($sql);
		$mydb->executeQuery();

		message("Stock Has Been Deleted!", "success");
		redirect("index.php");
		}

		
	}
?>