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
$itemErr = "";
$descErr = "";
$suppCodeErr = "";
$costErr = "";
$sellerr = "";
$onhanderr = "";
$reorderPtErr = "";
$itemChecked = false;
$descChecked = false;
$suppCodeChecked = false;
$costChecked = false;
$sellPriceChecked = false;
$onHandChecked = false;
$recordckeck = false;
$allChecked = false;

$itemName = "";
$desc = "";
$suppCode = "";
$cost = "";
$sellPrice = "";
$onHand = "";
$reorderPt = "";
$backOrder = "";
if($_POST)
{

	$itemName = trim($_POST['itemName']);
	$desc = trim(htmlspecialchars($_POST['desc']));
	$suppCode = trim($_POST['suppCode']);
	$cost = trim($_POST['cost']);
	$sellPrice = trim($_POST['sellPrice']);
	$onHand = trim($_POST['onHand']);
	$reorderPt = trim($_POST['reorderPt']);
	isset($_POST['backOrder']) ? $backOrder = "y" : $backOrder = "n";
	

	if($itemName != '')
	{
		if(preg_match("/^[a-zA-Z0-9;:,' -]*$/", $itemName))
			$itemChecked = true;
		else
			$itemErr = "<span class='error'>Item name can only contain:</span> characters, " . 
						   "numbers, colons, semi-colons, commas, apostrophes, spaces, and dashes.";
	}
	else
		$itemErr = "Item name can <span class='error'>not</span> be left blank.";
	

	if($desc != '')
	{
		if(preg_match("/^[a-zA-Z0-9.,'\r\n -]*$/", $desc))
			$descChecked = true;
		else
			$descErr = "<span class='error'>Description can only contain:</span> characters, " . 
						   "numbers, periods, commas, apostrophes, spaces, and dashes.";
	}
	else
		$descErr = "Description can <span class='error'>not</span> be left blank.";
	

	if($suppCode != '')
	{
		if(preg_match("/^[a-zA-Z0-9 -]*$/", $suppCode))
			$suppCodeChecked = true;
		else
			$suppCodeErr = "<span class='error'>Supplier code can only contain:</span> characters, " . 
						   "numbers, spaces, and dashes.";
	}
	else
		$suppCodeErr = "Supplier code can <span class='error'>not</span> be left blank.";
	

	if($cost != '')
	{
		if(preg_match("/^\d+\.\d{2}$/", $cost))
			$costChecked = true;
		else
			$costErr = "<span class='error'>Cost can only be:</span> monetary amounts, " . 
						   "one or more digits, followed by two decimal points.";
	}
	else
		$costErr = "Cost can <span class='error'>not</span> be left blank.";
	

	if($sellPrice != '')
	{
		if(preg_match("/^\d+\.\d{2}$/", $sellPrice))
			$sellPriceChecked = true;
		else
			$sellerr = "<span class='error'>Sell price can only be:</span> monetary amounts, " . 
						   "one or more digits, followed by two decimal points.";
	}
	else
		$sellerr = "Sell price can <span class='error'>not</span> be left blank.";
	

	if($onHand != '')
	{
		if(preg_match("/^\d+$/", $onHand))
			$onHandChecked = true;
		else
			$onhanderr = "<span class='error'>On hand amount can only be:</span> digits.";
	}
	else
		$onhanderr = "On hand amount can <span class='error'>not</span> be left blank.";
	

	if($reorderPt != '')
	{
		if(preg_match("/^\d+$/", $reorderPt))
			$recordckeck = true;
		else
			$reorderPtErr = "<span class='error'>Reorder point can only be:</span> digits.";
	}
	else
		$reorderPtErr = "Reorder point can <span class='error'>not</span> be left blank.";
	

	if($itemChecked && $descChecked && $suppCodeChecked && $costChecked && $sellPriceChecked && $onHandChecked && $recordckeck)
	{
		$allChecked = true;
		$dbInfo = file("/home/int322_172a19/secret/topsecret");
		$dburl = trim($dbInfo[0]);
        $uid = trim($dbInfo[1]);
        $pw = trim($dbInfo[2]);
        $dbname = trim($dbInfo[3]);
        $tablename = trim($dbInfo[4]);
        $link = mysqli_connect($dburl, $uid, $pw, $dbname) or die('Could not connect to ' . $dburl . ': ' . mysqli_error($link));
		$sql_query = "insert into " . $tablename . " (itemName, description, supplierCode, cost, price, onHand, reorderPoint, backOrder, deleted) " . 
					 "values('" . $itemName . "', '" . $desc . "', '" . $suppCode . "', " . $cost . ", " . $sellPrice . ", " . $onHand . ", " . $reorderPt . ", '" . $backOrder . "', 'n')";
		$result = mysqli_query($link, $sql_query) or die('Query failed: '. mysqli_error($link));
		

		if($result)
			header('Location: view.php');
	}	
}
?>

<!DOCTYPE html>
<html lang="en">
  
	
  <p class="req">All fields mandatory except "On Back Order"</p>
  
  <form method="post" action="add.php">
    <table>
	  <tr>
	    <td class="leftTD">Item name:</td>
		<td><input type="text" name="itemName" id="itemName" value="<?php if($itemName != '') echo $itemName; ?>" /></td>
		<td class="error"><?php if(!$itemChecked) echo $itemErr; ?></td>
	  </tr>
	  
	  <tr>
	    <td class="leftTD">Description:</td>
		<td><textarea name="desc" id="desc" ><?php if($desc != '') echo $desc; ?></textarea></td>
		<td class="error"><?php if(!$descChecked) echo $descErr; ?></td>
	  </tr>
	  
	  <tr>
	    <td class="leftTD">Supplier Code:</td>
		<td><input type="text" name="suppCode" id="suppCode" value="<?php if($suppCode != '') echo $suppCode; ?>" /></td>
		<td class="error"><?php if(!$suppCodeChecked) echo $suppCodeErr; ?></td>
	  </tr>
	  
	  <tr>
	    <td class="leftTD">Cost:</td>
		<td><input type="text" name="cost" id="cost" value="<?php if($cost != '') echo $cost; ?>" /></td>
		<td class="error"><?php if(!$costChecked) echo $costErr; ?></td>
	  </tr>
	  
	  <tr>
	    <td class="leftTD">Selling price:</td>
		<td><input type="text" name="sellPrice" id="sellPrice" value="<?php if($sellPrice != '') echo $sellPrice; ?>" /></td>
		<td class="error"><?php if(!$sellPriceChecked) echo $sellerr; ?></td>
	  </tr>
	  
	  <tr>
	    <td class="leftTD">Number on hand:</td>
		<td><input type="text" name="onHand" id="onHand" value="<?php if($onHand != '') echo $onHand; ?>" /></td>
		<td class="error"><?php if(!$onHandChecked) echo $onhanderr; ?></td>
	  </tr>
	  
	  <tr>
	    <td class="leftTD">Reorder Point:</td>
		<td><input type="text" name="reorderPt" id="reorderPt" value="<?php if($reorderPt != '') echo $reorderPt; ?>" /></td>
		<td class="error"><?php if(!$recordckeck) echo $reorderPtErr; ?></td>
	  </tr>
	  
	  <tr>
	    <td class="leftTD">On Back Order:</td>
		<td><input type="checkbox" name="backOrder" id="backOrder" <?php if($_POST){ if(isset($_POST['backOrder'])) echo "checked";} ?> /></td>
	  </tr>
	  
	  <tr>
	    <td class="leftTD"><input type="submit" /></td>
		<td></td>
	  </tr>
	</table>
  </form>
</html>