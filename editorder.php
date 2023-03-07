<?php
session_start();
if(isset($_SESSION['user_info'] ))
{
   include_once ('header.php');
   require_once('dbconnect.php');
        ?>
    <!--  we include header
          connect to database 
          start session        -->
<!-- __________________________________________________________________ -->
        
<!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2><i class="fa fa-tasks"></i> orders</h2>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-8">
                        <!-- Form Elements -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-plus-circle"></i> edit Orders
                            </div>
                            <div class="panel-body">
                                <div class="row">  

                                <?php 
                                    if( isset($_GET['action'],$_GET['id']) && $_GET['action']=='edit')
                                    { 
                                    $Id=$_GET['id'];
                                    $sql="select * from orders where id=:order";
                                    $stm= $conn -> prepare($sql);
                                    $stm->execute(array("order"=>$Id)); 
                                    if( $stm->rowCount())
                                        {
                                        foreach( $stm->fetchall() as $row)
                                        {
                                        $id  =$row['id']; 
                                        $quantity  =$row['quantity']; 
                                        $product_id = $row['product_id'];

                if(isset($_POST['addorder'])) // check if data pass by post method
                {
                   $quantity=trim($_POST['quantity']);
                   $product_id=$_POST['product_id'];
                   $error=array();
                   if(!is_numeric($quantity))
                   {
                       $error['quantity']=" Name must be string";
                   }
                   if(empty($error)) // sure if any error don't found
                   {   // start add to orders table
                       $sql="update  orders set quantity=?,product_id=? where id=?";
                       $stm= $conn->prepare($sql);
                       $stm->execute(array( $quantity,$product_id,$id)); 
                       if($stm->rowCount())
                       {
                        echo "<script>
                        alert('One Row Updated');
                        window.open('orders.php#table','_self');
                         </script> 
                        ";
                       }
                       else{
                           echo "<div class='alert-danger'> Row not inserted </div>";
                       }
                   }
               }
                ?> 
                                    <div class="col-md-12">
                                        <form role="form" action="" method="post">
                                        <input type="hidden" name="id" value="<?php echo $id ?>">
                                        <div class="form-group">
                                        <label>Quantity</label>
                                        <input type="number" value="<?php echo $quantity ?>" name="quantity" placeholder=" Please Enter  quantity "
                                            class="form-control" />
                                         <i style="color: red;">
                                            <?php if(isset( $errors['quantity'] )) echo  $errors['quantity']  ?>
                                        </i> 
                                       </div>
                                       <!-- ---------------------- -->
                                       <div class="form-group">
                                        <label>product Type</label>
                                        <select class="form-control" name="product_id">
                                            <?php    
                                        $sql="select * from products " ;
                                        $stm = $conn->prepare($sql);
                                        $stm->execute();
                                        foreach ($stm->fetchAll() as $row) {
                                            ?>
                                            <option value=<?php echo $row['id'] ?>>
                                            <?php echo  $row['name'] ?>
                                           </option>
                                        <?php
                                        } 
                                        ?>
                                        </select>
                                    </div>

                                            <div style="float:right;">
                                                <button type="submit" name="addorder" class="btn btn-primary">Add orders</button>
                                                <button type="reset" class="btn btn-danger">Cancel</button>
                                            </div>

                                    </div>
                                    </form>
                                <?php  }}} ?>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <hr />
                
                
                    <!-- /. ROW  -->
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
       
    </div>

    <!-- /. WRAPPER  -->
    <?php
   include_once ('footer.php');
}
else
    {
       header("location:../login.php");
    }
        ?>

