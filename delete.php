<?php
	session_start();
	?>
<?php
/*Subject Code and Section (INT322SAA)
Student Name
Date Submitted

Student Declaration

I/we declare that the attached assignment is my/our own work in accordance with Seneca Academic Policy. No part of this assignment has been copied manually or electronically from any other source (including web sites) or distributed to other students.

Name : QI BAO ZHENG

Student ID 047971130
*/
if(!(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']))
		header('Location: view.php');
include "library.php";
		$dbInfo = file("/home/int322_172a19/secret/topsecret");
		$dburl = trim($dbInfo[0]);
        $uid = trim($dbInfo[1]);
        $pw = trim($dbInfo[2]);
        $dbname = trim($dbInfo[3]);
        $tablename = trim($dbInfo[4]);
        $link = mysqli_connect($dburl, $uid, $pw, $dbname) or die('Could not connect to ' . $dburl . ': ' . mysqli_error($link));
$id = $_GET['id'];
$libary = new lib(file("/home/int322_172a19/secret/topsecret"));
if($result = $libary->getRecords("deleted", "id=" . $id))
{
	if (mysqli_num_rows($result) > 0) 
	{
		$deleted = mysqli_fetch_assoc($result)["deleted"];
		

		$sql_query = "update " . $tablename . " " . 
					 "set deleted=" . ($deleted == "n" ? "'y'" : "'n'") . " " .
					 "where id=" . $id;
		$result = mysqli_query($link, $sql_query) or die('Query failed: '. mysqli_error($link));
	

		header('Location: view.php?' . ($deleted == "n" ? "deleted" : "restored"));
	}
	else
		echo "No item found with given ID.";
}
?>