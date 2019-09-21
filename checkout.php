

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


<?php


if(! isset($_SESSION['myCart']))
{
	echo '<h3 class="text-center text-danger">Your Shopping Cart Is Empty</h3>';
	echo '<h4 class="text-center text-secondary">Please Buy Some Item(s) Before Placing An Order</h4>';
	echo '<div class="text-center mt-4"><a href="itemlisting.php"><button class="btn btn-secondary">Shop Now</button></a></div>';

	exit();
}
else
{
	$mysqli = new mysqli('localhost', 'root', '' );

	if (!$mysqli) 
	{
	 die('Could not connect:');        						//. mysqli_error($mysqli)//
	}
	$mysqli->select_db("storeappliacation");

//-----------------Making Insert Query for all the items in the Cart----------------//
	$itemCount=count($_SESSION['myCart']);
	$query='';
	for($row=0;$row<$itemCount;$row++)
	 {
	 	 $query=$query."INSERT INTO `orders`(`user_id`, `quantity_purchased`, `item_id`) VALUES (".$_SESSION['userid'].",".$_SESSION['myCart'][$row]['quantity'].",".$_SESSION['myCart'][$row]['id'].");";
	 }
	 
	 if($result=$mysqli->multi_query($query))
	 {
	 	@mysqli_next_result($mysqli); //To execute more than 1 query simultaneousl

	 	//---------Order is Successful, we will send user an email-------------//
	 	$_SESSION['myCart']=null; //Emptying the cart of the user after placing the order
 			echo '<h2 class="text-center text-success">Order Placed Successfully</h2>';

 			//----------Getting user details to send him Email----------//
			$sql = "select * from userdetail where id=".$_SESSION['userid'];
			@$result1 = $mysqli->query($sql);
			
			if ($result1->num_rows && $row = $result1->fetch_assoc()) 
			{
				$userEmail=$row['email'];
				$userContact=$row['contact'];
				$userAddress=$row['address'];
?>

				<h3 class="text-center text-secondary">We will deliver your items to your address as soon as possible</h3>
				<h4 class="text-center text-secondary"><b>Address:</b><?php echo $userAddress; ?></h4>
<?php
				
				//Add mail function here

			}
		 
		
		echo '<div class="text-center mt-4"><a href="itemlisting.php"><button class="btn btn-primary">Shop More</button></a></div>';

	 }
	 else
	 { 
		//echo'error in entering value';
		 mysqli_error($mysqli);
	 
	 }
						
}

	
function getCartItemIDs()
{
	$itemCount=count($_SESSION['myCart']);
	$id='';
	for($row=0;$row<$itemCount;$row++)
	 {

	 	if($row==$itemCount-1)
	 	{
	 		$id.=$_SESSION['myCart'][$row]['id'];
	 	}
	 	else
	 	{
	 		$id.=$_SESSION['myCart'][$row]['id'].",";
	 	}
	 	


	 }

	 return $id;
}


?>