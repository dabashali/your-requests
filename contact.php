

<!-- 99999999999999999999999999999999999999999999999999999999999999999999 -->
<?php
include_once('inc/header.php');
require_once('admin/dbconnect.php');
?>
<!-- Page Content -->
    <!-- About Page Starts Here -->
    <div class="contact-page">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <div class="line-dec"></div>
              <h1>Contact Us</h1>
            </div>
          </div>
          <div class="col-md-6">
            <div id="map">
            		<!-- How to change your own map point
                           1. Go to Google Maps
                           2. Click on your location point
                           3. Click "Share" and choose "Embed map" tab
                           4. Copy only URL and paste it within the src="" field below
                    -->
    <?php
    if(!empty($_GET['action']))
    {
        if(isset($_GET['action'],$_GET['id'])&$_GET['action']=="id")
        {
          $id=$_GET['id'];
          $sql="select * from products " ;
          $stm = $conn->prepare($sql);
          $stm->execute();
          if($stm->rowCount())
          foreach ($stm->fetchAll() as $row) 
          {

            $ime=$row['image'];
            if($row['id']==$id){
          ?>
        <img src="admin/upload/<?php echo $row['image']; ?>" width="100%" height="500px" frameborder="0" style="border:0" allowfullscreen/>
        <?php
        }}}}
        else
        echo'<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1197183.8373802372!2d-1.9415093691103689!3d6.781986417238027!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfdb96f349e85efd%3A0xb8d1e0b88af1f0f5!2sKumasi+Central+Market!5e0!3m2!1sen!2sth!4v1532967884907" width="100%" height="500px" 
              frameborder="0" style="border:0" allowfullscreen>
            </iframe>';         
   ?>
          </div>
          </div>
           
          <div class="col-md-6">
            <div class="right-content">
              <div class="container">
                <form id="contact" action="" method="post">
                  <div class="row">
                  <div class="col-md-12"  style=margin-left:10px>
                      <fieldset>
                        <input name="name" type="text" class="form-control" id="name" placeholder="Your name..." required>
                      </fieldset>
                    </div>
                    <div class="col-md-12" style="margin:15px">
                      <fieldset>
                        <input name="email" type="email" class="form-control" id="email" placeholder="Your email..." required>
                      </fieldset>
                    </div>
                    <div class="col-md-12" style="margin:15px">
                      <fieldset>
                        <input name="subject" type="number" class="form-control" id="subject" placeholder="How much category..." required>
                      </fieldset>
                    </div>
                    <div class="col-md-12" style="margin:15px">
                      <fieldset>
                        <input name="Location" type="text" class="form-control" id="subject" placeholder="your Location..." required>
                      </fieldset>
                    </div>
                    <div class="col-md-12">
                      <fieldset>
                        <button  style="margin:-5px; margin-left:10px" type="submit" id="form-submit" class="button" name="send">Send Message</button>
                      </fieldset>
                    </div>
                   
                    <div class="col-md-12">
                      <div class="share">
                        <h6>You can also keep in touch on: <span><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-linkedin"></i></a><a href="#"><i class="fa fa-twitter"></i></a></span></h6>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- About Page Ends Here -->
    <?php
                if(isset($_POST['send']))
               {   
                   $name=$_POST['name'];
                   $email=trim($_POST['email']);
                   $subject=$_POST['subject'];
                   $Location=$_POST['Location'];
                   $error=array();
                   if(is_numeric($name))
                   {   
                       $error['name']=" Name must be string";
                   }
                   if(empty($email))
                   { 
                       $error['email']=" active not valid Enter your email";
                   }
                   if(!is_numeric($subject))
                   {  
                       $error['subject']=" Name must be number";
                   }
                //    ----------------------------
                 //-----------------------------------
                    $i=0;
                   if(empty($error))
                       { 
                       $sql="insert into content(email,name,numbers,location,product_id) VALUES (?,?,?,?,?)";
                       $stm= $conn->prepare($sql);
                       $stm->execute(array($email,$name,$subject,$Location,$row['id'])); 
                       if($stm->rowCount())
                       { 
                            echo '<div style=" text-align :center; 
                            border-radius:5px;background-color:#100002; width:140px;height:30px;
                            color:white;margin:0px auto;margin-bottom: 92px;" class="alert-danger"> row inserted </div>';
                       }
                       else{
                          
                            echo '<div style="background-color:#100002; 
                            width:140px;height:30px; border-radius:5px; color:white;
                            margin:0px auto;margin-bottom: 12px;" class="alert-danger"> row not inserted </div>';
                       }
                      }
                    }
                ?>
<?php
include_once('inc/footer.php');
?>