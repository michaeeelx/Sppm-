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
$xmlFile = "data/patient.xml";

if (!file_exists($xmlFile))
	 	$HTML = "No Data.";
else {
	$doc = new DOMDocument();
	$doc->load($xmlFile);
	$x = $doc->getElementsByTagName("patient"); 

	foreach($x as $node) 
	{
		$id = $node->getElementsByTagName("Email");
		$id = $id->item(0)->nodeValue;

		$pass = $node->getElementsByTagName("Pass");
		$pass = $pass->item(0)->nodeValue;

		$fname = $node->getElementsByTagName("Fname");
		$fname = $fname->item(0)->nodeValue;

		$lname = $node->getElementsByTagName("Lname");
		$lname = $lname->item(0)->nodeValue;

		$medicareid = $node->getElementsByTagName("MedicareID");
		$medicareid = $medicareid->item(0)->nodeValue;

		if(strtoupper($_GET['email']) == strtoupper($id)){
			if($_GET["password"] == $pass){
				$HTML = "Sucessful!";
				session_start();
		    	$_SESSION["email"] = $_GET["email"];
		    	$_SESSION["password"] = $_GET["password"];
		    	$_SESSION["fname"] = $fname;
		    	$_SESSION["lname"] = $lname;
		    	$_SESSION["medicareid"] = $medicareid;
		    	break;
			}
			else{
				$HTML = "Wrong Password!";
			}
			break;
		}else{
			$HTML = "Wrong Email!";
		}

		//$HTML = $HTML.$custid." ".$password." ".$_GET["custid"]." ".$_GET["password"]." ";
	}
}

echo $HTML;
?>