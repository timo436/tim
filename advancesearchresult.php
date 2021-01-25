<?php 
	$searchfor = (isset($_GET['searchfor']) && $_GET['searchfor'] != '') ? $_GET['searchfor'] : '';
	
?>
<style type="text/css">
	/*    --------------------------------------------------
	:: General
	-------------------------------------------------- */
body {
	font-family: 'Open Sans', sans-serif;
	color: #353535;
}
.content {
	padding: 30px;
	min-height: 500px;
}
.content h1 {
	text-align: center;
}
.content .content-footer p {
	color: #6d6d6d;
    font-size: 12px;
    text-align: center;
}
.content .content-footer p a {
	color: inherit;
	font-weight: bold;
}

/*	--------------------------------------------------
	:: Table Filter
	-------------------------------------------------- */
.panel {
	border: 1px solid #ddd;
	background-color: #fcfcfc;
}
.panel .btn-group {
	margin: 15px 0 30px;
} 
.table-filter {
	background-color: #fff;
	border-bottom: 1px solid #eee;
}
.table-filter tbody tr:hover {
	cursor: pointer;
	background-color: #eee;
}
.table-filter tbody tr td {
	padding: 10px;
	vertical-align: middle;
	border-top-color: #eee;
}
.table-filter tbody tr.selected td {
	background-color: #eee;
}
.table-filter tr td:first-child {
	width: 38px;
}
.table-filter tr td:nth-child(2) {
	width: 35px;
}
 
