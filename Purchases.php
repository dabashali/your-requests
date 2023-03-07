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
                <h2><i class="fa fa-users"></i> Purchases</h2>
            </div>
        </div>
        <div class="panel-body">
                                <div class="table-responsive"style="overflow-x:auto;">
                                    <table id="table" class="table table-striped table-bordered table-hover "
                                        id="dataTables-example">
                                        <thead>
                                            <tr>  
                                                <th>User Name</th>
                                                <th>Pruduct Name</th>
                                                <th>Description</th>
                                                <th>Number</th>
                                                <th>Price</th>
                                                <th>TotalPrice</th>
                                                <th>Image</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                                $sql="select p.* ,c.numbers,c.name as ali from products p JOIN content c on p.id=c.product_id ";
                                                $stm= $conn -> prepare($sql);
                                                $stm->execute(); 
                                                 if( $stm->rowCount())
                                                {
                                                  foreach( $stm->fetchall() as $row)
                                                  {
                                                  ?>
                                                <tr class="odd gradeX">
                                                <td><?php   echo $row['ali']; ?></td>
                                                <td><?php   echo $row['name']; ?></td>
                                                <td><?php   echo $row['description']; ?></td>
                                                <td><?php   echo $row['numbers']; ?></td>
                                                <td><?php   echo $row['price']; ?></td>
                                                <td><?php   echo '$' . $row['price'] * $row['numbers']; ?></td>
                                                <td><img src="upload/<?php echo $row['image'] ?>" style="border-radius:5px;margin-left:11px;" width="100px" height="100px"></td>
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
                          
<!-- ___________________________________ -->
<?php
include_once('footer.php');
   }
else
    {
       header("location:../login.php");
    }
?>
