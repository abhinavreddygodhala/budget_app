
<?php
 
require_once 'database-config.php';
 
if(isset($_POST['save']))
{
 $account_id= $_POST['acc_id'];
 $category_id= $_POST['cat_id'];
 $cat_name= $_POST['cat_name'];
 $cat_funds_total= $_POST['cat_funds_total'];
 $stmt = $dbh->prepare("call create_category(:ai,:ci,:cn,:cft)");
 $stmt->execute(array(':ai'=> $account_id, ':ci'=> $category_id, ':cn'=> $cat_name, ':cft'=> $cat_funds_total) );
 header("Location: categories.php?action=save&account_id=".$account_id);
 
 }
if(isset($_GET['Account_id']))
{
	header("Location: categories.php");
}
 
if(isset($_GET['delete_id']) && isset($_GET['category_id']))
{
 $id = $_GET['delete_id'];
 $cid = $_GET['category_id'];
 $stmt = $dbh->prepare("call delete_category_link(:id,:cid)");
 $stmt->execute(array(':id' => $id, ':cid'=> $cid));
 header("Location: categories.php?action=delete&account_id=".$id);
 
 
}
 
if(isset($_GET['edit_id']) && isset($_GET['cat_id']))
{
	
 $stmt = $dbh->prepare("SELECT * FROM `accounts_categories` where Account_id= :id and Categories_id=:cid");
 $stmt->execute(array(':id' => $_GET['edit_id'], ':cid'=> $_GET['cat_id']));
 $editRow=$stmt->FETCH(PDO::FETCH_ASSOC);
 
 
}
 
if(isset($_POST['update']))
{
 $account_id= $_POST['acc_id'];
 $cat_id= $_POST['cat_id'];
 $funds= $_POST['cat_funds_total'];
 
 $stmt = $dbh->prepare("call update_category_account_budget(:ai, :afb, :sy)");
 $stmt->execute( array(':ai'=> $account_id, ':afb'=> $cat_id, ':sy'=> $funds) );
 
 
 header("Location: categories.php?action=update&account_id=".$account_id);
 
}

?>
