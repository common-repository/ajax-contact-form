<div class="wrap">
<h2>Ajaxcf Settings</h2>
<style>
form.mysettings textarea.css {
width:250px;
height:160px;
}
form.mysettings input[type=text] {
width:250px;
} 
</style>
<form method="post" action="options.php" class="mysettings">
    <?php settings_fields( 'baw-settings-group' ); ?>
    <?php //do_settings( 'baw-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Email Recipient:</th>
        <td><input type="text" name="ajaxcf_recipient" value="<?php echo get_option('ajaxcf_recipient'); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Email Subject</th>
        <td><input type="text" name="ajaxcf_subject" value="<?php echo get_option('ajaxcf_subject'); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Confirmation Email Subject:</th>
        <td><input type="text" name="ajaxcf_confirm" value="<?php echo get_option('ajaxcf_confirm'); ?>" /></td>
        </tr>
		<tr valign="top">
        <th scope="row">Custom CSS:</th>
        <td><textarea name="ajaxcf_custom_css" class="css"><?php echo get_option('ajaxcf_custom_css'); ?></textarea></td>
        </tr>
    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>

</form>
</div>
