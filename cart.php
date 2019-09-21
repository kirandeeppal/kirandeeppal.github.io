

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

if(! empty($_GET['clearCart']) && $_GET['clearCart']==true)
{
	$_SESSION['myCart']=null;
	header('Location:itemlisting.php');
}

if(! empty($_GET['delete']) && $_GET['delete']==true)
{
	if(empty($_GET['id']))
	{
		echo '<h2>Error! Item ID Not Received</h2>';
	}
	else
	{
		if(findItemIndexInSession($_GET['id'])===false)
		{
			echo '<h2>Error! Item Not Found in the Cart</h2>';
		}
		else
		{
			$index=findItemIndexInSession($_GET['id']);
			array_splice($_SESSION['myCart'],$index,1);	
			echo '<h4 class="text-center text-primary">Item Removed</h4>';
		}
	}

}


?>

<div class="col-sm-12 bg-dark p-1 text-center text-white">
	
		<b style="font-size: 24px;">My Cart: </b>	
			
			<?php 
				if(isset($_SESSION['myCart']))
				{
					echo count($_SESSION['myCart']). ' Item(s)' ;
				}
				else
				{
					echo ' (currently empty) ';
				}
			 ?>
			 	
	 
</div>

<div class=" col-sm-12 text-right m-2">
		<a href="cart.php?clearCart=true">
			<button class="btn btn-outline-danger">Clear Cart</button>
		</a>
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


	if(!empty($_GET['id']) && !empty($_GET['itemquantity']))
	{
		$cartid =  $_GET['id']; 
		$itemquantity=$_GET['itemquantity'];

		if($itemquantity>3)
		{
			echo '<h2 class="text-center text-danger">Maximum Quantity Allowed is 3 units per item</h2>';
			exit;
		}


		
		if(! isset($_SESSION['myCart']))
		{
			//Our Cart is empty right now, so we will initialize it with an empty array

			$_SESSION['myCart']=array();
		}

		//-----------Checking if item already exist in Cart. If yes, we will only update its quantity ---------------//
		$itemCount=count($_SESSION['myCart']);

		if(findItemIndexInSession($_GET['id'])!==false)
		{
			//Item already exist in the Session's Cart
			$index=findItemIndexInSession($_GET['id']); 
			$_SESSION['myCart'][$index]['quantity']+=$_GET['itemquantity']; //Adding the quantity
		}
		else
		{
			//Item not present in the Session cart, so we will create new and add it
				$itemArray=array('id'=>$_GET['id'],'quantity'=>$_GET['itemquantity']);
				$_SESSION['myCart'][$itemCount]=$itemArray;
		}

	}

	if(isset($_SESSION['myCart']))
	{

		$itemCount=count($_SESSION['myCart']);

		if($itemCount>0)
		{
			$id=getCartItemIDs();
			
			 	$sql = "select `id`,`item-name`,`item_price`,`item_description` from item where id IN (".$id.")";

				$result1 = $mysqli->query($sql);
				if (!$result1->num_rows) 
				{
					echo '<h2 class="text-danger text-center">Could Not Find Item(s) in Database</h4>';
				}
				else
				{
?>
				<div class="container">
					<table class="table table-hover table-condensed">
<?php					
					$cartTotal=0; //Initially we assign it $0
					while($row = $result1->fetch_assoc())
					{
						echo "<tr>";
						$itemIndexInSession=findItemIndexInSession($row['id']);
						if($itemIndexInSession!==false)
						{
							$selectedItemQuantity=$_SESSION['myCart'][$itemIndexInSession]['quantity'];
							  
							 	echo'<td><b>Name=</b>'.$row['item-name'].'</td>';
							 	echo'<td><b>Price=</b>$'.$row['item_price'].'</td>';
							 	echo'<td><b>Description=</b>'.$row['item_description'].'</td>';
							 	echo'<td><b>Quantity Selected=</b>'.$selectedItemQuantity.'</td>';
							 	echo'<td><b>Total Price=</b>$'.$selectedItemQuantity * $row['item_price'].'</td>';
							 	echo'<td><a class="text-danger" href="cart.php?delete=true&id='.$row['id'].'">Remove</a></td>';
							 $cartTotal=$cartTotal+$selectedItemQuantity * $row['item_price'];
						}
						echo "</tr>";
					}

?>
					</table>

					<div class="col-sm-12 text-center">
						<h4><?php echo "Your Total: $".$cartTotal; ?></h4>
					</div>
				</div>

<?php
					  

				}
		}

		else
		{

?>
			<h2 class="text-center">Your Cart Is Empty</h2>
<?php	
		}

	}
	else
	{

?>
		<h2 class="text-center">Your Cart Is Empty</h2>
<?php	
	}

?>

<div class="col-sm-12 text-center mt-4">

	<a href="itemlisting.php"><button class="btn btn-secondary">Back To Shopping</button></a>
	<a href="checkout.php"><button class="btn btn-primary">Checkout</button>
	
</div>


<?php
	
	
	 

function findItemIndexInSession($itemId)
{

	/*
		This function returns index of item in the session or returns false if not found
	*/

	$itemCount=count($_SESSION['myCart']);
	for($i=0;$i<$itemCount;$i++)
	{
		//Comparing the ID of passed item with the ids present in the Session
		if($itemId == $_SESSION['myCart'][$i]['id'])
		{	
			return $i; //Return the Index where this item is found
		}
	}

	return false;				

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


		


