<?php

require_once( 'C:\xampp\htdocs\co2serverclone\wp-load.php' );

if($_POST['formSubmit'] == "Submit")
{
	/* If statements for basic data verification */
	$errorMessage = "";
	
	if(empty($_POST['customer_name']))
	{
		$errorMessage .= "<li>You forgot to enter your name!</li>";
	}
	if(empty($_POST['customer_email']))
	{
		$errorMessage .= "<li>You forgot to enter your email!</li>";
	}
	if(empty($_POST['customer_age']))
	{
		$errorMessage .= "<li>You forgot to enter your age!</li>";
	}

	if(empty($errorMessage)) {
		/* Get the data and store it in the table if there are no errors */
		$customer_name = $_POST["customer_name"];
		$customer_email = $_POST["customer_email"];
		$customer_sex = $_POST["customer_sex"];
		$customer_age = $_POST["customer_age"];
		
		global $wpdb;
		$table_name = "wp_survey";
		$wpdb->insert( 'wp_survey', 
		array(
			'customer_name' => $customer_name,
			'customer_email' => $customer_email,
			'customer_sex' => $customer_sex,
			'customer_age' => $customer_age
		));
		
		/* Redirection to the success page (homepage for carbon) */
		header("Location: http://localhost/co2serverclone/survey2");
	}
}
?>
<html>
<head>
	<title>My Form</title>
</head>

<body>
	<!-- Display an error message if one exists from the data verification process -->
	<?php
		if(!empty($errorMessage)) 
		{
			echo("<p>There was an error with your form:</p>\n");
			echo("<ul>" . $errorMessage . "</ul>\n");
		} 
	?>
	
	<!-- Simple form for general customer information -->
	<form action="http://localhost/co2serverclone/wp-content/themes/jupiter/page-survey.php" method="post">
		Your Name: <input type="text" id="customer_name" name="customer_name" /><br />
		Your Email: <input type="text" id="customer_email" name="customer_email" /><br />
		Sex: <input type="radio" name="customer_sex" value="male" checked="checked">Male <input type="radio" name="customer_sex" value="female">Female<br />
		Your Age: <input type="text" id="customer_age" name="customer_age" /><br />		
		<input type="submit" name="formSubmit" value="Submit" />
	</form>
</body>
</html>