<?php
// add new field to the contact form
function build_form() {
?>

<div class="wrap">
  <h2>Add New Field:</h2>
  <form action="" method="post">
    <table border="0" cellspacing="10">
      <tr>
        <td>Tag: </td>
        <td><select name="tname">
            <option value="input">input</option>
            <option value="textarea">textarea</option>
          </select>
        </td>
        <td>id: </td>
        <td><input type="text" name="tid" style="width:70px;" /></td>
        <td>class: </td>
        <td><input type="text" name="class" style="width:70px;" /></td>
        <td>name: </td>
        <td><input type="text" name="name" style="width:70px;" /></td>
        <td>Default value: </td>
        <td><input type="text" name="value" style="width:70px;" /></td>
        <td>order: </td>
        <td><input type="text" name="torder" style="width:70px;" /></td>
        <td><input type="submit" name="add_field" value="Add" /></td>
      </tr>
    </table>
  </form>
</div>
<?php
}

// save new field to the database
function save_form_field() {
global $wpdb;
$table_name = $wpdb->prefix . "design_form";

$tname = $_POST['tname'];
$tid = $_POST['tid'];
$class = $_POST['class'];
$name = $_POST['name'];
$value = $_POST['value'];
$torder = $_POST['torder'];

$wpdb->insert( $table_name, array( 'tname' => $tname, 'tid' => $tid, 'class' => $class, 'name' => $name, 'value' => $value, 'torder' => $torder ) );
}

// single field update form
function update_contact_dform() {
	global $wpdb;
	$table_name = $wpdb->prefix . "design_form";
	$id = $_POST['eid'];
	$row = $wpdb->get_row("select * from $table_name where id=".$id.";");

	?>
<form action="" method="post">
  <table border="0" cellspacing="10">
    <tr>
      <td>Tag: </td>
      <td><select name="tname">
          <option value="input" <?php if($row->tname=='input') { ?>selected="selected"<?php } ?>>input</option>
          <option value="textarea" <?php if($row->tname=='textarea') { ?>selected="selected"<?php } ?>>textarea</option>
        </select>
      </td>
      <td>id: </td>
      <td><input type="text" name="tid" value="<?php echo $row->tid; ?>" style="width:70px;" /></td>
      <td>class: </td>
      <td><input type="text" name="class" value="<?php echo $row->class; ?>" style="width:70px;" /></td>
      <td>name: </td>
      <td><input type="text" name="name" value="<?php echo $row->name; ?>" style="width:70px;" /></td>
      <td>Default value: </td>
      <td><input type="text" name="value" value="<?php echo $row->value; ?>" style="width:70px;" /></td>
      <td>order: </td>
      <td><input type="text" name="torder" value="<?php echo $row->torder; ?>" style="width:70px;" /></td>
      <td><input type="hidden" name="update" value="<?php echo $row->id; ?>" />
        <input type="submit" value="Update" /></td>
    </tr>
  </table>
</form>
<?php
}

// single field delete form
function delete_form_entry() {
	global $wpdb;
	$table_name = $wpdb->prefix . "design_form";
	$did = $_POST['did'];
	$row = $wpdb->get_row("select * from $table_name where id=".$did.";");

	echo "
	<div class=\"wrap\">
	<p>Are you sure you want to delete form field with id ".$row->tid."?:</p>
	<form action=\"\" method=\"post\">
	<input type=\"hidden\" name=\"cdid\" value=".$row->id." />
	<input type=\"submit\" name=\"delete\" value=\"Yes, I am\" />
	<input type=\"submit\" name=\"\" value=\"Cancel\" />
	</form>
	</div>";
}

// executes and confirm update to the DB
function update_contact_form_confirm() {

			    $itemId = $_POST['update'];			    
				$tname = $_POST['tname'];
				$tid = $_POST['tid'];
				$class = $_POST['class'];
				$name = $_POST['name'];
				$value = $_POST['value'];
				$torder = $_POST['torder'];				

			  global $wpdb;
			  $table_name = $wpdb->prefix . "design_form";
			  $rows_affected = $wpdb->update( $table_name, array( 'tname' => $tname, 'tid' => $tid, 'class' => $class, 'name' => $name, 'value' => $value, 'torder' => $torder ), array('id' => $itemId) );
			  if($rows_affected)
			  echo "<br /><p>Form Field Successfully Updated!</p>";
			  else "Failed to update";


}

// shows the total form
function show_form() {

	global $wpdb;
	
	$table_name = $wpdb->prefix . "design_form";
	$myrows = $wpdb->get_results("select * from $table_name order by torder ASC");
	
	echo "<br /><div class=\"wrap\"><h2>Here is Your Form:</h2><table border=\"0\" cellpadding=\"20\" cellspacing=\"20\">";
	//if($myrows)
	//echo "<tr><td><strong>Id</strong></td><td><strong>First Name</strong></td><td><strong>Last Name</strong></td><td><strong>Email</strong></td><td><strong>Delete</strong></td></tr>";
	//else
	//echo "<tr><td><strong>There is no signed up member yet.</strong></td></tr>";
	
	foreach($myrows as $myrow) {
	echo "<tr>";
	echo "<td>$myrow->value</td><td>";
	
	if($myrow->tname=='input') {
	echo "<";
	echo $myrow->tname." id=\"$myrow->tid\" class=\"$myrow->class\" name=\"$myrow->name\" value=\"$myrow->value\"";
	echo " />";
	} else {
	echo "<textarea ";
	echo $myrow->tname." id=\"$myrow->tid\" class=\"$myrow->class\" name=\"$myrow->name\"";
	echo ">$myrow->value</textarea>";
	}
	
	echo "</td>";
	if($myrow->tid=='email' || $myrow->tid=='msgarea') {
	echo "<td align=\"right\">*</td><td>(required)</td>";
	} else {
	echo "<td><form action=\"\" method=\"post\"><input type=\"hidden\" name=\"eid\" value=".$myrow->id." /><input type=\"submit\" name=\"edit\" value=\"Edit\" /></form></td>";
	echo "<td><form action=\"\" method=\"post\"><input type=\"hidden\" name=\"did\" value=".$myrow->id." /><input type=\"submit\" value=\"delete\" /></form></td>";
	}
	echo "</tr>";
	}
	echo "</table></div>";

}


// confirm the changes to the form
if($_POST['add_field'])
save_form_field();

if($_POST['update']) {
update_contact_form_confirm();
}

if($_POST['delete']) {
    $did = $_POST['cdid'];
	global $wpdb;	
	$table_name = $wpdb->prefix . "design_form";
	$delete_status = $wpdb->query("delete from $table_name where id=".$did.";");

	if($delete_status) {
		echo "<br /><p>Field Successfully Deleted!</p>";
	}
}

// the form
show_form();

// add, update, delete operations
if($_POST['eid']) {
?>
<div class="wrap">
<h2>Update Field with id: <?php echo $_POST['eid']; ?></h2>
<?php
update_contact_dform();
echo "</div>";
} 

else if($_POST['did']) {
?>
<div class="wrap">
  <?php
delete_form_entry();
?>
</div>
<?php
}

else {
build_form();
}

?>
<p>[Note: please choose appropriate input for id, class and name.]</p>