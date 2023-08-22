<?php 

echo '<option value="">Select Parent Menu</option>'; 
foreach($submenu_list as $key=>$value) {?>
<option value='<?php echo $key; ?>' <?php if(!empty($submenu_id) && ($key == $submenu_id)) { echo 'selected="selected"'; } ?>><?php echo $value; ?></option>
<?php } ?>
