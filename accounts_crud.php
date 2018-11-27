
<?php
 
require_once 'database-config.php';
 
if(isset($_POST['save']))
{
 $account_id= $_POST['account_id'];
 $account_name = $_POST['account_name'];
 $account_fund_type = $_POST['account_fund_type'];
 $account_available_funds= $_POST['account_funds_budgeted'];
 $account_funds_spent= 0 ;
 $account_funds_budgeted= $_POST['account_funds_budgeted'];
 $semester_year= $_POST['semester_year'];
 $School_code='SW'; 
 $stmt = $dbh->prepare("call create_accounts(:ai,:an,:aft,:aaf,:afs,:afb,:sy,:sc)");
 
 
 $stmt->execute(array(':ai'=> $account_id, ':an'=> $account_name, ':aft'=> $account_fund_type, ':aaf'=> $account_available_funds, ':afs'=> $account_funds_spent, ':afb'=> $account_funds_budgeted, ':sy'=> $semester_year, ':sc'=> $School_code) );
 header("Location: dean.php?action=save");
 
 }
if(isset($_GET['Account_id']))
{
	header("Location: categories.php");
}
 
if(isset($_GET['delete_id']))
{
 $id = $_GET['delete_id'];
 $stmt = $dbh->prepare("call delete_account(:id)");
 $stmt->execute(array(':id' => $id));
 header("Location: dean.php?action=delete");
 
 
}
 
if(isset($_GET['edit_id']))
{
 $stmt = $dbh->prepare("call view_accounts(:id)");
 $stmt->execute(array(':id' => $_GET['edit_id']));
 $editRow=$stmt->FETCH(PDO::FETCH_ASSOC);
 
 
}
 
if(isset($_POST['update']))
{
 $account_id= $_POST['account_id'];
 $account_funds_budgeted= $_POST['account_funds_budgeted'];
 $semester_year= $_POST['semester_year'];
 
 $stmt = $dbh->prepare("call update_accounts(:ai, :afb, :sy)");

 $stmt->execute( array(':ai'=> $account_id, ':afb'=> $account_funds_budgeted, ':sy'=> $semester_year) );
 header("Location: dean.php?action=update");
 
}

?>
