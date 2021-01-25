<?php
	 if(!isset($_SESSION['ADMIN_USERID'])){
      redirect(web_root."admin/index.php");
     }

?> 
	<div class="row">
    <div class="col-lg-12">
            <h1 class="page-header">Sales <a href="index.php?view=add" class="btn btn-primary btn-xs" style = 'display: none;'>  <i class="fa fa-plus-circle fw-fa"></i> Register New Product</a> </h1>
       		</div>
        	<!-- /.col-lg-12 -->
   		 </div>
                
 
						<form class="wow fadeInDownaction" action="controller.php?action=delete" Method="POST">   		
							<table id="dash-table" class="table table-striped  table-hover table-responsive" style="font-size:12px" cellspacing="0">

							  <thead>
							  	<tr>
									<!-- <th>Store Name</th> -->
									<th>Order No</th>
									<th>Total Amount</th>
									<th>Date</th>
							  	</tr>	
							  </thead> 
							  <tbody>
							  	<?php   
							  		// $mydb->setQuery("SELECT * 
											// 			FROM  `tblusers` WHERE TYPE != 'Customer'");
							  	// `ProductID`, `ProductName`, `Description`, `Price`, `DateExpire`,Categories,StoreName
							  	// if ($_SESSION['ADMIN_ROLE']=='Administrator') {
							  	// 	# code...
							  	// 	$sql ="SELECT * FROM `tblproduct` p,`tblinventory` i, `tblcategory` c,`tblstore` s WHERE p.`ProductID`=i.`ProductID` AND p.`CategoryID`=c.`CategoryID` AND p.`StoreID`=s.`StoreID`";
							  	// }else{
							  		$sql ="SELECT * FROM tblsummary";
							  		$totalXD = 0;
							  	// }
							  		$mydb->setQuery($sql);
							  		$cur = $mydb->loadResultList();

									foreach ($cur as $result) { 

										#	print_r($result);

	
									$totalXD += $result->TotalAmount;
							  		echo '<tr>';
							  		// echo '<td width="5%" align="center"></td>';
							  		// echo '<td>'. $result->StoreName.'</td>';
							  		echo '<td>'. $result->OrderNo.'	</td>';
							  		echo '<td>'. $result->TotalAmount.'</td>';
							  		echo '<td>'. $result->TransDate.'</td>';
							  		echo '</tr>';

							  	} 
							  	?>
							  </tbody>
							  <tfoot>
							<tr>
							<td></td>
							<td><h=><?php echo $totalXD;?></h=></td>
							</tr>
							</tfoot>

							  
								
							</table>
 
							 
							</form>
       
                 
 