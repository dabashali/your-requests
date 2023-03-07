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
                        <i class="fa fa-plus-circle"></i> Add New User
                    </div>
                    <?php
                if(isset($_POST['adduser']))
               {
                   $name=trim($_POST['name']);
                   $email=trim($_POST['email']);
                   $password=trim($_POST['password']);
                
                   $confirmpass=trim($_POST['confirmpass']);
                   $phone=trim($_POST['phone']);
                   $active=trim($_POST['active']);
                   $role_id=trim($_POST['role_id']);
                   $error=array();

                   if(is_numeric($name))
                   {
                       $error['name']=" Name must be string";
                   }
                   if(!is_numeric($active) || $active!==0 ||$active!==1 )
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
                       $sql="insert into users(name,email,password,phone_number,role_id,active) values(?,?,?,?,?,?)";
                       $stm= $conn->prepare($sql);
                       $stm->execute(array($name,$email,md5($password),$phone,$role_id,$active)); 
                       if($stm->rowCount())
                       {
                           echo "<div class='alert-success'> row inserted </div>";
                       }
                       else{
                           echo "<div class='alert-danger'> row not inserted </div>";
                       }
                   }
               }
              
                ?> 
                    <div class="panel-body">
                        <div class="row">
              
                            <div class="col-md-12">
                                <!-- form -->
                                <form role="form" method="post">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" placeholder="Please Enter your Name " class="form-control" />
                                        <i style="color: red;">
                                            <?php if(isset( $errors['name'] )) echo  $errors['name']  ?>
                                        </i>
                                       
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" placeholder="PLease Enter Email" />
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Please Enter password">
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
                                        <input type="text" name="phone" class="form-control" placeholder="Phone Number ">
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
                                        <input type="number" name="active" class="form-control" placeholder=" Active 1  non active 0">
                                        <i style="color: red;">
                                            <?php if(isset(  $error['active'] )) echo   $error['active']  ?>
                                        </i>
                                    </div>
                                    <div style="float:right;">
                                        <button type="submit" name="adduser" class="btn btn-primary">Add User</button>
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
                        <i class="fa fa-users"></i> Users
                    </div>
                    <!-- start php code delete -->
                    <?php
                    if(isset($_GET['action'],$_GET['id']))
                            {
                                $id=$_GET['id'];
                                switch($_GET['action'])
                                {
                                    case "delete":

                                        $sql="delete from users where id=:user_id";
                                        $stm= $conn->prepare($sql);
                                        $stm->execute(array("user_id"=>$id));
                                        if($stm->rowCount()==1)
                                        {
                                            echo "<div class='alert alert-success'> one Row deleted </div>";
                                            header("location:users.php#table");
                                        }
                                        break;
                                        default :
                                        echo " Error";
                                }
                            }  
                            ?>
                            <!-- end of php code delete -->
                            <?php
                             if(isset($_GET['active'],$_GET['id']) )
                            {
                                $id=$_GET['id'];
                                $state=$_GET['active'];
                                if($state==0)
                                $state=1; 
                                else 
                                $state=0;
                                $sql="update  users  set active=:you where id=:user_id";
                                $stm= $conn->prepare($sql);
                                $stm->execute(array("you"=>$state,"user_id"=>$id));
                                if($stm->rowCount()==1)
                                {
                                    echo "<script>
                                    window.open('#tabl','_self');
                                     </script> 
                                    "; 
                                }
                                else
                                echo "error";
                                
                            }
                            ?>

                            <!-- end of php code update active -->
                    <div class="panel-body">
                        <div class="table-responsive"style="overflow-x:auto;">
                            <table class="table table-striped table-bordered table-hover"   id="dataTables-example">
                                <thead id="table">
                                    <tr >
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th >Password</th>
                                        <th>Phone</th>
                                        <th>Active</th>
                                        <th>Role</th>
                                        <th style="display:grid;width:240px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody  >
                                <?php
                                        $sql="select * from users " ;
                                        $stm = $conn->prepare($sql);
                                        $stm->execute();
                                        if($stm->rowCount())
                                        {
                                    foreach ($stm->fetchAll() as $row) {
                                                ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $row['id'];    ?>   </td>
                                        <td><?php echo $row['name'];  ?>   </td>
                                        <td><?php echo $row['email']; ?>   </td>
                                        <td ><?php echo $row['password'];?> </td>
                                        <td><?php echo $row['phone_number']; ?>   </td>
                                        <td><?php echo $row['active']; ?>  </td>
                                        <td>
                                            <?php 
                                            $sql="select * from roles where id=:role" ;
                                            $stm = $conn->prepare($sql);
                                            $stm->execute(array("role"=>$row['role_id']));
                                            foreach ($stm->fetchAll() as $catRow) {
                                               echo $catRow['name'];
                                            } 
                                            ?>
                                        </td>
                                        <td >
                                            <a style="width: 26%;" href="edituser.php?action=edit&id=<?php echo $row['id'] ?> "  class='btn btn-success'>Edit</a>
                                            <a  style="width:28%;" class='btn btn-danger' onclick="deleteme(<?php echo  $row['id'];?>)">Delete</a>
                                            <a id="tabl" style="width:33%;text-align:center;"href="?active=<?php echo $row['active']?>&id=<?php echo $row['id']?> "
                                                 class='btn btn-danger'>
                                            <?php 
                                            if($row['active']==1)
                                            echo 'active';
                                            else 
                                            echo 'unactive';
                                            ?>
                                            </a>
                                            
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
include_once('footer.php');
}
else
    {
       header("location:../login.php");
    }
?>


