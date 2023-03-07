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
                <h2><i class="fa fa-items"></i>Products</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-8">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-plus-circle"></i> Add New Porduct
                    </div>
                    <?php if(isset($_POST['submitProduct'])) 
                        { 
                           $name =trim($_POST['name']);
                           $description =trim($_POST['description']);
                           $image = $_FILES['file'];
                           $price = $_POST['price'];
                           $cat_id =$_POST['category_id'];

                           $image_name= $image['name'];
                           $image_type= $image['type'];
                           $image_tmp= $image['tmp_name'];
                           $errors=array();
                           $extensions=array('jpg','jpeg','gif','png','jfif');
                           $file_explode=explode('.',$image_name);
                           $file_extension=strtolower(end($file_explode));
                            if(!in_array($file_extension,$extensions))
                            {
                              $errors['image_error'] = "<div style='color:red'>file extensions is Not Vaild</div>";
                            }
                            if(is_numeric($name)){
                                $errors['name'] = " Name Must Be String" ;
                            }
                            if(!is_numeric($price))
                            {
                                $errors['price'] = " Price Must Be Number " ;  
                            }
                            if(empty($errors)){
                                if (move_uploaded_file($image_tmp, "upload/".$image_name)) 
                                {
                                    $sql= "INSERT INTO products (name,description,price,image,category_id) VALUES (?,?,?,?,?)" ;
                                    $stm = $conn->prepare($sql);
                                    $stm->execute(array($name , $description,$price,$image_name ,$cat_id ));
                                    if ($stm->rowCount()) {
                                        echo "<div class='alert alert-success'>Row Inserted</div>" ;
                                    } else {
                                        echo "<div class='alert alert-danger'>Row Not Inserted</div>" ;
                                    }
                                }
                                else 
                                {
                                    echo "<div class='alert alert-danger'>Not upload file</div>";
                                }
                            
                            }
                        }
                        ?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">

                                <form role="form" method="post" enctype="multipart/form-data">
                                      <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" placeholder="Please Enter your Name "
                                            class="form-control" />
                                        <i style="color: red;">
                                            <?php if(isset( $errors['name'] )) echo  $errors['name']  ?>
                                        </i>
                                       </div>
                                      
                                    <div class="form-group">
                                        <label>description</label>
                                        <textarea placeholder="Please Enter Description" name="description"
                                            class="form-control" cols="30" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="number" name="price" placeholder=" Please Enter  product price "
                                            class="form-control" />
                                         <i style="color: red;">
                                            <?php if(isset( $errors['price'] )) echo  $errors['price']  ?>
                                        </i> 
                                       </div>
                                    <div class="form-group">
                                        <label>images</label>
                                        <input type="file" class="form-control" name="file">
                                        <i style="color: red;">
                                            <?php if(isset( $errors['image_error'] )) echo  $errors['image_error']  ?>
                                        </i>
                                    </div>

                                    <div class="form-group">
                                        <label>product Type</label>
                                        <select class="form-control" name="category_id">
                                            <?php    
                                        $sql="select * from category " ;
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
                                        <button type="submit" name="submitProduct" class="btn btn-primary">Add
                                            Product</button>
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
                        <i class="fa fa-task"></i> Products
                    </div>
                    <?php 
                            if(isset($_GET['action'],$_GET['id']))
                            {
                                $id=$_GET['id'];
                                switch($_GET['action'])
                                {
                                    case "delete":

                                        $sql="delete from products where id=:prod";
                                        $stm= $conn->prepare($sql);
                                        $stm->execute(array("prod"=>$id));
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
                        <div class="table-responsive" style="overflow-x:auto;">
                            <table id="table" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                        <th>Type</th>
                                        <th style="display:grid;width:210px;">action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql="select * from products " ;
                                        $stm = $conn->prepare($sql);
                                        $stm->execute();

                                        if($stm->rowCount())
                                        {
                                    foreach ($stm->fetchAll() as $row) {
                                                ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $row['id'];  ?></td>
                                        <td><?php echo $row['name'];  ?></td>
                                        <td><?php echo   $row['description']; ?></td>
                                        <td><?php echo   $row['price']; ?></td>
                                        <td><img src="upload/<?php echo $row['image'] ?>" width="40px"></td>
                                        <td><?php 
                                            $sql="select * from category where id=:categ_id" ;
                                            $stm = $conn->prepare($sql);
                                            $stm->execute(array("categ_id"=>$row['category_id']));
                                            foreach ($stm->fetchAll() as $catRow) {
                                               echo $catRow['name'];
                                            } 
                                            ?>
                                        </td>
                                        <td>
                                            <a href="editproduct.php?action=edit&id=<?php echo $row['id'] ?> "class='btn btn-success'>Edit</a>
                                            <a  class='btn btn-danger' onclick="deleteme(<?php echo  $row['id'];?>)">Delete</a>
                                        </td>
                                    </tr>
                                    <?php
                                            }  }  ?>

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

<?php
include_once ('footer.php');
       }
else
    {
       header("location:../login.php");
    }
?>
