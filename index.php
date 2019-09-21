
<?php
	
	include_once('header.php');
 ?>

 <style>
		.indexImage
		{
		    width: 100%;
		    max-height: 500px;
		    object-fit: cover;
		}

		.overlay 
		{  
			  width:100%;
			  height:100%;
			  position: absolute;
			  z-index: 2;
			  opacity:1;
			  background: rgba(0, 0, 0, 0.54);
			  transition: opacity 200ms ease-in-out;
			  border-radius: 4px;	  
		}

	</style>


	<div class="panel-body" style="position: relative;">
		<div class="overlay">
			
		</div>

		<img class="img-responsive img-rounded indexImage" src="images/index_image.jpg"/>

	</div>

	<div class="text-center text-primary"><h2>Welcome To Kiran's Sports Store</h2></div>
	<div class="text-center badge-default"><h4>Yaha Sab Kuch Milega</h4></div>
	
</body>
</html>