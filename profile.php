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
                    $sql="select * from users where id=:catid";
                    $stm= $conn -> prepare($sql);
                    $stm->execute(array("catid"=>$_SESSION['user_info']['id'])); 
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
                        }
                      } 
                ?>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-8">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- form -->
                                <form role="form" method="post">
                                    <div class="form-group">
                                        <label><span style="color:#ff6666;font-size:16px;">Name </span>    :    <?php echo $name ;  ?></label>
                                    </div>
                                    <div class="form-group">
                                        <label><span style="color:#ff6666;font-size:16px;">Email </span>    :    <?php echo $email ;  ?></label>
                                    </div>
                                    <div class="form-group">
                                        <label><span style="color:#ff6666;font-size:16px;">Password </span> :  <?php echo $password ; ?></label>
                                        <!-- <input type="password" name="password" class="form-control" placeholder="Please Enter password"> -->
                                    </div>
                                    <div class="form-group">
                                        <label><span style="color:#ff6666;font-size:16px;">Phone Number </span>: <?php echo $phone ;  ?></label>
                                    </div>
                                    <div class="form-group">
                                        <label><span style="color:#ff6666;font-size:16px;">User Type  </span>: 
                                        <?php 
                                            $sql="select * from roles where id=:role" ;
                                            $stm = $conn->prepare($sql);
                                            $stm->execute(array("role"=> $role_id));
                                            foreach ($stm->fetchAll() as $catRow) {
                                               echo $catRow['name'];
                                            } 
                                            ?>                                    
                                    </label>

                                    </div>
                                    <div class="form-group">
                                        <label> <span style="color:#ff6666;font-size:16px;">Active</span> : 
                                        <?php 
                                        if($active==1 ):
                                        echo "Enable"; 
                                        elseif($active==0):
                                        echo "Disable"; 
                                        endif;
                                        ?> </label>
                                    </div>
                                    <div class="form-group">
                                       <a  href="editprofile.php?action=editprofile&id=<?php echo $row['id'] ?>" class='btn btn-success'>Edit</a>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
