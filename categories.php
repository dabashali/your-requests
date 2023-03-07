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
                                <i class="fa fa-plus-circle"></i> Add New Category
                            </div>
                            <div class="panel-body">
                                <div class="row">
                               
                        <?php
                if(isset($_POST['addcategory']))
               {
                   $name=trim($_POST['name']);
                   $desc=trim($_POST['description']);
                   $error=array();
                   if(is_numeric($name))
                   {
                       $error['name']=" Name must be string";
                   }
                   if(empty($error))
                   {
                       $sql="insert into category(name,description) values(?,?)";
                       $stm= $conn->prepare($sql);
                       $stm->execute(array($name,$desc)); 
                       if($stm->rowCount())
                       {
                           echo "<div class='alert-success'>row inserted </div>";
                       }
                       else{
                           echo "<div class='alert-danger'>row not inserted </div>";
                       }
                   }
               }
              
                ?> 
               
                                    <div class="col-md-12">
                                        <form role="form" action="" method="post">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text"  name="name" placeholder="Please Enter your Name " required class="form-control" />
                                                  
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
                    
                                                    cols="30" rows="3"></textarea>
                                            </div>

                                            <div style="float:right;">
                                                <button type="submit" name="addcategory" class="btn btn-primary">Add Category</button>
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
                                <i class="fa fa-tasks"></i> Categories
                            </div>
                            <?php 
                            if(isset($_GET['action'],$_GET['id']))
                            {
                                $id=$_GET['id'];
                                switch($_GET['action'])
                                {
                                    case "delete":

                                        $sql="delete from category where id=:sub";
                                        $stm= $conn->prepare($sql);
                                        $stm->execute(array("sub"=>$id));
                                        if($stm->rowCount()==1)
                                        {
                                            echo "<div class='alert alert-success'> one Row deleted </div>";
                                        }
                                        break;
                                        default :
                                        echo " Error";
                    
                                }
                            }
                            
                            ?>
                            <div class="panel-body">
                                <div class="table-responsive"style="overflow-x:auto;">
                                    <table id="table" class="table table-striped table-bordered table-hover "
                                        id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th style="display:grid;width:210px;">action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                                $sql="select * from category";
                                                $stm= $conn -> prepare($sql);
                                                $stm->execute(); 
                                                 if( $stm->rowCount())
                                                {
                                                  foreach( $stm->fetchall() as $row)
                                                  {
                                                  ?>
                                                <tr class="odd gradeX">

                                                <td><?php   echo $row['id']; ?></td>
                                                <td><?php   echo $row['name']; ?></td>
                                                <td><?php   echo $row['description']; ?></td>
                                                <td>
                                                    <a style="width:45%;" href="editcategory.php?action=edit&id=<?php echo $row['id'] ?> " class='btn btn-success'>Edit</a>
                                                    <a style="width:45%;" class='btn btn-danger' onclick="deleteme(<?php echo  $row['id'];?>)">Delete</a>
                                               <!-- go to footer page to exec function  -->
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

