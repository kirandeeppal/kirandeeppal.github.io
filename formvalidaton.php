
<?php
  
  include_once('header.php');
 ?>


<?php 


$email2Err = $name2Err = $contact2Err = $address2Err =  $password2Err = $passwordconfirmErr="";
$mail= $name2 = $contact2 = $address2 = $password2 = "";

if(!empty($_POST['email2'])&& !empty($_POST['name2'])&& !empty($_POST['dob2'])&& !empty($_POST['contact2'])&& !empty($_POST['address2'])&& !empty($_POST['password2'])&& !empty($_POST['confirmpassword2']) )
  {
    $len= strlen($_POST['contact2']);
    $b1=$_POST['password2']==$_POST['confirmpassword2'];
    $b2=$len == 10;
    $b3=preg_match("/^.{6}$/",$_POST['password2']);
    $b4=preg_match("/^[A-Za-z][a-z@-_0-9]{3,99}$/",$_POST['address2']);
    $b5=preg_match("/^[0-9]{10}$/",$_POST['contact2']);
    $b6=preg_match("/^[A-Za-z]{2}[a-zA-Z-_\s\.]{,28}$/",$_POST['name2']);
    $b7=preg_match('/^$|^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',$_POST['email2']);

     $email2=$_POST['email2'];
      $name2=$_POST['name2'];
      $contact2=$_POST['contact2'];
      $address2=$_POST['address2'];
      $password2=md5($_POST['password2']);
   







    if ($b7!=true)
    {
      $email2Err ="enter valid mail";
    }

    if ($b6!=true)
    {

      $name2Err="name should start with character atleast first two words are character special symbols allowed only( _ ,-, .) and white space";
     }
      
    if ($b5!=true)
    {

      $contact2Err="contact no.should be 10 digit numeric value";
      
    }

    if ($b4!=true)
    {

      $address2Err="In address FIRST letter should be alphabet ,spacial character allowed are(@,_,-)";
      }

    if ($b3!=true)
    {

      $password2Err="password should of length 6 and special character allowed only (@,_,-)";
     
    }

    if($b1!=true)       
    {
      
      $passwordconfirmErr="password should be same as above";
    }
    
    
    if($b1==true&&$b3==true&&$b4==true&&$b5==true&&$b6==true)
    {
   
   
      $mail=$_POST['email2'];
      $name=$_POST['name2'];
      $dob=$_POST['dob2'];
      $contact=$_POST['contact2'];
      $address=$_POST['address2'];
      $password=md5($_POST['password2']);
      $confirmpassword=$_POST['confirmpassword2'];
      
    

      

    //database connection
  
    $mysqli = new mysqli('localhost', 'root', '' );

    if (!$mysqli) 
    {
     die('Could not connect:');                   
    }
    //echo 'Connected successfully to mySQL. <BR>';
     
    $mysqli->select_db("storeappliacation");
    
    // database entry part
        
        
        
      $query ="insert into userdetail (`email`,`name`,`dob`,`contact`,`address`,`password`) values('$mail','$name','$dob','$contact','$address','$password')";

    // echo $query.'<br>';   
     if($result=$mysqli->query($query))
     {
       
      // echo 'you have successfully entered values'.$to.' and  '.$subject.' and '.$message;
      
?>
      
      <h2 class="text-center text-success">Registration Successful</h2>
     
      

<?php

     }

  
     else
     { 
      //echo'error in entering value';
       echo "<br><h2 class='text-center text-danger'>Failed To Register</h2><br>";
     
     }  
    
  } 
  
  else
  {
    
 
 
?>

<div class="container" style ="background-color:#f1f1f1; padding:50px;">                    
      <form class="form-horizontal" action ="registration.php" method="POST">
      
        <h2 class="text-center">Register your account in Kiran's Sports Store</h2>
        <br>
        <hr>
      
        <div class="form-group">
          <label class="control-label col-sm-2" for="email">E-Mail</label><input class="col-sm-10" type="email" name="email2" required placeholder ="Enter E-mail id"value="<?php echo $email2 ;?>">
  <span class="error">*  <?php echo $mail ;?><?php echo $email2Err;?></span>

        </div>

        <div class="form-group">
          <label class="control-label col-sm-2" for="email">Name</label><input class="col-sm-10" type="text" name="name2" required placeholder ="Enter Name" value="<?php echo $name2;?>">
  <span class="error">* <?php echo $name2Err;?></span>  
        </div>
        
        <label class="control-label col-sm-2">Date Of Birth</label><input class="col-sm-10" type="date" name="dob2" required placeholder ="Enter date of birth"/><br>

        <label class="control-label col-sm-2">Contact No.</label><input class="col-sm-10" type="number" name="contact2" required placeholder ="Enter Contact No." value="<?php echo  $contact2 ;?>">
  <span class="error">* <?php echo $contact2Err ;?></span><br>

        <label class="control-label col-sm-2">Address</label><input class="col-sm-10" type="textarea" name="address2" required placeholder ="Enter Address" value="<?php echo  $address2;?>">
  <span class="error">* <?php echo $address2Err ;?></span><br>

        <label class="control-label col-sm-2">Password</label><input class="col-sm-10" type="password" name="password2" required placeholder ="Enter Password" value="<?php echo  $password2;?>">
  <span class="error">* <?php echo $password2Err ;?></span><br>


        <label class="control-label col-sm-2">Confirm Password</label><input class="col-sm-10" type="password" name="confirmpassword2" required placeholder ="Re enter password"/><br>
        
        <div class="col-12 text-center m-3">
          <button class="btn btn-outline-primary" type="submit" >REGISTER</button>
        </div>
        
      </form> 
</div>

</body>


</html>
   
<?php  
 }
 
 ?>



