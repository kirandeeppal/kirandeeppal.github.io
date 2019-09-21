
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

$showform = true;
	//initializing null to given fields
	$email2Err = $name2Err = $contact2Err = $address2Err =  $password2Err = $passwordconfirmError="";
	$email2 = $name2 = $contact2 = $address2 = $password2 = $confirm2="";


if(!empty($_POST['email2'])&& !empty($_POST['name2'])&& !empty($_POST['dob2'])&& !empty($_POST['contact2'])&& !empty($_POST['address2'])&& !empty($_POST['password2'])&& !empty($_POST['confirmpassword2']) )
  {
	
		$len= strlen($_POST['contact2']);
		$b1=$_POST['password2']==$_POST['confirmpassword2'];
		$b3=preg_match("/^[0-9]{6}$/",$_POST['password2']);
		$b4=preg_match("/^[A-Za-z][a-z@-_0-9]{3,99}$/",$_POST['address2']);
		$b5=preg_match("/^[0-9]{10}$/",$_POST['contact2']);
		$b6=preg_match("/^[A-Za-z ]{2,50}$/",$_POST['name2']);
		$b7=preg_match('/^$|^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',$_POST['email2']);


		/*if ($b7!=true)
		{
			echo '<h6 class="text-center text-danger">enter valid mail</h6>';
		}

		if ($b6!=true)
		{
			echo '<h6 class="text-center text-danger">name should start with character atleast first two words are character special symbols allowed only( _ ,-, .) and white space</h6>';}
			
		if ($b5!=true)
		{
			echo '<h6 class="text-center text-danger">contact no.should be 10 digit numeric value</h6>';
		}

		if ($b4!=true)
		{
			echo  '<br><h6 class="text-center text-danger
			">In address FIRST letter should be alphabet ,spacial character allowed are(@,_,-)</h6>';}

		if ($b3!=true)
		{
			echo '<br><h6 class="text-center text-danger">passsword should of length 6 and special character allowed only (@,_,-)</h6>';
		}

		if($b1!=true)				
		{
			
			echo "<br><h6 class='text-center text-danger'>Confirm password doesnot match </h6>";
		}*/
		
			  $email2=$_POST['email2'];
		      $name2=$_POST['name2'];
		      $contact2=$_POST['contact2'];
		      $address2=$_POST['address2'];
		      $password2=$_POST['password2'];
		   	  $passwordconfirmErr=$_POST['confirmpassword2'];
		
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
			$showform=false;
?>
			
			<h2 class="text-center text-success">Registration Successful</h2>
			<h4 class="text-center">Please Login To Access Kiran's Sports Store</h4>
			<div class="col-12 m-4 text-center">
				<a href="login.php"><button class="btn btn-outline-success">Login</button></a>
			</div>
			

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
		
		$showform=true;
	}
}
 ?>
 
 <?php

 if($showform==false)
 {	
// header("Location:login.php");
//echo'hii'; 
 }
 
 

 else
 { 
?>

<div class="container" style ="background-color:#f1f1f1; padding:50px;">										
			<form class="form-horizontal" action ="registration.php" method="POST" id="myform">
			
				<h2 class="text-center">Register your account in Kiran's Sports Store</h2>
				<br>
				<hr>
			
				<div class="form-group">
		          <label class="control-label col-sm-2" for="email">E-Mail*</label><input class="col-sm-10" type="email" id="mailid" name="email2" required placeholder ="Enter E-mail id"value="<?php echo  $email2 ;?>"><span id="emailerrormsg"  style="visibility:hidden "><h6 class= text-danger>*enter proper mail </h6></span><span class="error">  <b class= "text-danger"><?php echo $email2Err;?></b>  </span> 
		  	    </div>




		        <div class="form-group">
		          <label class="control-label col-sm-2" for="email">Name*</label><input class="col-sm-10" type="text" name="name2" id="nameid" required placeholder ="Enter Name" value="<?php echo $name2;?>">
		          <span id="nameerrormsg"  style="visibility:hidden "><h6 class= text-danger>*enter proper name</h6></span>
		 		 <span class="error"> <b class= "text-danger"> <?php echo $name2Err;?></b></span> 
		  		<p id="demo"></p>
		        </div>

						
				<label class="control-label col-sm-2">Date Of Birth</label><input class="col-sm-10"  name="dob2" required placeholder ="enter your date of birth"/><br>


		        <label class="control-label col-sm-2">Contact No.*</label><input class="col-sm-10"  name="contact2" required placeholder ="Enter Contact No." maxlength="10" id="contactid" value="<?php echo  $contact2 ;?>"><span id="numbererrormsg"  style="visibility:hidden "><h6 class= text-danger>*enter proper number</h6></span><span class="error">  <b class= "text-danger"><?php echo $contact2Err ;?></b></span><br>

			    <label class="control-label col-sm-2">Address*</label><input class="col-sm-10" type="textarea" name="address2" required placeholder ="Enter Address" id="addressid" value="<?php echo  $address2;?>"><span id="addresserrormsg"  style="visibility:hidden "><h6 class= text-danger>*enter proper address</h6></span><span class="error">  <b class= "text-danger"><?php echo $address2Err ;?></b></span><br>


			    <label class="control-label col-sm-2">Password*</label><input class="col-sm-10" type="password" name="password2" id="passwordid" required placeholder ="Enter Password" value="<?php echo  $password2;?>"><span id="passworderrormsg"  style="visibility:hidden "><h6 class= text-danger>*enter proper password</h6></span><span class="error">  <b class= "text-danger"><?php echo $password2Err ;?></b></span><br>

			   <label class="control-label col-sm-2">Confirm Password*</label><input class="col-sm-10" type="password" id="confirmpasswordid" name="confirmpassword2" required placeholder ="Re enter password">
  				<!--<span class="error">* <b class= "text-danger"><?php //echo $passwordconfirmError ;?></b></span><br>--><span id="confirmpassworderrormsg"  style="visibility:hidden "><h6 class= text-danger> *password doesn match</h6></span>
				
				

				<div class="col-12 text-center m-3">
					<button class="btn btn-outline-primary" type="button" id ="btnid" >REGISTER</button>
				</div>
				
			</form>	


			<script>

			$(document).ready(function(){
			 
			});
			console.log("hiixbvbxn");

			$("#mailid").change(function(){

	
				var str =$("#mailid").val(); 
				var	mail=/^$|^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				var res=mail.test(str);
					if(res!=true)
					{
						//alert("format of mail is wrong.. ");
						$('#emailerrormsg').css('visibility', 'visible');
					}
					else
					{
						$('#emailerrormsg').css('visibility', 'hidden');
					}
			});


				$("#nameid").change(function(){	
				var nameinput =$("#nameid").val(); 
					var	name=/^[A-Za-z ]{2,50}$/;
					var res2=name.test(nameinput);
					if(res2!=true)
					{
						$('#nameerrormsg').css('visibility', 'visible');
						//alert("format of name is wrong ");
					}

						else
					{
						$('#nameerrormsg').css('visibility', 'hidden');
					}

					});
	

					$("#contactid").change(function(){	
					var number =$("#contactid").val(); 
						var	number1=/^[0-9]{10}$/;
						var res3=number1.test(number);
						if(res3!=true)

						
						{
							$('#numbererrormsg').css('visibility', 'visible');
							//alert("format of number is wrong ");
						}
						else
						{
							$('#numbererrormsg').css('visibility', 'hidden');
						}

				});


					$("#addressid").change(function(){	
					var address =$("#addressid").val(); 
					var	address1=/^[A-Za-z][a-z@-_0-9]{3,99}$/;
					var res4=address1.test(address);
					if(res4!=true)

		
					{
						$('#addresserrormsg').css('visibility', 'visible');
						//alert("format of address is wrong ");
					}
					else
					{
						$('#addresserrormsg').css('visibility', 'hidden');
					}

					});


					$("#passwordid").change(function(){
					var password =$("#passwordid").val(); 
						password1=/^[0-9]{6}$/;
					var res5=password1.test(password);
					if(res5!=true)
					
					{
						$('#passworderrormsg').css('visibility', 'visible');
						//alert("format of password is wrong ");
					}
					else
					{
						$('#passworderrormsg').css('visibility', 'hidden');
					}

					});



				$("#confirmpasswordid").change(function(){
					var pd1=$("#passwordid").val();
					
					var pd2=$("#confirmpasswordid").val(); 
						if (pd1!=pd2)
							{
								$('#confirmpassworderrormsg').css('visibility', 'visible');
							//alert("password and confirm password doesn match");
							}
							else
					{
						$('#confirmpassworderrormsg').css('visibility', 'hidden');
					}


				});
		//$b2=$len == 10;
		//$b3=preg_match("/^[0-9]{6}$/",$_POST['password2']);
		//$b4=preg_match("/^[A-Za-z][a-z@-_0-9]{3,99}$/",$_POST['address2']);
		
		

					
				$("#btnid").click(function(){

						
				var isform=false;	

			  		console.log("hiixbvbxn");

				var str =$("#mailid").val(); 
				var	mail=/^$|^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				var res=mail.test(str);
				if(res!=true)
					{

						isform=true;
						//alert("format of mail is wrong.. ");
						$('#emailerrormsg').css('visibility', 'visible');
					}
						else
						{
							$('#emailerrormsg').css('visibility', 'hidden');
						}

		
			var nameinput =$("#nameid").val(); 
				var	name=/^[A-Za-z ]{2,50}$/;
				var res2=name.test(nameinput);
				if(res2!=true)
				{
					isform=true;
					$('#nameerrormsg').css('visibility', 'visible');
					//alert("format of name is wrong ");
				}

					else
				{
					$('#nameerrormsg').css('visibility', 'hidden');
				}
			

				var number =$("#contactid").val(); 
					var	number1=/^[0-9]{10}$/;
					var res3=number1.test(number);
					if(res3!=true)

					
					{
						isform=true;
						$('#numbererrormsg').css('visibility', 'visible');
						//alert("format of number is wrong ");
					}
					else
					{
						$('#numbererrormsg').css('visibility', 'hidden');
					}


					var address =$("#addressid").val(); 
					var	address1=/^[A-Za-z][a-z@-_0-9]{3,99}$/;
					var res4=address1.test(address);
					if(res4!=true)

					
					{
						isform=true;
						$('#addresserrormsg').css('visibility', 'visible');
						//alert("format of address is wrong ");
					}
					else
					{
						$('#addresserrormsg').css('visibility', 'hidden');
					}


					var password =$("#passwordid").val(); 
						password1=/^[0-9]{6}$/;
					var res5=password1.test(password);
						if(res5!=true)
					
					{
						isform=true;
						$('#passworderrormsg').css('visibility', 'visible');
						//alert("format of password is wrong ");
					}
					else
					{
						$('#passworderrormsg').css('visibility', 'hidden');
					}





						var pd1=$("#passwordid").val();
						
						var pd2=$("#confirmpasswordid").val(); 
								if (pd1!=pd2)
								{
									isform=true;
									$('#confirmpassworderrormsg').css('visibility', 'visible');
								//alert("password and confirm password doesn match");
								}
								else
						{
							$('#confirmpassworderrormsg').css('visibility', 'hidden');
						}
	
					

						 


						if(isform==false)
						{     
					        $("#myform").submit(); // Submit the form
					    }

					    else
					    {
					    	alert("Invalid form details");
					    }
					   



					});  

 

</script>


</div>

</body>


</html>
	 
<?php	 
 }
 
 ?>


