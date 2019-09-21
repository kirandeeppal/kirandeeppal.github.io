<?php
	include_once('header.php');
 ?>
<br>											
<?php 

$showform = true;

if(isset($_SESSION['isAdmin']) && ! $_SESSION['isAdmin'])
{
	header('Location: index.php');
	exit();
}
				$name1=$quantity1=$price1=$description1="";
				$name1err=$quantity1err=$price1err=$description1err="";


					if(!empty($_POST['name1'])&&!empty($_POST['quantity1'])&&!empty($_POST['price1'])&&!empty($_POST['description1']))
{
						$b1=preg_match("/^[A-Za-z]{2,50}$/",$_POST['name1']);
						$b2=($quantity1>=1&&$quantity<=500);
						$b3=($price1>=0&&$price<=100000);
						$b4=preg_match("/^[A-Za-z0-9!@#$%^&*(),.?\"\:\{\}\|\<\>]{2,50}$/",$_POST['description1']);


		if ($b1!=true)
		{
			echo '<h6 class="text-center text-danger">enter valid item name</h6>';
		}

		if ($b2!=true)
		{
			echo '<h6 class="text-center text-danger">quantity should lies between 1 to 500</h6>';}
			
		if ($b3!=true)
		{
			echo '<h6 class="text-center text-danger">price should range between 0 to 1 lakh</h6>';
		}

		if ($b4!=true)
		{
			echo  '<br><h6 class="text-center text-danger
			">characters limitation should be 500</h6>';}


			  $name1=$_POST['name1'];
			  $quantity1=$_POST['quantity1'];
			  $price1=$_POST['price1'];
			  $description1=$_POST['description1'];

		if($b1==true&&$b2==true&&$b3==true&&$b4==true)
		{	  
			  $name1=$_POST['name1'];
			  $quantity1=$_POST['quantity1'];
			  $price1=$_POST['price1'];
			  $description1=$_POST['description1'];														//database connections echo'successfully submitted<br>';
					$mysqli = new mysqli('localhost', 'root', '' );

					if (!$mysqli) 
					{
					 die('Could not connect:');        						//. mysqli_error($mysqli)//
					}
																	//echo 'Connected successfully to mySQL. <BR>';
					 
					$mysqli->select_db("storeappliacation");
																	// echo ("Selected the  database<br>");
 
 
 // Database entry part


    $query ="insert into item (`item-name`,`item_quantity`,`item_price`,`item_description`) values('$name1','$quantity1','$price1','$description1')";

	//echo $query.'<br>';	 
	 if($result=$mysqli->query($query))
	 { 
		//echo '<h2 class="text-center text-success">Item Successfully Added</h2>';
		// echo '<h4 class="text-center text-secondary"><b>Item Name:</b>'.$name1.'</h4>';
	
		 $showform=false;

?>
			<h2 class="text-center text-success">Item Successfully Added</h2>
			<?php echo '<h4 class="text-center text-secondary"><b>Item Name:</b>'.$name1.'</h4>'; ?>
			<div class="col-12 m-4 text-center">
				<a href="item.php"><button class="btn btn-outline-success">Back</button></a>
			</div>


<?php

	 }
	 else
	 { 
		//echo'error in entering value';
		  echo '<h2 class="text-center text-danger">Failed To Add Item</h2>';
		 
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
 
 

 else{ 
 ?>

                                            <!--division section for table display-->
											
<div class="container" style ="background-color:#f1f1f1">
	<div class="row">
		<div class="col-12">
			<form class="form-horizontal" action ="add.php" method="POST" id="myform">
			<h2 style="text-align:center">Add Item</h2><hr></br>	

				

			<div class="form-group">
					<label class="control-label col-sm-2" >NAME*</label><input class="col-sm-10" type="text" id="nameid" name="name1"required placeholder ="Enter item name" value="<?php echo $name1;?>"/><span id="nameerrormsg"  style="visibility:hidden "><h6 class= text-danger>*enter proper name </h6></span><span class="error"><b class= "text-danger"><?php echo $name1err;?></b>  </span> 	
			</div>

		  <div class="form-group">
					<label class="control-label col-sm-2" >QUANTITY*</label><input class="col-sm-10" type="number" id="quantityid" name="quantity1" placeholder ="Enter item quantity" value="<?php echo $quantity1;?>"/><span id="quantityerrormsg"  style="visibility:hidden "><h6 class= text-danger>*enter proper quantity </h6></span><span class="error">  <b class= "text-danger"><?php echo $quantity1err;?></b>  </span> 	
			</div>

			<div class="form-group">
					<label class="control-label col-sm-2" >PRICE*</label><input class="col-sm-10" type="number" name="price1" placeholder ="Enter item price"value="<?php echo $price1;?>"/><span id="priceerrormsg"  style="visibility:hidden "><h6 class= text-danger>*enter proper price </h6></span><span class="error">  <b class= "text-danger"><?php echo $price1err;?></b></span>
			</div>

			<div class="form-group">
					<label class="control-label col-sm-2" >DESCRIPTION*</label><input class="col-sm-10" type="text" name="description1" placeholder ="Enter item description"value="<?php echo $description1;?>"/><span id="descriptionerrormsg"  style="visibility:hidden "><h6 class= text-danger>*enter proper description </h6></span><span class="error">  <b class= "text-danger"><?php echo $description1err;?></b></span>	
			</div>

			<h5 style="text-align:center"><button class="btn btn-primary"type="button" id ="btnid" >ADD ITEM</button></h5>
			
			</form>
		
			<script>

			$(document).ready(function(){
			 
			});
			console.log("hiixbvbxn");

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
	

				$("#quantityid").change(function(){	
				var quantity1 =$("#quantityid").val(); 
					
					if(quantity1>=1&&quantity1<=500)
					{
						$('#quantityerrormsg').css('visibility', 'visible');
						//alert("format of name is wrong ");
					}

						else
					{
						$('#quantityerrormsg').css('visibility', 'hidden');
					}

					});
	

					$("#priceid").change(function(){	
					var price1 =$("#priceid").val(); 
						
						if(price1>=0&&price<=100000)

						
						{
							$('#priceerrormsg').css('visibility', 'visible');
							//alert("format of number is wrong ");
						}
						else
						{
							$('#priceerrormsg').css('visibility', 'hidden');
						}

					});


					$("#descriptionid").change(function(){	
					var description =$("#descriptionid").val(); 
					var	description1=/^[A-Za-z0-9!@#$%^&*(),.?\"\:\{\}\|\<\>]{2,50}$/;
					var res4=description1.test(description);
					if(res4!=true)

		
					{
						$('#descriptionerrormsg').css('visibility', 'visible');
						//alert("format of address is wrong ");
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

			

				var quantity1 =$("#quantityid").val(); 
					
					if(quantity1>=1&&quantity1<=500)
					{	
						isform=true;
						$('#quantityerrormsg').css('visibility', 'visible');
						//alert("format of name is wrong ");
					}

						else
					{
						$('#quantityerrormsg').css('visibility', 'hidden');
					}


					var price1 =$("#priceid").val(); 
						
						if(price1>=0&&price<=100000)

						
						{	
							isform=true;
							$('#priceerrormsg').css('visibility', 'visible');
							//alert("format of number is wrong ");
						}
						else
						{
							$('#priceerrormsg').css('visibility', 'hidden');
						}


					$("#descriptionid").change(function(){	
					var description =$("#descriptionid").val(); 
					var	description1=/^[A-Za-z0-9!@#$%^&*(),.?\"\:\{\}\|\<\>]{2,50}$/;
					var res4=description1.test(description);
					if(res4!=true)

		
					{	isform=true;
						$('#descriptionerrormsg').css('visibility', 'visible');
						//alert("format of address is wrong ");
					}
					else
					{
						$('#descriptionerrormsg').css('visibility', 'hidden');
					}

});  



						if(isform==false)
						{     
					        $("#myform").submit(); // Submit the form
					    }

					    else
					    {
					    	alert("Invalid form details");
					    }

 

</script>




			</div>
		</div>
	</div>


<?php	 
 }
 
 ?>


