
<?php
	
	include_once('header.php');
 ?>


<?php 

if(isset ($_SESSION["username"]))
{

?>

<div class="col-12 text-right p-3">

	<span class="col-6 font-weight-bold"><?php echo "Welcome ". $_SESSION["username"]; ?></span><a href="logoutsessiondestroy.php">

	 <button class='btn btn-danger text-center'>Logout</button></a>

</div>

		
<?php
}

else
{
	session_destroy();
	$_SESSION=[];

	 header('Location: login.php');
}
?>


	<script>

		function addItemToCart(itemID,inputTypeID)
		{
			var itemQuantity=document.getElementById(inputTypeID).value;
			if(itemQuantity==null || itemQuantity=='')
			{
				alert('Quantity cannot be empty');
				return;
			}

			if(itemQuantity>3)
			{
				alert('Maximum Quantity Allowed is 3 units per item');
				return;
			}

			//Following lines will execute only if quantity is valid
			console.log(itemID +" Quantity="+itemQuantity);
			window.open("cart.php?id="+itemID+"&itemquantity="+itemQuantity,"_self");
		}
	</script>
		

 <!--division section for table display-->
<h2 class="col-12 text-center text-white bg-dark" >Our Products</h2>							
<div class="container" style ="background-color:#f1f1f1; padding:50px;">


	<div class="row">
		<div class="col-12 text-right">

			<a href="cart.php"><span style="text-align:center">My Cart 

			<?php 
				if(isset($_SESSION['myCart']))
				{
					echo count($_SESSION['myCart']). ' Item(s)' ;
				}
				else
				{
					
				}
			 ?>
				
			</span></a></br><hr>	
		</div>
	</div>										
					
				
			<?php 
			
			
	
			
			
					//database connection
			
					$mysqli = new mysqli('localhost', 'root', '' );

					if (!$mysqli) 
					{
					 die('Could not connect:');        						
					}
				//	echo 'Connected successfully to mySQL. <BR>';
					 
					$mysqli->select_db("storeappliacation");

					
					// code for output of table content
					
					$sql = "select `id`,`item-name`,`item_price`,`item_description` from item";
		
					$result1 = $mysqli->query($sql);
 
	 
					if ($result1->num_rows > 0) 
					{
						// output data of each row
						//table
						echo "<table class='table text-center table-hover table-condensed ' title='item-description'>";
						echo '<tr>';
						echo '<th>item-name</th>' ;
						echo '<th>item_price</th>' ;
						echo '<th>item_description</th>' ;
						echo '<th>Enter Quantity</th>' ;
						echo '<th></th>' ;
						echo '</tr>';
						
									
   
						$i=0;
					   while($row = $result1->fetch_assoc()) 
					   {
							
							echo '<tr>';
							echo '<td>'. $row["item-name"].'</td>' ;  
							echo '<td>$'.$row["item_price"].'</td>' ;
							echo '<td>'.$row["item_description"].'</td>' ;
							echo '<td><input type="number" text-center style=" min-width:100px" max="3" min="0" id="itemQuantity'.$i.'" placeholder ="Quantity" name="userquantity"></td>';
													
							echo '<td><button onclick="addItemToCart('.$row["id"].',\'itemQuantity'.$i.'\')">Add To Cart</button></td>';
							

						
							echo '</tr>';
							$i++;

						}
					}	

					else 
					{
						echo "<br>0 results";
					}



				


			?>

	
</div>
<body/>


</html>





<?php



















?>