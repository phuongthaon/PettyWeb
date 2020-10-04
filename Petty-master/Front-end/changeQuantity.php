<?php
	session_start();

	if(isset($_GET['number']) && isset($_GET['id']))
	{
		for ($i=0; $i < sizeof($_SESSION['cart']); $i++) 
		{ 
			if($_SESSION['cart'][$i] == $_GET['id'])
			{
				$_SESSION['number'][$i] = $_GET['number'];
				//delete case
				if($_GET['number'] == 0)
				{
					array_splice($_SESSION['number'], $i, 1);
					array_splice($_SESSION['cart'], $i, 1);
					array_splice($_SESSION['price'], $i, 1);
				}//increase or decrease case
				else
				{
					echo number_format($_SESSION['number'][$i]*$_SESSION['price'][$i]);
				}	
				break;
			}
		}
		$total = 0;
		for ($i=0; $i < sizeof($_SESSION['cart']); $i++) 
		{ 
			$total+= $_SESSION['number'][$i]*$_SESSION['price'][$i];
		}
		echo " ".number_format($total);
	}
?>