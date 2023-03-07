<?php
session_start();
if(isset($_SESSION['user_info'] ))
{
   include_once ('header.php');
   require_once('dbconnect.php');
        ?>
    
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2><i class="fa fa-tasks"></i> Categories</h2>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-8">
                        <!-- Form Elements -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-plus-circle"></i>Edit  Category
                            </div>
                            

                            <div class="panel-body">
                                <div class="row">
                                          <?php 
                                                if( isset($_GET['action'],$_GET['id']) && $_GET['action']=='edit')
                                                { 
                                                  $Id=$_GET['id'];
                                                  $sql="select * from category where id=:catid";
                                                  $stm= $conn -> prepare($sql);
                                                   $stm->execute(array("catid"=>$Id)); 
                                                   if( $stm->rowCount())
                                                     {
                                                     foreach( $stm->fetchall() as $row)
                                                     {
                                                      $id  =$row['id']; 
                                                      $name  =$row['name']; 
                                                      $description = $row['description'];
                                                      
                             if(isset($_POST['addcategory']))
                            {   $id=$_POST['id'];
                                $name=trim($_POST['name']);
                                $desc=trim($_POST['description']);
                                $error=array();
                                if(is_numeric($name))
                                {
                                    $error['name']=" Name must be string";
                                }
                                if(empty($error))
                                {
                                    $sql="update category set name=?,description=? where id=?";
                                    $stm= $conn->prepare($sql);
                                    $stm->execute(array($name,$desc,$id)); 
                                    if($stm->rowCount())
                                    {
                                        echo "<script>
                                        alert('One Row Updated');
                                        window.open('categories.php#table','_self');
                                         </script> 
                                        ";
                                    }
                                    else{
                                        echo "<div class='alert-danger'>row not updated </div>";
                                    }
                                }
                            }
                                 ?>
                                    <div class="col-md-12">                            
                                        <form role="form" action="" method="post">
                                            <input type="hidden" name="id" value="<?php echo $id ?>">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text"  name="name" placeholder="Please Enter your Name"
                                                 required class="form-control" value="<?php echo $name ?>" />
                                                  
                                                    <i color="red">
                                                        <?php
                                                        if(isset($error['name']))
                                                        {
                                                           echo $error['name'];
                                                        }
                                                        ?>
                                                    </i>
                                                
                                                    
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>
      
                                                <textarea  placeholder=" Please Enter Description" name="description" class="form-control"
                    
                                                    cols="30" rows="3" ><?php echo $description ?></textarea>
                                            </div>

                                            <div style="float:right;">
                                                <button type="submit" name="addcategory" class="btn btn-primary">Edit Category</button>
                                                <button type="reset" class="btn btn-danger">Cancel</button>
                                            </div>

                                    </div>
                                    </form>
                                    <?php } } } ?>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <hr />

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