<?php
session_start();
    $username = $_SESSION['sess_username'];
    $role=$_SESSION['sess_userrole'];
    if(isset($_GET['account_id'])){
    $Account_id=$_GET['account_id'];
}
    if(isset($_GET['category_id'])){
		$Category_id=$_GET['category_id'];
	}
    if(!isset($_SESSION['sess_username'])){
      header('Location: index.php?err=2');
    }
require_once 'database-config.php';
if($_GET['table']=='accounts'){
$stmt = $dbh->prepare("SELECT * FROM `view_accounts` ");
$stmt->execute();
$columnHeader ='';
$columnHeader = "Account ID"."\t"."Account Name"."\t"."Account Fund Type"."\t"."Account Available Funds"."\t"."Account Funds Spent"."\t"."Account Funds Budgeted"."\t"."Semester Year"."\t"."School Code"."\t";
$setData='';
}
if($_GET['table']=='bills'){
$stmt = $dbh->prepare("call get_bills(:id,:cid)");
$stmt->execute(array( ':id'=> $Account_id, ':cid'=> $Category_id ));
$columnHeader ='';
$columnHeader = ""."\t".""."\t".""."\t".""."\t".""."\t".""."\t".""."\t".""."\t";
$setData='';
}
if($_GET['table']=='categories'){
$stmt = $dbh->prepare("SELECT * FROM `accounts_categories` where Account_id= :id ");
$stmt->execute(array( ':id'=> $Account_id ));
$columnHeader ='';
$columnHeader = ""."\t".""."\t".""."\t".""."\t".""."\t".""."\t".""."\t".""."\t";
$setData='';
}
while($rec =$stmt->FETCH(PDO::FETCH_ASSOC))
{
  $rowData = '';
  foreach($rec as $value)
  {
    $value = '"' . $value . '"' . "\t";
    $rowData .= $value;
  }
  $setData .= trim($rowData)."\n";
}
$filename = "Accounts_data" . date('Ymd') . ".xls";
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");
echo ucwords($columnHeader)."\n".$setData."\n";

?>
