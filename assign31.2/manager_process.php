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
$HTML = "";
$file = "data/manager.txt";

  if(!file_exists($file))
	    $HTML = $HTML."File is not found!";
	  else {
		$bowlers=file($file);

			for($i=0;$i<count($bowlers);$i++){

				$bowlers[$i]=str_replace("\n","",$bowlers[$i]);
				$curBowler = explode(", ",$bowlers[$i]);
				if (strtoupper($_GET["mngid"]) == strtoupper($curBowler[0])){

					if($_GET["password"] == $curBowler[1]){
						$HTML = "Sucessful!";
						session_start();
				    	$_SESSION["mngid"] = $_GET["mngid"];
				    	$_SESSION["password"] = $_GET["password"];
					}
					else{
						$HTML = "Wrong Password!";
					}
					break;
				}
				else{
					$HTML = "Wrong Manager Id!";
				}
			}
	  }

echo $HTML;

?>


