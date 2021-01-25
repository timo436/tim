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
	
	case 'edit' :
	doEdit();
	break; 
	
	case 'delete' :
	doDelete();
	break;

	case 'photos' :
	doupdateimage();
	break;
   
   
    case 'addfiles' :
	doAddFiles();
	break;

	case 'approve' :
	doApproved();
	break;

	case 'checkid' :
	Check_StudentID();
	break;
	

	}
   
	function doInsert(){
		global $mydb;
		if(isset($_POST['save'])){
 		    
 		    $filename = UploadImage("Image1");
			$Image1 = "photos/". $filename ;

			$filename = UploadImage("Image2");
			$Image2 = "photos/". $filename ;

			$filename = UploadImage("Image3");
			$Image3 = "photos/". $filename ;




					@$DateExpire = date_format(date_create($_POST['DateExpire']),'Y-m-d');

					$product = New Product(); 
					$product->ProductName 		= $_POST['ProductName'];
					$product->Description		= $_POST['Description']; 
					$product->Price				= $_POST['Price'];  
					$product->DateExpire		=  @$DateExpire;
					$product->CategoryID		= $_POST['CategoryID'];
					$product->StoreID			= $_SESSION['ADMIN_USERID'];
					$product->Image1			=  $Image1;
					$product->Image2			=  $Image2;
					$product->Image3			=  $Image3;
					$product->create(); 

					$productID = $mydb->insert_id();

					$sql ="INSERT INTO `tblinventory` (`ProductID`) VALUES ('{$productID}')";
					$mydb->setQuery($sql);
					$mydb->executeQuery();
 

					message("Product Added Successfully!", "success");
					redirect("index.php");
 
		 }
 } 


	function doEdit(){
	if(isset($_POST['save'])){

			// $filename = UploadImage("Attachment1");
			// $attachment1 = "photos/". $filename ;

			// $filename = UploadImage("Attachment2");
			// $attachment2 = "photos/". $filename ;

			// $filename = UploadImage("Attachment3");
			// $attachment3 = "photos/". $filename ;
		
 		    $filename = UploadImage("Image1");
			$Image1 = "photos/". $filename ;

			$filename = UploadImage("Image2");
			$Image2 = "photos/". $filename ;

			$filename = UploadImage("Image3");
			$Image3 = "photos/". $filename ;

		


		 

			@$DateExpire = date_format(date_create($_POST['DateExpire']),'Y-m-d');


			$product = New Product(); 
			$product->ProductName 		= $_POST['ProductName'];
			$product->Description		= $_POST['Description']; 
			$product->Price				= $_POST['Price'];  
			$product->DateExpire		=  @$DateExpire;
			$product->CategoryID		= $_POST['CategoryID'];
			$product->StoreID			= $_SESSION['ADMIN_USERID']; 
			if ($Image1=='' || $Image1=='photos/') {
			# code...
			}else{
				
				$product->Image1			=  $Image1;

			}
			if ($Image2=='' || $Image2=='photos/') {
			# code...
			}else{ 
				$product->Image2			=  $Image2;

			}
			if ($Image3=='' || $Image3=='photos/') {
			# code...
			}else{ 
				$product->Image3			=  $Image3;

			}





			$product->update($_POST['ProductID']);


			message("Product Has Been Updated!", "success");
			// redirect("index.php?view=view&id=".$_POST['EMPLOYEEID']);
			redirect("index.php?view=edit&id=".$_POST['ProductID']);
	     
  	
	 
	}

} 
	function doDelete(){
		global $mydb;
		
		// if (isset($_POST['selector'])==''){
		// message("Select the records first before you delete!","error");
		// redirect('index.php');
		// }else{

		// $id = $_POST['selector'];
		// $key = count($id);

		// for($i=0;$i<$key;$i++){

		// 	$subj = New Student();
		// 	$subj->delete($id[$i]);

		
				$id = 	$_GET['id'];

				$product = New Product();
	 		 	$product->delete($id);

	 		 	$sql = "DELETE FROM tblinventory WHERE ProductID=".$id;
	 		 	$mydb->setQuery($sql);
	 		 	$mydb->executeQuery();


	 		 	$sql = "DELETE FROM `tblstockin`  WHERE ProductID=".$id;
				$mydb->setQuery($sql);
				$mydb->executeQuery();

				$sql = "DELETE FROM `tblstockout`  WHERE ProductID=".$id;
				$mydb->setQuery($sql);
				$mydb->executeQuery();

			 
		
		// }
			message("Product Deleted!","success");
			redirect('index.php');
		// }

		
	}

	function UploadImage($imgname=""){
			$target_dir = "photos/";
		    $target_file = $target_dir  . basename($_FILES[$imgname]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			
			
			if($imageFileType != "jpg" || $imageFileType != "png" || $imageFileType != "jpeg"
				|| $imageFileType != "gif" || $imageFileType != "docs" || $imageFileType != "mp4") {
				 if (move_uploaded_file($_FILES[$imgname]["tmp_name"], $target_file)) {
					return   basename($_FILES[$imgname]["name"]);
				}else{
					// echo "Error Uploading File";
					// exit;
				}
			}else{
					// echo "File Not Supported";
					// exit;
	 }
}
 
//   function UploadImage(){
// 			$target_dir = "photos/";
// 			$target_file = $target_dir . date("dmYhis") . basename($_FILES["picture"]["name"]);
// 			$uploadOk = 1;
// 			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			
			
// 			if($imageFileType != "jpg" || $imageFileType != "png" || $imageFileType != "jpeg"
// 		|| $imageFileType != "gif" ) {
// 				 if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
// 					return  date("dmYhis") . basename($_FILES["picture"]["name"]);
// 				}else{
// 					echo "Error Uploading File"; 
// 				}
// 			}else{
// 					echo "File Not Supported"; 
// 				}
// } 

	function doupdateimage(){
 
			$errofile = $_FILES['photo']['error'];
			$type = $_FILES['photo']['type'];
			$temp = $_FILES['photo']['tmp_name'];
			$myfile =$_FILES['photo']['name'];
		 	$location="photo/".$myfile;


		if ( $errofile > 0) {
				message("No Image Selected!", "error");
				redirect("index.php?view=view&id=". $_GET['id']);
		}else{
	 
				@$file=$_FILES['photo']['tmp_name'];
				@$image= addslashes(file_get_contents($_FILES['photo']['tmp_name']));
				@$image_name= addslashes($_FILES['photo']['name']); 
				@$image_size= getimagesize($_FILES['photo']['tmp_name']);

			if ($image_size==FALSE ) {
				message("Uploaded file is not an image!", "error");
				redirect("index.php?view=view&id=". $_GET['id']);
			}else{
					//uploading the file
					move_uploaded_file($temp,"photo/" . $myfile);
		 	
					 

						$stud = New Student();
						$stud->StudPhoto	= $location;
						$stud->studupdate($_POST['StudentID']);
						redirect("index.php?view=view&id=". $_POST['StudentID']);
						 
							
					}
			}
			 
		}
function doApproved(){
global $mydb;
	if (isset($_POST['submit'])) {
		# code...
		$id = $_POST['JOBREGID'];
		$applicantid = $_POST['APPLICANTID'];

		$remarks = $_POST['REMARKS'];
		$sql="UPDATE `tbljobregistration` SET `REMARKS`='{$remarks}',PENDINGAPPLICATION=0,HVIEW=0,DATETIMEAPPROVED=NOW() WHERE `REGISTRATIONID`='{$id}'";
		$mydb->setQuery($sql);
		$cur = $mydb->executeQuery();

		if ($cur) {
			# code...
			$sql = "SELECT * FROM `tblfeedback` WHERE `REGISTRATIONID`='{$id}'";
			$mydb->setQuery($sql);
			$res = $mydb->loadSingleResult();
			if (isset($res)) {
				# code...
				$sql="UPDATE `tblfeedback` SET `FEEDBACK`='{$remarks}' WHERE `REGISTRATIONID`='{$id}'";
				$mydb->setQuery($sql);
				$cur = $mydb->executeQuery();
			}else{
				$sql="INSERT INTO `tblfeedback` (`APPLICANTID`, `REGISTRATIONID`,`FEEDBACK`) VALUES ('{$applicantid}','{$id}','{$remarks}')";
				$mydb->setQuery($sql);
				$cur = $mydb->executeQuery(); 

			}

			message("Applicant is calling for an interview.", "success");
			redirect("index.php?view=view&id=".$id); 
		}else{
			message("cannot be sve.", "error");
			redirect("index.php?view=view&id=".$id); 
		}


	}
}

 
?>