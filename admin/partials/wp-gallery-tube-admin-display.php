<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://github.com/9kmmr
 * @since      1.0.0
 *
 * @package    Wp_Gallery_Tube
 * @subpackage Wp_Gallery_Tube/admin/partials
 */




if (isset($_POST['settings'])) {

    update_option('blur',isset($_POST['blur'])?1:0);
	update_option('czechvr',isset($_POST['czechvr'])?1:0);
	update_option('naughtyamerica',isset($_POST['naughtyamerica'])?1:0);
	update_option('badoink',isset($_POST['badoink'])?1:0);
    update_option('vrbcash',isset($_POST['vrbcash'])?1:0);
    
}


$is_blur = get_option('blur');
$czechvr = get_option('czechvr');
$naughtyamerica = get_option('naughtyamerica');
$badoink = get_option('badoink');
$vrbcash = get_option('vrbcash');



?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->



