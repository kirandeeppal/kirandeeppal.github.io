<?php
	
	include_once('header.php');
 ?>										
											
<?php 


if(isset($_SESSION['isAdmin']) && ! $_SESSION['isAdmin'])
{
	header('Location: index.php');
	exit();
}

$showform = true;

				$name1=$quantity1=$price1=$description1="";
				$name1err=$quantity1err=$price1err=$description1err="";

if(!empty($_POST['name1'])&&!empty($_POST['quantity1'])&&!empty($_POST['price1'])&&!empty($_POST['description1']))
{
	 $parseid=$_POST['parseid'];
	 $name1=$_POST['name1'];
	 $quantity1=$_POST['quantity1'];
	 $price1=$_POST['price1'];
	 $description1=$_POST['description1'];



				
						$b1=preg_match("/^[A-Za-z]{2,50}$/",$_POST['name1']);
						$b2=($_POST['quantity1']>=1&&$_POST['quantity1']<=500);
						$b3=($_POST['price1']>=0&&$_POST['price1']<=100000);
						$b4=preg_match("/^[A-Za-z0-9!@#$%^&*(),.?\"\:\{\}\|\<\>]{1,500}$/",$_POST['description1']);


		if ($b1!=true)
		{
			$name1err= "*enter valid item name";
		}

		if ($b2!=true)
		{
			$quantity1err= "*uantity should lies between 1 to 500";
		}
			
		if ($b3!=true)
		{
			 $price1err= "*price should range between 0 to 1 lakh";
		}

		if ($b4!=true)
		{
			$description1err="*characters limitation should be 500";
		}

			
																
					$mysqli = new mysqli('localhost', 'root', '' );

					if (!$mysqli) 
					{
					 die('Could not connect:');        						
					}

					$mysqli->select_db("storeappliacation");
																	
 
 

	
	
	$query ="UPDATE item SET `item-name`='$name1' ,`item_quantity`='$quantity1',`item_price`='$price1',`item_description`='$description1' WHERE `id`=$parseid";
   

		//echo $query.'<br>';	 
		 if($result=$mysqli->query($query))
		 {
			 
			// echo 'you have successfully entered values'.$to.' and  '.$subject.' and '.$message;
		 }

	
		 else
		 { 
			//echo'error in entering value';
			 mysqli_error($mysqli);
		 
		 }
	
	//query for output of table															
																
			$sql = "select `id`,`item-name`,`item_quantity`,`item_price`,`item_description` from item";
			$result1 = $mysqli->query($sql);
	 
	$showform=false;			

	
}
 

 if($showform==false)
 {
	
	 echo'<h2 class="text-center text-success">Data Updated Successfully</h2>';
	  echo '<div class="col-sm-12 text-center mt-5"><a href="item.php"><button class="btn btn-primary">Back</button></a></div></br><hr></br>';

   	 
 }
 else
 { 

 	if(!isset($_REQUEST['id']))
 	{
?>
		<h2 class="text-center text-danger">Item Not Found</h2>
		<div class="col-sm-12 text-center mt-5">
			<a href="index.php"><button class="btn btn-primary">Home</button></a>
		</div>
<?php

		exit();
 	}


 ?>

										
<div class="container" style ="background-color:#f1f1f1">
	<div class="row">
		<div class="col-12">
		<form class="form-horizontal" action="edit.php" id="myform" method="POST">
			<h2 style="text-align:center">Edit Item Details</h2></br><hr></br>	
           
		   <?php 

			//database connections echo'successfully submitted<br>';
			$mysqli = new mysqli('localhost', 'root', '' );

			if (!$mysqli) 
			{
			 die('Could not connect:');        						//. mysqli_error($mysqli)//
			}
															//echo 'Connected successfully to mySQL. <BR>';
			 
			$mysqli->select_db("storeappliacation");
			
			
			$sql = "select `id`,`item-name`,`item_quantity`,`item_price`,`item_description` from item where `id`='".$_REQUEST['id']."'";

			$result1 = $mysqli->query($sql);
			if ($result1->num_rows > 0) 
			{
				$row = $result1->fetch_assoc();   				
			}
			else
			{
				echo '<h2 class="text-center text-danger">Item Not Found In Database</h2>';
				exit;
			}	

		   ?>			
			
		   <div class="form-group">
					<label class="control-label col-sm-2" >Name</label><input class="col-sm-10" type="text" name="name1" id="nameid" value =<?php echo '"'.$row['item-name'].'"';  ?> /><span id="nameerrormsg"  style="visibility:hidden "><h6 class= text-danger>*enter proper name</h6></span><span class="error"> <b class= "text-danger"> <?php echo $name1err;?></b></span> 
		  		<p id="demo"></p>	
			</div>

		  <div class="form-group">
					<label class="control-label col-sm-2" >QUANTITY</label><input class="col-sm-10" type="text" id="quantityid" name="quantity1" value =<?php echo '"'.$row['item_quantity'].'"';  ?>/><span id="quantityerrormsg"  style="visibility:hidden "><h6 class= text-danger>*enter proper quantity</h6></span><span class="error"> <b class= "text-danger"> <?php echo $quantity1err;?></b></span> 
		  		<p id="demo"></p>		
			</div>

			<div class="form-group">
					<label class="control-label col-sm-2" >PRICE</label><input class="col-sm-10" type="text" id="priceid" name="price1" value =<?php echo '"'.$row['item_price'].'"';  ?>/><span id="priceerrormsg"  style="visibility:hidden "><h6 class= text-danger>*enter proper price</h6></span><span class="error"> <b class= "text-danger"> <?php echo $price1err;?></b></span>	
			</div>

				<div class="form-group">
					<label class="control-label col-sm-2" >DESCRIPTION</label><input class="col-sm-10" type="text" id="descriptionid" name="description1" value =<?php echo '"'.$row['item_description'].'"';  ?>/><span id="descriptionerrormsg"  style="visibility:hidden "><h6 class= text-danger>*enter proper description</h6></span><span class="error"> <b class= "text-danger"> <?php echo $description1err;?></b></span>	
			</div>

			
			
			<input type="hidden" value="<?php echo $_REQUEST['id'] ?>" name="parseid" />
			
			
			<h5 style="text-align:center"><button class="btn btn-primary" type="button" id ="btnid" >UPDATE ITEM</button></h5>
		</form>



		<script>
			$(document).ready(function(){
			 
			});
			console.log("inside script");


				$("#nameid").change(function(){	
				var nameinput =$("#nameid").val(); 
				console.log(nameinput);
					var	name=/^[A-Za-z ]{2,50}$/;
					var res1=name.test(nameinput);
					if(res1!=true)
					{
						$('#nameerrormsg').css('visibility', 'visible');
						//("format of name is wrong ");
					}

						else
					{
						$('#nameerrormsg').css('visibility', 'hidden');
					}

					});


				$("#quantityid").change(function(){	
				
				var quantity = parseInt($("#quantityid").val(),10);
				console.log(quantity);
					var	name=/^[0-9]{1,3}$/;
					var res2=name.test(quantity);
					
					if(res2!=true || quantity<1 || quantity>500)
					{
							console.log('quantity false');
						$('#quantityerrormsg').css('visibility', 'visible');
					}

					else
					{
						
						$('#quantityerrormsg').css('visibility', 'hidden');
					}

					});




					$("#priceid").change(function(){	
				
				var price = parseInt($("#priceid").val(),10);
				console.log(price);
					var	name=/^[0-9]{1,6}$/;
					var res3=name.test(price);
					
					if(res3!=true || price<0 || price>100000)
					{
							console.log('price false ');
						$('#priceerrormsg').css('visibility', 'visible');
					}

					else
					{
						
						$('#priceerrormsg').css('visibility', 'hidden');
					}

					});


						$("#descriptionid").change(function(){	
				
				var description =$("#descriptionid").val();
				
					console.log(description);
					var	length=description.length;
					
					console.log(length);
					if(length>500 )
					{
							console.log('wrong length ');
						$('#descriptionerrormsg').css('visibility', 'visible');
					}

					else
					{
						
						$('#descriptionerrormsg').css('visibility', 'hidden');
					}

					});	


					$("#btnid").click(function(){

					

				var isform=false;	

			  		console.log("hiixbvbxn");	

					var nameinput =$("#nameid").val(); 
				console.log(nameinput);
					var	name=/^[A-Za-z ]{2,50}$/;
					var res1=name.test(nameinput);
					if(res1!=true)
					{

						isform=true;

						$('#nameerrormsg').css('visibility', 'visible');
						//alert("format of name is wrong ");
					}

						else
					{
						$('#nameerrormsg').css('visibility', 'hidden');
					}
		

					var quantity = parseInt($("#quantityid").val(),10);
				console.log(quantity);
					var	name=/^[0-9]{1,3}$/;
					var res2=name.test(quantity);
					
					if(res2!=true || quantity<1 || quantity>500)
					{

						isform=true;
							console.log('quantity false');
						$('#quantityerrormsg').css('visibility', 'visible');
					}

					else
					{
						
						$('#quantityerrormsg').css('visibility', 'hidden');
					}


					var price = parseInt($("#priceid").val(),10);
				console.log(price);
					var	name=/^[0-9]{1,6}$/;
					var res3=name.test(price);
					
					if(res3!=true || price<0 || price>100000)
					{	
						isform=true;
							console.log('price false ');
						$('#priceerrormsg').css('visibility', 'visible');
					}

					else
					{
						
						$('#priceerrormsg').css('visibility', 'hidden');
					}



					var description =$("#descriptionid").val();
				
					console.log(description);
					var	length=description.length;
					
					console.log(length);
					if(length>500 )
					{		
						isform=true;
							console.log('wrong length ');
						$('#descriptionerrormsg').css('visibility', 'visible');
					}

					else
					{
						
						$('#descriptionerrormsg').css('visibility', 'hidden');
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
	</div>
</div>
<body/>


</html> 
<?php	 
 }
 
 ?>
