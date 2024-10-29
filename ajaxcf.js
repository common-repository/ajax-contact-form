function submit_me(){
var thename = jQuery("input#name").val();
jQuery.post(the_ajax_script.ajaxurl, jQuery("#ajaxForm").serialize(),function(response_from_the_action_function){
jQuery("#msgarea").val(response_from_the_action_function).css({"color":"green"});
}
);
}
jQuery(document).ready(function() {
jQuery('#ajaxForm input[type=text]').click(function() {
	if(this.value==this.defaultValue)
	jQuery(this).val("");					
});
jQuery('#ajaxForm textarea').click(function() {
	if(this.value==this.defaultValue)										
	jQuery(this).val("").css({"color":"#000"});					
});
});