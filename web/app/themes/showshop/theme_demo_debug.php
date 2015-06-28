<?php 
/**
 * Template: Theme options debug
 * Description: Theme options debug
 */
 
?>

<pre>
<?php
global $as_of;
$data_r = print_r( $as_of ); 
//$data_r_sans = htmlspecialchars( $data_r, ENT_QUOTES ); 
//echo esc_js($data_r_sans); ?>
</pre>