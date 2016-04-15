<?php
/**
 * booking.htm
 *
 * @package    PHP-SRS
 * @author     David Tian - 1773834
 * @copyright  2016
 * @todo 	   PHP
 */
?>
<?php
session_start();

if(!isset($_SESSION["mngid"])){
	$HTML = "Please login";
}
else{
	$HTML = "Logout Sucessful!\nThanks ".$_SESSION["mngid"].".";
}
session_destroy();
echo $HTML;
?>