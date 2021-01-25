<style type="text/css">
  .stretch img{
    width: 100%;
    height: 200px;
  }
  .slides > li > img {
    width: 100%;
    height: 480px;
  }
  .item > img{
    width: 100%;
    height: 4%;
  }
</style>
  <section id="slider">
   <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div id="slider-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
              <li data-target="#slider-carousel" data-slide-to="1"></li>
              <li data-target="#slider-carousel" data-slide-to="2"></li>
            </ol>
            
            <div class="carousel-inner">
              <div class="item active">
                <div class="col-sm-6">
                  <h1>Xelina's Closet</h1>
                  <h2></h2>
                  <p></p>
                 
                </div>
                <div class="col-sm-6">
                  <img src="img/bg2.jpg" class="girl img-responsive" width="150%" alt="" />
                </div>
              </div>
              <div class="item">
                <div class="col-sm-6">
                  <h1>Xelina's Closet</h1>
                  <h2></h2>
                  <p></p>
                 
                </div>
                <div class="col-sm-6">
                  <img src="img/bg2.jpg" class="girl img-responsive" width="100%" alt="" />
                </div>
              </div>
              
              <div class="item">
                <div class="col-sm-6">
                  <h1>Xelina's Closet</h1>
                  <h2></h2>
                  <p></p>
                 
                </div>
                <div class="col-sm-6">
                <img src="img/bg2.jpg" class="girl img-responsive" width="100%" alt="" />
                </div>
              </div>
              
            </div>
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
              <i class="fa fa-angle-left"></i>
            </a>
            <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
              <i class="fa fa-angle-right"></i>
            </a>
          </div>
          
        </div>
      </div>
    </div>
  </section>
  </section>
  <section class="section-padding gray-bg">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-title text-center">
            <h2 >Product Categories</h2>  
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 ">
          <?php 
            $sql = "SELECT * FROM `tblcategory`";
            $mydb->setQuery($sql);
            $cur = $mydb->loadResultList();

            foreach ($cur as $result) {
              echo '<div class="col-md-3" style="font-size:15px;padding:5px">* <a href="'.web_root.'index.php?q=category&search='.$result->CategoryID.'">'.$result->Categories.'</a></div>';
            }

          ?>
        </div>
      </div>
 
    </div>
  </section>    
  <section id="content-3-10" class="content-block data-section nopad content-3-10">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active"> 
        <img src="<?php echo web_root; ?>plugins/home-plugins/img/slides/1.jpg" alt="Los Angeles" style="height: 450px; " >
      </div>
     <?php 
          $sql ="SELECT * FROM tblproduct";
          $mydb->setQuery($sql);
          $res = $mydb->loadResultList();

          foreach ($res as $row) {
          echo '<div class="item">
                <img src="admin/products/'.$row->Image1.'" alt="'.$row->ProductName.'" style="height: 450px;"  >
              </div>';
          }
      ?>
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
</section>
  
  <div class="about home-about">
        <div class="container">
          <h2 style="text-align: center;">Products</h2>
            
            <div class="row">
  <?php 
          $sql ="SELECT * FROM tblproduct";
          $mydb->setQuery($sql);
          $res = $mydb->loadResultList();

          foreach ($res as $row) {

  ?>
        
         <div class="col-md-4">
                <!-- Heading and para -->
                <div class="block-heading-two">
                  <h3><span><a href="index.php?q=products&id=<?php echo $row->ProductID;?>"><?php echo $row->ProductName;?></a></span></h3>
                </div>
                <p><?php echo $row->Description;?></p>
              </div>       
  <?php
          }
  ?>
 
              
            </div>
             
      </div>
      
    </div>