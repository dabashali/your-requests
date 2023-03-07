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
                        <h2    style=" text-align: center; font-weight"><i class="fa fa-dashboard "></i> Dashboard</h2>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-red set-icon">
                                <i class="fa fa-users"></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text">
                                 <?php 
                                 $sql="select * from users";
                                 $stm= $conn -> prepare($sql);
                                 $stm->execute(); 
                                 echo $stm->rowCount().'<br>'.'<br>'.'<br>';
                                 ?>
                                 
                                 Users 
                                 
                                </p>
                                <br>
                                <br>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-green set-icon">
                                <i class="fa fa-tasks"></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text">
                                <?php 
                                 $sql="select * from category";
                                 $stm= $conn -> prepare($sql);
                                 $stm->execute(); 
                                 echo $stm->rowCount().'<br>'.'<br>'.'<br>';
                                 ?>
                                Categories</p>
                                <br>
                                <br>

                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-blue set-icon">
                                <i class="fa fa-table"></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text">
                                <?php  
                                 $sql="select * from orders";
                                 $stm= $conn -> prepare($sql);
                                 $stm->execute(); 
                                 echo $stm->rowCount() .'<br>'.'<br>'.'<br>';
                                 ?>
                                 
                                 requeste
                                </p>
                                <br>
                                <br>
                            </div>
                            <a href="orders.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                <div class="col-md-4 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-red set-icon">
                                <i class="fa fa-table"></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text">
                                 <?php 
                                 $sql="select * from products";
                                 $stm= $conn -> prepare($sql);
                                 $stm->execute(); 
                                 echo $stm->rowCount().'<br>'.'<br>'.'<br>' ;
                                 ?>
                                 
                                 Products
                                 
                                </p>
                                <br>
                                <br>
                            </div>
                            <a href="products.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
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