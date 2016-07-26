<?php

	function display_survey(){
		/* wpdb class should not be called directly. global $wpdb variable is an 
		   instantiation of the class already set up to talk to the WordPress database */ 
		global $wpdb;


		/* mulitple row results can be pulled from the database with get_results function 
		   and outputs an object which is stored in $result */
		$result = $wpdb->get_results( "SELECT * FROM wp_survey "); 


		/* If you require you may print and view the contents of $result object */
		echo "<pre>"; print_r($result); echo "</pre>";


		/* Print the contents of $result looping through each row returned in the result */
		echo "All rows: <br>";
		echo "customer_name,"." "."customer_email,"."customer_sex,"."customer_age,"."<br><br>";
		foreach($result as $row){
			echo $row->customer_name.", ".$row->customer_email.", ".$row->customer_sex.", ".$row->customer_age."<br>";
		}
		echo "<br><br>";
		
		echo "One specific row: <br>";
		echo $result[1]->customer_email;
		
	}
	
	display_survey();
	
?>
