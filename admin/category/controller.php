
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
		if(isset($_POST['save'])){


		if ( $_POST['CATEGORY'] == "" ) {
			$messageStats = false;
			message("All field is required!","error");
			redirect('index.php?view=add');
		}else{	
			$category = New Category();
			$category->Categories	= $_POST['CATEGORY'];
			$category->StoreID	= $_SESSION['ADMIN_USERID'];
			$category->create();

			message("New [". $_POST['CATEGORY'] ."] Has Been Added!", "success");
			redirect("index.php");
			
		}
		}

	}

	function doEdit(){
		if(isset($_POST['save'])){

			$category = New Category();
			$category->Categories	= $_POST['CATEGORY'];
			$category->update($_POST['CATEGORYID']);

			message("[". $_POST['CATEGORY'] ."] Has Been Updated!", "success");
			redirect("index.php");
		}

	}


	function doDelete(){
		// if (isset($_POST['selector'])==''){
		// message("Select a records first before you delete!","error");
		// redirect('index.php');
		// }else{

			$id = $_GET['id'];

			$category = New Category();
			$category->delete($id);

			message("Category Has Been Deleted!","info");
			redirect('index.php');

		// $id = $_POST['selector'];
		// $key = count($id);

		// for($i=0;$i<$key;$i++){

		// 	$category = New Category();
		// 	$category->delete($id[$i]);

		// 	message("Category already Deleted!","info");
		// 	redirect('index.php');
		// }
		// }
		
	}
?>