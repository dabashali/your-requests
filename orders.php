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
                                <i class="fa fa-plus-circle"></i> Add New Orders
                            </div>
                            <div class="panel-body">
                                <div class="row">  
                        <?php
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
                       $sql="insert into orders(quantity,product_id) values(?,?)";
                       $stm= $conn->prepare($sql);
                       $stm->execute(array( $quantity,$product_id)); 
                       if($stm->rowCount())
                       {
                           echo "<div class='alert-success'> Row inserted </div>";
                       }
                       else{
                           echo "<div class='alert-danger'> Row not inserted </div>";
                       }
                   }
               }
              
                ?> 
                                    <div class="col-md-12">
                                        <form role="form" action="" method="post">
                                        <div class="form-group">
                                        <label>Quantity</label>
                                        <input type="number" name="quantity" placeholder=" Please Enter  quantity "
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

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <hr />
                
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-tasks"></i> Orders
                            </div>
                            <?php 
                            if(isset($_GET['action'],$_GET['id']))
                            {
                                $id=$_GET['id'];
                                switch($_GET['action'])
                                {
                                    case "delete":
                                        $sql="delete from orders where id=:order";
                                        $stm= $conn->prepare($sql);
                                        $stm->execute(array("order"=>$id));
                                        if($stm->rowCount()==1)
                                        {
                                            echo "<div class='alert alert-success'> one Row deleted </div>";
                                        }
                                        break;
                                        default :
                                        echo " Error occured";
                    
                                }
                            }
                            
                            ?>
                            <div  id="table" class="panel-body">
                                <div class="table-responsive" style="overflow-x:auto;">
                                    <table id="table" class="table table-striped table-bordered table-hover "
                                        id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Quantity</th>
                                                <th>product_id</th>
                                                <th >Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                                $sql="select * from orders";
                                                $stm= $conn -> prepare($sql);
                                                $stm->execute(); 
                                                 if( $stm->rowCount())
                                                {
                                                  foreach( $stm->fetchall() as $row)
                                                  {
                                                  ?>
                                                <tr class="odd gradeX">

                                                <td><?php   echo $row['id']; ?></td>
                                                <td><?php   echo $row['quantity']; ?></td>
                                                <td><?php   echo $row['product_id']; ?></td>
                                                <td>
                                                    <a href="editorder.php?action=edit&id=<?php echo $row['id'] ?> " class='btn btn-success'>Edit</a>
                                                    <a  class='btn btn-danger' onclick="deleteme(<?php echo  $row['id'];?>)">Delete</a>
                                                </td>
                                                 </tr>
                                            <?php 
                                                  }
                                                  }
                                               ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <!--End Advanced Tables -->

                    </div>
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


