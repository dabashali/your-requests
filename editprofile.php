<?php
session_start();
if(isset($_SESSION['user_info'] ))
{
   include_once ('header.php');
   require_once('dbconnect.php');
?>
<!-- ___________________________________ -->
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2><i class="fa fa-users"></i> Profile</h2>
            </div>
        </div>
        <?php 
            if( isset($_GET['action'],$_GET['id']) && $_GET['action']=='editprofile')
            { 
                $Id=$_GET['id'];
                $sql="select * from users where id=:catid";
                $stm= $conn -> prepare($sql);
                $stm->execute(array("catid"=>$Id)); 
                if( $stm->rowCount())
                    {
                      foreach( $stm->fetchall() as $row)
                      {
                        $id  =$row['id']; 
                        $name  =$row['name']; 
                        $email= $row['email'];
                        $password=$row['password'];
                        $phone=$row['phone_number'];
                        $active=$row['active'];
                        $role_id=$row['role_id'];
                    if(isset($_POST['adduser']))
                    {
                        $name=trim($_POST['name']);
                        $email=trim($_POST['email']);
                        $phone=trim($_POST['phone']);
                        $error=array();
        
                        if(is_numeric($name))
                        {
                            $error['name']=" Name must be string";
                        }
                        //    ----------------------------
                        //-----------------------------------
                        if(empty($error))
                        {
                            $sql="update  users set name=?,email=?,phone_number=? where id=?";
                            $stm= $conn->prepare($sql);
                            $stm->execute(array($name,$email,$phone,$Id)); 
                            if($stm->rowCount())
                            {  
                               
                                $_SESSION['user_info']['name']= $name;
                                echo "<script>
                                alert('One Row Updated');
                                window.open('profile.php','_self');
                                    </script> 
                                "; 
                            }
                            else{
                                echo "<div class='alert-danger'> row not updated </div>";
                            }
                        }
                    }

                        ?>
                         <div class="col-md-12">
                                <!-- form -->
                                <form role="form" method="post">
                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" value="<?php echo $name ?>" placeholder="Please Enter your Name " class="form-control" />
                                        <i style="color: red;">
                                            <?php if(isset( $errors['name'] )) echo  $errors['name']  ?>
                                        </i>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email"  value="<?php echo $email ?>" class="form-control" placeholder="PLease Enter Email" />
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text"  value="<?php echo $password ?>"name="password" class="form-control"  readonly title=" You Can't Change pass only admin can">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" value="<?php echo $phone ?>" name="phone" class="form-control" placeholder="Phone Number ">
                                    </div>
                                    <div class="form-group">
                                        <label>User Type</label>
                                        <?php 
                                            $sql="select * from roles where id=:role" ;
                                            $stm = $conn->prepare($sql);
                                            $stm->execute(array("role"=> $role_id));
                                            foreach ($stm->fetchAll() as $catRow) {
                                            ?>  
                                            <input type="text"  value="<?php echo $catRow['name'] ?>" name="active" class="form-control" title=" You Can't Change Role" readonly >
                                            <?php } ?>
                                   </div>
                                    <div class="form-group">
                                        <label>Active</label>
                                        <input type="number"  value="<?php echo $active ?>" name="active" class="form-control" readonly title=" You are n't admin ">
                                    </div>
                                    <div style="float:right;">
                                        <button type="submit" name="adduser" class="btn btn-primary">Edit Profile</button>
                                        <button onclick="window.open('profile.php','_self');" type="reset" class="btn btn-danger">
                                            Cancel
                                        </button>
                                    </div>

                            </div>
                            </form>
                            <?php } } } ?>
                        </div> 
        <!-- /. ROW  -->
        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
</div>
</div>



<!-- ___________________________________ -->
<?php
include_once('footer.php');
   }
else
    {
       header("location:../login.php");
    }
?>
