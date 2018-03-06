<?php
	session_start();
	?>
<!DOCTYPE html>
	
<html lang="en">
  <?php 
  /*
Subject Code and Section (INT322SAA)
Student Name
Date Submitted

Student Declaration

I/we declare that the attached assignment is my/our own work in accordance with Seneca Academic Policy. No part of this assignment has been copied manually or electronically from any other source (including web sites) or distributed to other students.

Name : QI BAO ZHENG

Student ID 047971130
*/
  include "library.php";


// check if user is logged in, if not redirect to login page
if(!(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']))
		include "login.php";
else
{


  $libary  = new lib(file("/home/int322_172a19/secret/topsecret"));
  $libary->generateHeader("View Items", "viewstyle");
  ?>
</html>

<?php
        if(isset($_POST['searchText']))
			 $input =  ($_POST['searchText']);
		 if(!isset($_POST['searchText']))
if($result = $libary->getRecords())
{
	
	if (mysqli_num_rows($result) > 0) 
	{

		echo "<table>" .
	 	       "<tr class='header'>" . 
		         "<th>ID</th>" . 
				 "<th>Item name</th>" . 
				 "<th>Desciption</th>" . 
				 "<th>Supplier</th>" . 
				 "<th>Cost</th>" . 
				 "<th>Price</th>" . 
				 "<th>Number On Hand</th>" . 
				 "<th>Reorder Level</th>" . 
				 "<th>On Back Order?</th>" . 
				 "<th>Delete/Restore</th>" . 
			   "</tr>";
							  

		while($row = mysqli_fetch_assoc($result)) 
		{
			$deleteURL = "delete.php?id=" . $row["id"];
						
			echo "<tr>" . 
		   	   "<td>" . $row["id"] . "</td>" . 
				   "<td>" . $row["itemName"] . "</td>" . 
				   "<td>" . $row["description"] . "</td>" . 
				   "<td>" . $row["supplierCode"] . "</td>" . 
				   "<td>" . $row["cost"] . "</td>" . 
				   "<td>" . $row["price"] . "</td>" . 
				   "<td>" . $row["onHand"] . "</td>" . 
				   "<td>" . $row["reorderPoint"] . "</td>" . 
				   "<td>" . $row["backOrder"] . "</td>" . 
				   "<td><a href='$deleteURL'>" . ($row["deleted"] == "n" ? "Delete" : "Restore") . "</a></td>" .
				 "</tr>";
		}
						
		echo "</table>";
	} 
	else 
		echo "No data in the database.";
}
		 if(isset($_POST['searchText']))
if($result = $libary->getSearch($input))
{	

	if (mysqli_num_rows($result) > 0) 
	{

		echo "<table>" .
	 	       "<tr class='header'>" . 
		         "<th>ID</th>" . 
				 "<th>Item name</th>" . 
				 "<th>Desciption</th>" . 
				 "<th>Supplier</th>" . 
				 "<th>Cost</th>" . 
				 "<th>Price</th>" . 
				 "<th>Number On Hand</th>" . 
				 "<th>Reorder Level</th>" . 
				 "<th>On Back Order?</th>" . 
				 "<th>Delete/Restore</th>" . 
			   "</tr>";
							  

		while($row = mysqli_fetch_assoc($result)) 
		{
			$deleteURL = "delete.php?id=" . $row["id"];
						
			echo "<tr>" . 
		   	   "<td>" . $row["id"] . "</td>" . 
				   "<td>" . $row["itemName"] . "</td>" . 
				   "<td>" . $row["description"] . "</td>" . 
				   "<td>" . $row["supplierCode"] . "</td>" . 
				   "<td>" . $row["cost"] . "</td>" . 
				   "<td>" . $row["price"] . "</td>" . 
				   "<td>" . $row["onHand"] . "</td>" . 
				   "<td>" . $row["reorderPoint"] . "</td>" . 
				   "<td>" . $row["backOrder"] . "</td>" . 
				   "<td><a href='$deleteURL'>" . ($row["deleted"] == "n" ? "Delete" : "Restore") . "</a></td>" .
				 "</tr>";
		}
						
		echo "</table>";
	} 
	else 
		echo "No data in the database.";
}
}
?>