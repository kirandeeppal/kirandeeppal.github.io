
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

	<span class="col-6 font-weight-bold"><?php echo "Welcome". $_SESSION["username"]; ?></span><a href="logoutsessiondestroy.php">

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

<div class="col-sm-12 text-center">
				<a href="manage_orders.php?show_status=ALL"><button class="btn btn-outline-primary">All Orders</button></a>
				<a href="manage_orders.php?show_status=DELIVERED"><button class="btn btn-outline-primary">Delivered</button></a>
				<a href="manage_orders.php?show_status=PENDING"><button class="btn btn-outline-primary">Pending</button></a>
			</div>


<?php 	
		//database connection

		$mysqli = new mysqli('localhost', 'root', '' );

		if (!$mysqli) 
		{
		 die('<h2 class="text-danger text-center">Failed To Connect To Database</h2>');        						
		}
	//	echo 'Connected successfully to mySQL. <BR>';
		 
		$mysqli->select_db("storeappliacation");

		
		// code for output of table content

		$orderStatusQuery=" AND od.status='0'";

		if(isset($_REQUEST['show_status']))
		{
			if(strcasecmp($_REQUEST['show_status'],"ALL")==0)
			{
				$orderStatusQuery=''; //Show All
			}
			else if(strcasecmp($_REQUEST['show_status'],"DELIVERED")==0)
			{
				$orderStatusQuery=" AND od.status='1'"; //Show only delivered items
			}
			else
			{
				$orderStatusQuery=" AND od.status='0'"; //Show only non delivered /Pending items

			}
		}
		
		 $sql = "SELECT od.*, ud.address,ud.contact,ud.email,ud.name,it.`item-name`,it.item_description,it.item_price,it.item_quantity FROM `orders` AS od,userdetail AS ud,item AS it WHERE od.user_id=ud.id AND od.item_id=it.id".$orderStatusQuery;

		$result1 = $mysqli->query($sql);


		if ($result1->num_rows > 0) 
		{
			// output data of each row
			//table

?>
			
<?php			

			echo "<div class='container mt-5'>";
			echo "<table class='table table-hover table-condensed' title='item-description'>";
			echo '<tr>';
			echo '<th>Item Name</th>' ;
			echo '<th>Name</th>';
			echo '<th>Contact</th>';
			echo '<th>Email</th>';
			echo '<th>Address</th>';
			echo '<th>Quantity Purchased</th>' ;
			echo '<th>Status</th>' ;
			echo '<th>Action</th>' ;
			echo '</tr>';
			
						


		   while($row = $result1->fetch_assoc()) 
		   {
				
				echo '<tr>';
				echo '<td>'. $row["item-name"].'</td>' ;  
				echo '<td>'.$row["name"].'</td>' ;
				echo '<td>'.$row["contact"].'</td>' ;
				echo '<td>'.$row["email"].'</td>' ;
				echo '<td>'.$row["address"].'</td>' ;
				echo '<td>'.$row["quantity_purchased"].'</td>' ;
				echo '<td>'.($row["status"]==0?'Pending':'Delivered').'</td>' ;
				echo '<td><a href ="manage_orders.php?id='.$row['id'].'" >Edit</a></td>';
										
				echo '<td><a href="delete.php?id='.$row['id'].'">Delete</a></td>';

			
				echo '</tr>';

			}
		}	

		else 
		{
			echo "<h2 class='text-center text-danger mt-5'>0 Orders</h2>";
		}

?>