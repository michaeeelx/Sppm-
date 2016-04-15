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

if(!isset($_SESSION["fname"])){
	$HTML = "Please login";
}
else{
	$HTML = "Logout Sucessful!\nThanks ".$_SESSION["fname"].".";
}
session_destroy();
echo $HTML;
?>