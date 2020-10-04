<?php
	session_start();
	require_once "config.php";
	if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
   		$comment = $productCode = $userID = $starNumber = $subtitle = "";
   		if(isset($_POST['userID']))
   		{
   			$userID = $_POST['userID'];
   		}
   		if(isset($_POST['productCode']))
   		{
   			$productCode = $_POST['productCode'];
   		}
   		if(isset($_POST['comment']))
   		{
   			$comment = $_POST['comment'];
   		}
   		if(isset($_POST['starNumber']))
   		{
   			$starNumber = $_POST['starNumber'];
   		}
   		if(isset($_POST['subtitle']))
   		{
   			$subtitle = $_POST['subtitle'];
   		}
    	$sql = "INSERT INTO productreview(productCode, customerID, stars, subtitle, comments) VALUES(?,?,?,?,?)";
    	if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_productCode, $param_customerID, $param_stars, $param_subtitle, $param_comments);
            // Set parameters
            $param_productCode = $productCode;
            $param_customerID = $userID;
            $param_stars = $starNumber;
            $param_subtitle = $subtitle;
            $param_comments = $comment;
            // Attempt to execute the prepared statement

            if(mysqli_stmt_execute($stmt)){
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
        mysqli_close($link);
    }
?>