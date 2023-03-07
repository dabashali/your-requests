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
                        <i class="fa fa-plus-circle"></i> Edit Porduct
                    </div>
                    
                    <div class="panel-body">
                        <div class="row">

                        <?php
                        
                        if( isset($_GET['action'],$_GET['id']) && $_GET['action']=='edit')
                                                { 
                                                  $Id=$_GET['id'];
                                                  $sql="select * from products where id=:catid";
                                                  $stm= $conn -> prepare($sql);
                                                   $stm->execute(array("catid"=>$Id)); 
                                                   if( $stm->rowCount())
                                                     {
                                                     foreach( $stm->fetchall() as $row)
                                                     {
                                                      $id  =$row['id']; 
                                                      $name  =$row['name']; 
                                                      $description = $row['description'];
                                                      $type  =$row['category_id']; 
                                                      $price  =$row['price']; 
                                                      $picture  =$row['image']; 
                                                      
                                                      
                        
                        if(isset($_POST['submitProduct'])) 
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
                           $extensions=array('jpg','gif','png','jfif');
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
                                    $sql= "update products set name=?,description=?,price=?,image=?,category_id=? where id=?" ;
                                    $stm = $conn->prepare($sql);
                                    $stm->execute(array($name , $description,$price,$image_name,$cat_id,$Id ));
                                    if ($stm->rowCount()) {
                                        echo "<script>
                                        alert('One Row Updated');
                                        window.open('products.php#table','_self');
                                         </script> 
                                        ";
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


                            <div class="col-md-12">

                                <form role="form" method="post" enctype="multipart/form-data">
                                      <input type="hidden" name="id" value="<?php echo $id ?>">
                                      <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" value="<?php echo $name ?>"  placeholder="Please Enter your Name "
                                            class="form-control" />
                                        <i style="color: red;">
                                            <?php if(isset( $errors['name'] )) echo  $errors['name']  ?>
                                        </i>
                                       </div>
                                      
                                    <div class="form-group">
                                        <label>description</label>
                                        <textarea placeholder="Please Enter Description" name="description"
                                            class="form-control" cols="30" rows="3"><?php echo $description ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="number" name="price" placeholder=" Please Enter  product price "
                                        value="<?php echo $price ?>" class="form-control" />
                                         <i style="color: red;">
                                            <?php if(isset( $errors['price'] )) echo  $errors['price']  ?>
                                        </i> 
                                       </div>
                                    <div class="form-group">
                                        <label>images</label>
                                        
                                        <input type="file" class="form-control" name="file" >
                                        <!-- <div style="width:100%;height:60px; display:flex;justify-content:space-between;" >  
                                        <label> Prevous image</label>
                                        <img src="upload/<?php echo $picture; ?>" width="40px">
                                        <label> New  image</label>
                                        <img src="upload/<?php echo $image['name'];; ?>" width="40px">
                                         </div> -->
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
                                        } ?>
                                        </select>
                                    </div>
                                    <div style="float:right;">
                                        <button type="submit" name="submitProduct" class="btn btn-primary">Edit
                                            Product</button>
                                        <button type="reset" class="btn btn-danger">Cancel</button>
                                    </div>

                             </div>
                            </form>
                            <?php  
                                         } } } ?>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <hr />
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
