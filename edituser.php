<?php
session_start();
if(isset($_SESSION['user_info'] ))
{
   include_once ('header.php');
   require_once('dbconnect.php');
?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2><i class="fa fa-users"></i> Users</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-8">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-plus-circle"></i> Edit User
                    </div>
                  
               
                    <div class="panel-body">
                        <div class="row">
                        <?php 
                            if( isset($_GET['action'],$_GET['id']) && $_GET['action']=='edit')
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
                                        $password=md5(trim($_POST['password']));
                                        $confirmpass=md5(trim($_POST['confirmpass']));
                                        $phone=trim($_POST['phone']);
                                        $active=trim($_POST['active']);
                                        $role_id=trim($_POST['role_id']);
                                        $error=array();
                     
                                        if(is_numeric($name))
                                        {
                                            $error['name']=" Name must be string";
                                        }
                                        if(!is_numeric($active))
                                        {
                                            $error['active']=" active not valid Enter 0 or 1";
                                        }
                                     //    ----------------------------
                                        if($password !==$confirmpass)
                                        {
                                            $error['password']=" Confirm Is Not The Same";
                                        }
                                        else{
                                         $password=$confirmpass;
                                        }
                                      //-----------------------------------
                                        if(empty($error))
                                        {
                                            $sql="update  users set name=?,email=?,password=?,phone_number=?,role_id=?,active=? where id=?";
                                            $stm= $conn->prepare($sql);
                                            $stm->execute(array($name,$email,$password,$phone,$role_id,$active,$Id)); 
                                            if($stm->rowCount())
                                            {   
                                                echo "<script>
                                                alert('One Row Updated');
                                                window.open('users.php#table','_self');
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
                                        <input type="password"  value="<?php echo $password ?>"name="password" class="form-control" placeholder="Please Enter password">
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" name="confirmpass" class="form-control"
                                            placeholder="Confirm password">
                                            <i style="color: red;">
                                            <?php if(isset($error['password'] ))  echo $error['password']; ?>
                                        </i>
                                            
                                    </div>
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" value="<?php echo $phone ?>" name="phone" class="form-control" placeholder="Phone Number ">
                                    </div>
                                    <div class="form-group">
                                        <label>User Type</label>
                                        <select class="form-control" name="role_id">
                                        <?php    
                                        $sql="select * from roles " ;
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
                                    <div class="form-group">
                                        <label>Active</label>
                                        <input type="number"  value="<?php echo $active ?>" name="active" class="form-control" placeholder=" Active 1  non active 0">
                                        <i style="color: red;">
                                            <?php if(isset(  $error['active'] )) echo   $error['active']  ?>
                                        </i>
                                    </div>
                                    <div style="float:right;">
                                        <button type="submit" name="adduser" class="btn btn-primary">Edit User</button>
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

<?php
include_once('footer.php');
}
else
    {
       header("location:../login.php");
    }
?>

