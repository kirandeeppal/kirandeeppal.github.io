
<?php
	
	include_once('header.php');
 ?>

<?php 

if(isset ($_SESSION["username"]))
{

?>
			

<h2 class='text-center'>Already Logged In</h2><br>
<div class="container">
	<div class="row">
		<div class="col-12 text-center">
			<a href="index.php"> <button class='btn btn-primary text-center'>Home</button></a>
			<a href="logoutsessiondestroy.php"> <button class='btn btn-danger text-center'>Logout</button></a>
		</div>
	</div>
</div>

 

<?php
exit();
}

else
{

}

$showform = true;

if(!empty($_POST['mail'])&& !empty($_POST['password']))
  {
	  
	  $mail=$_POST['mail'];
	  $password=md5($_POST['password']);
					  

		//database connection

		$mysqli = new mysqli('localhost', 'root', '' );

		if (!$mysqli) 
		{
		 die('Could not connect:');        						
		}
		//echo 'Connected successfully to mySQL. <BR>';
		 
		$mysqli->select_db("storeappliacation");
		
		// database entry part
				
				
				
		$sql = "select * from userdetail where `email`= '$mail' and `password`='$password'";			
		$result1 = $mysqli->query($sql);							
		  if($result1->num_rows > 0  )
		  {
			
			$row = $result1->fetch_assoc();
			$_SESSION["username"]=$row["name"];
			$_SESSION["userid"]=$row["id"];
			

			$isAdmin=$row["user_type"]=="ADMIN";
			$_SESSION["isAdmin"]=$isAdmin; //This will save value true or false in the Session Variable
			
			
			$showform=false;  
		  }

		else
		{
			echo'<h3 class="text-center text-danger">Login Failed! Invalid Email Or Password</h3> ';
			$showform=true;
		}									 

}
 ?>
 
 <?php 
 if($showform==false)
 {	

 	if(isset($isAdmin) && $isAdmin)
	{
		//Currently Logged-In user is Admin, so we will send him to administration page
		header("Location:item.php");
	}
	else
	{
		header("Location:itemlisting.php");
	}

 	
	
 }
 
 

 else
 { 
?>
<html>
<head>

</head>
<body>
                                            <!--division section for table display-->
<div class="container  border  border-secondary" style ="height: 500px;">
	
	<form class="form-horizontal" action ="login.php" method="POST">
			<h2 class="text-primary" style="text-align:center">LOGIN</h2></br><hr></br>
			
			<div class="form-group">
				<label class="col-sm-4 text-right">E-Mail</label><input class="col-sm-6" type="email" name="mail" placeholder ="Enter email"/>
			</div>
			  
			  <div class="form-group">
			  	<label class="col-sm-4 text-right">Password</label><input class="col-sm-6" type="password" name="password" placeholder ="Enter password"/><br><br>  
			  </div>  
			  
			
			<input type="hidden" value="true" name="login"/>
			<div class="col-sm-12 text-center">
				<button class="btn btn-outline-primary" type="submit" id="mybtn" name="login" >LOGIN</button>
			
			<button class="btn btn-outline-primary"><a href="registration.php">REGISTRATION</a></button>
			</div>
			
	</form>

</div>


</body>
</html>
	 
<?php	 
 }
 
 ?>
