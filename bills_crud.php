
<?php
 
require_once 'database-config.php';
 
if(isset($_POST['save']))
{
 
 $account_id= $_GET['account_id'];
 $category_id= $_GET['category_id'];
 $bill_desc= $_POST['bill_desc'];
 $bill_total= $_POST['bill_total'];
 $date=$_POST['bill_date'];
 $user_name=$username;

 $stmt = $dbh->prepare("call create_bills(:bd,:bt,:d,:ai,:ci,:user)");
 $stmt->execute(array(':bd'=> $bill_desc, ':bt'=> $bill_total, ':d'=> $date,':ai'=> $account_id, ':ci'=> $category_id,':user'=>$user_name ) );
 
 header("Location: bills.php?action=save&account_id=".$account_id."&category_id=".$category_id);
 
 }

 
if(isset($_GET['delete_id']) && isset($_GET['category_id']) && isset($_GET['account_id']) && isset($_GET['bill_total']))
{
 $id = $_GET['delete_id'];
 $cid = $_GET['category_id'];
 $ai= $_GET['account_id'];
 $amount=$_GET['bill_total'];
 
 
 $stmt = $dbh->prepare("call delete_bill(:ai,:cid,:id,:a)");
 $stmt->execute(array(':ai'=> $ai, ':cid'=> $cid,':id' => $id, ':a'=> $amount));
 
 header("Location: bills.php?save=create&action=delete&account_id=".$ai."&category_id=".$cid);
 
 
}
 


?>
