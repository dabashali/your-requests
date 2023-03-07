<?php
include_once('inc/header.php');
require_once('admin/dbconnect.php');
?>

    <!-- Page Content -->
    <!-- Single Starts Here -->
        <?php
    if(isset($_GET['action'],$_GET['id'])&$_GET['action']=="id"){
      $id=$_GET['id'];
      $sql="select * from products " ;
      $stm = $conn->prepare($sql);
      $stm->execute();
      if($stm->rowCount())
      foreach ($stm->fetchAll() as $row) {
      $ime=$row['image'];
    if($row['id']==$id){
?>
    <div class="single-product">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <div class="line-dec"></div>
              <h1>Single Product</h1>
            </div>
          </div>
          <div class="col-md-6">
              <div id="slider" class="flexslider">
              <img style="width:100%;border-radius:20px" src="admin/upload/<?php echo $row['image']; ?>"   />
              </div>
          </div>
          <div class="col-md-6">
              <div class="right-content">
              <h4><?php echo 'Product Name  :'. $row['name']; ?></h4>
              
              <h6>$<?php echo 'Price :'. $row['price']; ?></h6>
              <p><?php echo ' Description :'. $row['description']; ?> </p>
              <form action="contact.php?id=<?php echo $row['id'];  ?>&action=id" method="post">
              <input style="margin:30px" type="submit" class="button" value="Order Now!">
              </form>
              <div class="down-content">
                <div class="share">
                  <h6>
                    Share: <span><a href="#"><i class="fa fa-facebook"></i></a>
                                 <a href="#"><i class="fa fa-linkedin"></i></a>
                                 <a href="#"><i class="fa fa-twitter"></i></a>
                          </span>
                  </h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
       }}}
else
echo " Error Detected ";
?>
    <!-- Single Page Ends Here -->
    <!-- Similar Starts Here -->
    <div class="featured-items">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <div class="line-dec"></div>
              <h1>You May Also Like</h1>
            </div>
          </div>
          <div class="col-md-12">
            <div class="owl-carousel owl-theme">
            <?php
                   $sql="select * from products ";
                   $stm= $conn -> prepare($sql);
                   $stm->execute(); 
                   $y=0;
                    if( $stm->rowCount())
                   {
                     foreach( $stm->fetchall() as $row)
                     {
                      $y+=1;
                      $id=$row['id'];
                      $image_name=$row['image'];
                      $name=$row['name'];
                      $price=$row['price'];
                     ?>
                <a href="single-product.php?id=<?php echo $row['id'];  ?>&action=id">
                <div class="featured-item">
                      <?php 
                      if($image_name=="")
                        {
                        echo " error";
                        }
                      else 
                        {
                      ?>
                      <img style="height:120px;" src="assets/images/picture/<?php echo $image_name; ?>" alt="Item 1">
                      <?php 
                        }
                      ?>
                      <h4><?php echo  $name ?></h4>
                      <h6><?php echo '$' .$price ?></h6>
                    </div>
                    </a>
                  <?php 
                      }
                        }
                else
                {
                  echo " product not added";
                }
            ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Similar Ends Here -->
<?php
include_once('inc/footer.php');
?>

