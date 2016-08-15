<?php 

require_once 'configz.php';
//mysql_query($sqlApiAccess) or die('Error, insert query failed');



function GroupDemo() {

	if (is_user_logged_in ()) :
	?>
	<p>
	<!-- start form -->
	<form id="create-group" action="http://www.ronlum.com/wp-content/themes/jupiter-child/groupz-add.php" method="post">
	<h2>Add A Group</h2>
		Group ID: <input type="text" name="id" value="<?php 

			$result = mysql_query("SELECT count(*) FROM groups");
			//$row = mysql_num_rows($result); 
			//echo $row;
			echo mysql_result($result,0) + 1;

		 ?>" readonly style="border:none; box-shadow:none; background:none"><br>
		Group Name: <input type="text" name="name" required> <br>
		Admin: <input type="text" value="<?php $cu = wp_get_current_user(); echo $cu->display_name; ?>, ID #<?php echo get_current_user_id(); ?>" style="border:none; box-shadow:none; background:none"><input type="hidden" name="admin" value="<?php echo get_current_user_id(); ?>"><br> 

		Private?: <select name="privacy"><option value="0">No</option><option value="1">Yes</option></select><br>
		Location: <input type="text" name="location" required><br>
		<input type="submit" value="ADD GROUP">
	</form>
	<!-- end form -->
	<?php 



	//$query = mysql_query(" SELECT * FROM groups") or die('query 1 failed');

	//$query2 = mysql_query(" SELECT group_id, COUNT( * ) AS  'num' FROM groups_members GROUP BY group_id ") or die('query 2 failed');
	
	$query = mysql_query ("  SELECT * FROM groups LEFT JOIN (SELECT groups_members.group_id, COUNT(*) AS 'num' FROM groups_members GROUP BY group_id) B on groups.group_id = B.group_id" );
	
	//echo "<code>SELECT * FROM groups</code><code>SELECT group_id, COUNT( * ) AS  'num' FROM groups_members GROUP BY group_id</code>";
	
	echo "<code>SELECT * FROM groups LEFT JOIN 
	(SELECT groups_members.group_id, COUNT(*) 
	AS 'num' FROM groups_members GROUP BY group_id) B 
	ON groups.group_id = B.group_id</code>";

	//
	echo '<table class="griddy"><tr>
	<th>GROUP ID</th>
	<th>NAME</th>
	<th>ADMIN</th>
	<th>PRIVATE?</th>
	<th>LOCATION</th>
	<th>MEMBERS</th></tr>';
	
	while ( $row = mysql_fetch_array($query, MYSQL_NUM)) {
		echo '<tr>';
			echo '<td>'.$row[0].'</td>';
			echo '<td>'.$row[1].'</td>';
			echo '<td>'.$row[2].'</td>';
			echo '<td>';
			if ( $row[3] == 0 ) : 
				echo 'public'; 
			else : 
				echo 'private'; 
			endif;
			echo '</td>';
			echo '<td>'.$row[4].'</td>';
			echo '<td>';
			if ($row[6] == NULL) :
				echo '<em>NULL</em>'; 
			else :
				echo $row[6];
			endif;
			echo '</td>'; //start # members
			
			//	while ( $row2 = mysql_fetch_array($query2, MYSQL_NUM) ) {	
						
			//		if ( $row[0] = $row2[0] ) :
			//			echo $row2[1];
			//			break;
					//else :
					//	echo 'none';
			//		endif;
					
			//	} 
			
			
			//echo '</td>'; //end # members
			
		echo '</tr>';
	}
	
	echo '</table>';
	
	
// outputting groups JOIN groups_members

$query3 = mysql_query("SELECT groups.group_id, group_name, member_id, display_name 
FROM groups_members
JOIN groups ON groups.group_id = groups_members.group_id
JOIN wp_users ON groups_members.member_id = wp_users.ID ORDER BY group_id, member_id") or die("query 3 failed");

echo '<code>SELECT groups.group_id, group_name, member_id, display_name 
FROM groups_members
JOIN groups ON groups.group_id = groups_members.group_id
JOIN wp_users ON groups_members.member_id = wp_users.ID ORDER BY group_id, member_id</code>';

echo '<table class="griddy"><tr><th>Group ID</th><th>Group Name</th><th>Member ID</th><th>Member Name</th></tr>';

while ($row3 = mysql_fetch_array($query3, MYSQL_NUM) )
{
	echo '<tr>';
	echo '<td>'.$row3[0].'</td>';
	echo '<td>'.$row3[1].'</td>';
	echo '<td>'.$row3[2].'</td>';
	echo '<td>'.$row3[3].'</td>';
	echo '</tr>';
}
echo '</table>';	
	
	
	else : 
		echo '<div class="center">You must be logged in to view this page and add a group</div>';
	endif;
	
	
} // end groupdemo script
add_shortcode('groupz', 'GroupDemo');





function GroupShow() {

	if (is_user_logged_in ()) :
	
		$id= get_current_user_id ();


		
		$q = mysql_query ("  SELECT groups.group_id, group_name, member_id, display_name FROM groups_members
JOIN groups ON groups.group_id = groups_members.group_id
JOIN wp_users ON groups_members.member_id = wp_users.ID WHERE member_id='".$id."' ORDER BY group_id, member_id  " );

	echo '<code>SELECT groups.group_id, group_name, member_id, display_name FROM groups_members
JOIN groups ON groups.group_id = groups_members.group_id
JOIN wp_users ON groups_members.member_id = wp_users.ID WHERE member_id= (current logged in user ID) ORDER BY group_id, member_id   </code>';


	echo '<table class="griddy"><tr><th>Group ID</th><th>Group Name</th><th>Member ID</th><th>Display Name</th></tr>';

while ($row3 = mysql_fetch_array($q, MYSQL_NUM) )
{
	echo '<tr>';
	echo '<td>'.$row3[0].'</td>';
	echo '<td>'.$row3[1].'</td>';
	echo '<td>'.$row3[2].'</td>';
	echo '<td>'.$row3[3].'</td>';
	echo '</tr>';
}
echo '</table>';	
	
	
	
	
	
	
	else : 
		echo '<div class="center">You must be logged in to view your groups</div>';
	endif;
	
	
} // end groupdemo script
add_shortcode('list_group', 'GroupShow');




