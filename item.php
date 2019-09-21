<?php
	
	include_once('header.php');
 ?>



<?php 

if(isset($_SESSION['isAdmin']) && ! $_SESSION['isAdmin'])
{
	header('Location: index.php');
	exit();
}


if(isset ($_SESSION["username"]))

{
	?>
		<div class="col-12 text-right p-3">

	<span class="col-6 font-weight-bold"><?php echo "Welcome ". $_SESSION["username"]; ?></span><a href="logoutsessiondestroy.php">

	 <button class='btn btn-danger text-center'>Logout</button></a>

</div>
<?php
}

else{
	session_destroy();
$_SESSION=[""];

 header('Location: login.php');
}

$mysqli = new mysqli('localhost', 'root', '' );

	if (!$mysqli) 
	{
	 die('<h3 class="text-center text-danger">Could not connect</h3>');        						
	}
//	echo 'Connected successfully to mySQL. <BR>';
	 
	$mysqli->select_db("storeappliacation");



if(isset($_REQUEST['id']) && isset($_REQUEST['delete']) && $_REQUEST['delete']==true)
{

?>
	
	<?php
	 $query ="Delete from item where `id`=".$_REQUEST['id'];
	 $result1 = $mysqli->query($query);
	 if($result1)
	 {
	 	//Deleted Successfully
?>
		<h3 class="text-center text-danger mt-3 mb-5">Item Deleted Successfully</h3>
<?php

	 }
	   
		
}

?>



<h2 class="col-12 text-center text-white bg-dark" >Our Products</h2>	

<div class="container" style ="background-color:#f1f1f1">
	<div class="row">
		<div class="col-12">
											<!--php code for database connection and table display-->
										
			<div class="col-12 text-center text-white mt-3 mb-5" ><a href ="add.php" ><button class="btn btn-primary" >ADD ITEM</button></a></div>
			
			<?php 
	
					
					// code for output of table content
					
						$sql = "select `id`,`item-name`,`item_quantity`,`item_price`,`item_description` from item";
			
						$result1 = $mysqli->query($sql);
	 
	 
					if ($result1->num_rows > 0) 
					{
						// output data of each row
						//table
						echo "<table class='table text-center table-hover table-condensed ' title='item-description'>";
						echo '<tr>';
						echo '<th>Item Name</th>' ;
						echo '<th>Item Quantity</th>';
						echo '<th>Item Price</th>' ;
						echo '<th>Item Description</th>' ;
						echo '<th>Action</th>' ;
						echo '</tr>';
						
									
   

					   while($row = $result1->fetch_assoc()) 
					   {
							
							echo '<tr>';
							echo '<td>'. $row["item-name"].'</td>' ;  
							echo '<td>'.$row["item_quantity"].'</td>' ;
							echo '<td>'.$row["item_price"].'</td>' ;
							echo '<td>'.$row["item_description"].'</td>' ;
							echo '<td><a href ="edit.php?id='.$row['id'].'" >Edit</a></td>';
													
							echo '<td><a href="item.php?id='.$row['id'].'&delete=true"><h5 id="delete">Delete</h5></a></td>';

						
							echo '</tr>';

						}
					}	

					else 
					{
						echo "<br>0 results";
					}







			?>


<script>
	$("#delete").click(function(){
alert("you sure you want to delete");
			});
</script>


		</div>
	</div>
</div>
<body/>


</html>