.table-filter .star {
	color: #ccc;
	text-align: center;
	display: block;
}
.table-filter .star.star-checked {
	color: #F0AD4E;
}
.table-filter .star:hover {
	color: #ccc;
}
.table-filter .star.star-checked:hover {
	color: #F0AD4E;
}
.table-filter .media-photo {
	width: 35px;
}
.table-filter .media-body {
    display: block;
    /* Had to use this style to force the div to expand (wasn't necessary with my bootstrap version 3.3.6) */
}
.table-filter .media-meta {
	font-size: 11px;
	color: #999;
}
.table-filter .media .title {
	color: #2BBCDE;
	font-size: 14px;
	font-weight: bold;
	line-height: normal;
	margin: 0;
}
.table-filter .media .title span {
	font-size: .8em;
	margin-right: 20px;
}
.table-filter .media .title span.pagado {
	color: #5cb85c;
}
.table-filter .media .title span.pendiente {
	color: #f0ad4e;
}
.table-filter .media .title span.cancelado {
	color: #d9534f;
}
.table-filter .media .summary {
	font-size: 14px;
}
#myCarousel {
	margin-top: 5px;
}
.stretch img{ 
 width: 100%;
 height: 50%;
}
</style>
<div class="container">
	<div class="row">

		<section class="content">
			<div >
				<div class="btn-group">
					<?php 


					 $search = isset($_POST['SEARCH']) ? ($_POST['SEARCH']!='') ? $_POST['SEARCH'] : 'All' : 'All';
					 $company = isset($_POST['Store']) ? ($_POST['Store']!='') ? $_POST['Store'] : 'All' : 'All';
					 $category = isset($_POST['Category']) ? ($_POST['Category']!='') ? $_POST['Category'] : 'All' : 'All';

					switch ($searchfor) {
						case 'bystore':
							# code...
						echo 'Result : '  . $search . ' | Store : ' . $company;
							break;
						case 'advancesearch':
							# code... 
						echo 'Result : '  . $search . ' | Store : ' . $company . ' | category : ' . $category; 
						    break;
						case 'byfunction':
							# code... 
						echo 'Result : '  . $search . ' | category : ' . $category; 
						    break; 
						
						default:
							# code...
							break;
					}


					?>
				</div>
			</div>
			 
			<div class="col-md-6 ">  
						<div class="table-container">  

						    <?php  
									 $search = isset($_POST['SEARCH']) ? $_POST['SEARCH'] : '';
									 $store = isset($_POST['Store']) ? $_POST['Store'] : '';
									 $category = isset($_POST['CATEGORY']) ? $_POST['CATEGORY'] : '';
 
							    $sql = "SELECT * FROM tblinventory i,`tblstore` s,`tblproduct` p ,`tblcategory` c
							            WHERE i.ProductID=p.ProductID and s.StoreID=p.StoreID AND p.CategoryID=c.CategoryID AND Categories LIKE '%$category%' AND ProductName LIKE '%$search%' AND StoreName LIKE '%$store%' AND Remaining > 0" ;
							    $mydb->setQuery($sql);
							    $cur = $mydb->loadResultList();


							    foreach ($cur as $result) { 
							  ?>  

							<form class="" action="cartcontroller.php?action=add" method="POST">
							  		<div class="row">
							          <div class="panel panel-primary">
							              <div class="panel-header">
							                   <div style="border-bottom: 1px solid #ddd;padding: 10px;font-size: 20px;font-weight: bold;color: #000;margin-bottom: 5px;"><a href="<?php echo web_root.'index.php?q=viewjob&search='.$result->JOBID;?>"><?php echo $result->Categories ;?></a> 
							                  </div> 
							              </div>
							              <div class="panel-body contentbody">
							                    <div class="col-sm-8"> 
							                        <div class="col-sm-12">
							                            <p>Store :</p>
							                             <ul style="list-style: none;"> 
							                                <li><?php echo $result->StoreName ;?></li> 
							                            </ul> 
							                        </div>
							                        <div class="col-sm-12"> 
							                            <p>Product</p>
							                            <ul style="list-style: none;"> 
							                                 <li>Name : <?php echo $result->ProductName ;?></li> 
							                                 <li>Description : <?php echo $result->Description ;?></li> 
							                                 <li>Price :<?php echo $result->Price ;?></li> 
							                                 <li>Expired Date : <?php echo date_format(date_create($result->DateExpire),'M d, Y'); ?></li> 
							                                 <li>Remaining :<?php echo $result->Remaining ;?></li> 
							                            </ul> 
							                         </div>
							                        <div class="col-sm-12">
							                            <p>Location :  <?php echo  $result->StoreAddress ?></p>
							                            <p>Contact No :  <?php echo  $result->ContactNo ?></p>  
							                        </div>
							                    </div>
							                    <div class="col-sm-4">
							                    	<input type="hidden" name="ProductID" value="<?php echo  $result->ProductID ?>">
							                    	<input type="number" min="1" placeholder="Quantity" name="QTY<?php echo $result->ProductID ;?>" value="1" class="form-control" style="margin-bottom: 5px;">

							                    	<button type="submit"  class="btn btn-main btn-next-tab"><i class="fa fa-shopping-cart"></i> Order Now !</button> 

							                    	<div class="row stretch">
							                    		<!-- <img src=" <?php echo web_root.'admin/products/'. $result->Image1 ?>"> -->
							                    		 <div id="myCarousel" class="carousel slide" data-ride="carousel">
															    <!-- Indicators -->
															    <ol class="carousel-indicators">
															      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
															      <li data-target="#myCarousel" data-slide-to="1"></li>
															      <li data-target="#myCarousel" data-slide-to="2"></li>
															    </ol>

															    <!-- Wrapper for slides -->
															    <div class="carousel-inner">
															           <div class="item active">
									                                    <img src=" <?php echo web_root.'admin/products/'. $result->Image1 ?>" style="height: 150px;" >
									                                    </div>

									                                    <div class="item">
									                                    <img src=" <?php echo web_root.'admin/products/'. $result->Image2 ?>" style="height: 150px;" >
									                                    </div>
									                                  
									                                    <div class="item">
									                                    <img src=" <?php echo web_root.'admin/products/'. $result->Image3 ?>" style="height: 150px;" >
									                                    </div>
															    </div>

															    <!-- Left and right controls -->
															    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
															      <span class="glyphicon glyphicon-chevron-left"></span>
															      <span class="sr-only">Previous</span>
															    </a>
															    <a class="right carousel-control" href="#myCarousel" data-slide="next">
															      <span class="glyphicon glyphicon-chevron-right"></span>
															      <span class="sr-only">Next</span>
															    </a>
															  </div>

							                    	</div>

							                    </div>
							                </div> 
							              <div class="panel-footer"> 
							              </div>
							          </div> 
							      </div>
				    </form>	 
							<?php  } ?>  
				</div> 
			</div>
			<div class="col-md-6">
          <div>Store Location</div>
        <p><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3859.41750796494!2d120.96176265026781!3d14.68896588969593!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b4733aa6da17%3A0x8e12168f0f247f41!2s997%20Sta.%20Maria%2C%20Manila%2C%20Metro%20Manila!5e0!3m2!1sen!2sph!4v1605492779077!5m2!1sen!2sph" width="600" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></p>
        </div>   
		</section>
		
	</div>
</div>