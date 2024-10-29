<?php

// delete form for single email
function delete_member() {
	global $wpdb;
	$table_name = $wpdb->prefix . "ajaxcf";
	$did = $_POST['did'];
	$row = $wpdb->get_row("select * from $table_name where id=".$did.";");

	echo "
	<div class=\"wrap\">
	<p>Are you sure you want to delete this email from this list?</p>
	<form action=\"\" method=\"post\">
	<input type=\"hidden\" name=\"eid\" value=".$row->id." />
	<input type=\"submit\" name=\"delete\" value=\"Confirm Delete\" />
	<input type=\"submit\" name=\"\" value=\"Cancel\" />
	</form>
	</div>";
}

// function for total email list
function show_signedup_members() {

	global $wpdb;
	
	$table_name = $wpdb->prefix . "ajaxcf";
	$myrows = $wpdb->get_results("select * from $table_name where name='email'");
	
	echo "<br /><div class=\"wrap\"><h2>Here is the Email List:</h2><table border=\"0\" cellpadding=\"20\" cellspacing=\"20\">";
	if($myrows)
	echo "<tr><td><strong>Email</strong></td><td><strong>Delete</strong></td></tr>";
	else
	echo "<tr><td><strong>There is no email yet.</strong></td></tr>";
	
	foreach($myrows as $myrow) {
	echo "<tr>";
	echo "<td>".$myrow->value."</td>";
	echo "<td><form action=\"\" method=\"post\"><input type=\"hidden\" name=\"did\" value=".$myrow->id." /><input type=\"submit\" value=\"delete\" /></form></td>";
	echo "</tr>";
	}
	echo "</table></div>";

}

// delete operation
if($_POST['did']) {
?>

<div class="wrap">
  <?php
delete_member();
?>
</div>
<?php
}

// comfirm delete
if($_POST['eid']) {
    $did = $_POST['eid'];
	global $wpdb;	
	$table_name = $wpdb->prefix . "ajaxcf";
	$delete_status = $wpdb->query("delete from $table_name where id=".$did.";");

	if($delete_status) {
		echo "<br /><p>Email address has been Successfully Deleted!</p>";
	}
	
}

// show the email list
show_signedup_members();

?>
