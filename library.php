<?php
/*Subject Code and Section (INT322SAA)
Student Name
Date Submitted

Student Declaration

I/we declare that the attached assignment is my/our own work in accordance with Seneca Academic Policy. No part of this assignment has been copied manually or electronically from any other source (including web sites) or distributed to other students.

Name : QI BAO ZHENG

Student ID 047971130
*/
//$dbInfo = file("/home/int322_172a19/secret/topsecret");

class lib {
	private $dburl;
	private $uid;
	private $pw;
	private $dbname;
	private $tablename;
	private $link ;
	private $login;
	function __construct($dbInfo)
	{
$this->dburl = trim($dbInfo[0]);
$this->uid = trim($dbInfo[1]);
$this->pw = trim($dbInfo[2]);
$this->dbname = trim($dbInfo[3]);
$this->tablename = trim($dbInfo[4]);
$this->link = mysqli_connect($this->dburl, $this->uid, $this->pw, $this->dbname) or die('Could not connect to ' . $this->dburl . ': ' . mysqli_error($this->link));

}
function generateHeader($title, $cssFile)
{
	echo "<head>" .
		   "<title>" . $title . "</title>" .
		   "<link href='CSS/normalize.css' rel='stylesheet' type='text/css' />" .
		   "<link href='CSS/" . $cssFile . ".css' rel='stylesheet' type='text/css' />" .
		 "</head>" . 
		 "" .
		 "<body>" .
		   "<nav>" .

		  
			 "<hr />" .
		     "<ul>" . 
			   "<li><a href='add.php'>Add</a></li>" .
			   "<li><a href='view.php'>View</a></li>" .
			   "<li><a href='logout.php'>Log out</a></li>" .
			    "<li><form method='post' action='view.php'>
<input type='text' name='searchText'/>
<input type='submit' value='Search'/>

</form>
</li>" .
			 "</ul>" .
			 "<hr />" .
		   "</nav>" .
		 "</body>";
		 
}

function getRecords($field = '*', $where = '')
{

	
	$sql_query = "SELECT " . $field . "	from " . $this->tablename . 
				 ($where != '' ? " where " . $where . ";" : ";");
	$result = mysqli_query($this->link, $sql_query) or die('Query failed: '. mysqli_error($this->link));
	
	return $result;
}
function setlogin()
{
	$this->login = true;
}
function getlogin()
{
	return $this->login;
}
function getSearch($input)
{
$sql_query ="SELECT * FROM " . $this->tablename. " WHERE description = '".$input."';";
	$result = mysqli_query($this->link, $sql_query) or die('Query failed: '. mysqli_error($this->link));
	
	return $result;
}
}
?>