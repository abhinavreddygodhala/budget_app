<?php 
	session_start();
    $username = $_SESSION['sess_username'];
    $role= $_SESSION['sess_userrole'];
    if(!isset($_SESSION['sess_username'])){
      header('Location: index.php?err=2');
    }
    if(isset($_GET['account_id'])){
		$Account_id=$_GET['account_id'];
		
	}
	if(isset($_GET['category_id'])){
		$Category_id=$_GET['category_id'];
		
	}
	
	?>	
   

<?php
require_once 'bills_crud.php';
?>
<!DOCTYPE html>
<html lang="en">
<style type="text/css">
input
{
 width:100%;
}
</style>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School Of Social Work</title>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="css/table.css" type="text/css" />
   
  </head>
  <body>
    
    <div class="bs-example">
    <nav class="navbar navbar-default">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php
			if($role=='dean'){
				$ur="categories.php?account_id=";
				$u='dean.php';
			}
			if($role=='secretary'){
				$ur="secretary_cat.php?account_id=";
				$u='secretary.php';
			}
			?>
			 </div>
            <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-left">
			<li><a href=<?php echo $ur ?><?php print($Account_id);?> >Back</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			<li><a href=<?php echo $u ?>>Home</a></li>
			</ul>
			
            </div>
			
    </nav>
</div>

    <div class="container homepage">
      <div class="row">
			     
         
            
            
            
				
            <div id="bodyForm"><!-- Body Form Begin -->
			<div id="screenTitle"><h2>School Of Social Work</h2></div>
			<div id="screen"><!-- screen begin -->
			
			
			
			<div class="panel">
 <?php
  
  if(isset($_GET['action']))
  {
	   


 if($_GET['action']=='save')
	   {
	   ?><div class="alert alert-success fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Saved!!</strong> 
    successfully.
    </div>
<?php
}
 if($_GET['action']=='delete')
	   {
	   ?><div class="alert alert-danger fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Deleted!!</strong> 
    successfully.
    </div>
	<?php
}
}
	?>
  
 
  <?php
 
  $stmt = $dbh->prepare("SELECT * FROM `view_accounts` where Account_id= :id ");
  $stmt->execute(array( ':id'=> $Account_id ));
  ?>
  <table border="1" width="40%" class="table table-bordered">
    <thead>
		<?php
		if($stmt->rowCount() > 0)
		{
		while($row=$stmt->FETCH(PDO::FETCH_ASSOC))
		{ ?>
		<h3><?php echo $row['Account_name'].'-'.$row['semester_year']; ?></h3>
		<tr class="success">
        <td>Funds Budgeted</td>
        <td>Funds Spent</td>
        <td>Available Funds</td>
        </tr>
        
        
      </tr>
    </thead>
	   <tr class="active">
       <td><?php print($row['Account_funds_budgeted']); ?></td>
       <td><?php print($row['Account_funds_spent']); ?></td>
       
       <td><?php print($row['Account_available_funds']); ?></td>
       
       </tr>
       <?php
   }
  }
  else
  {
   ?>
      <tr>
      <td><?php print("nothing here...");  ?></td>
      </tr>
      <?php
  }
  ?>
  </table>
	
  <?php
 
  $stmt = $dbh->prepare("SELECT * FROM `accounts_categories` where Account_id= :id and Categories_id= :cid");
  $stmt->execute(array( ':id'=> $Account_id, ':cid'=> $Category_id ));
  ?>
  <table border="1" width="40%" class="table table-bordered">
    <thead>
		<?php
		if($stmt->rowCount() > 0)
		{
		while($row=$stmt->FETCH(PDO::FETCH_ASSOC))
		{ ?>
		<h4><?php print($row['Account_Fund_Type'].'-'.$row['Account_id'].'-'.$row['Categories_id'].' - '.$row['Categorie_name']); ?></a></h4>
		<tr class="success">
		
        <td>Funds Budgeted</td>
        <td>Funds Spent</td>
        <td>Available Funds</td>
        
      </tr>
    </thead>
    
	   <tr class="active">
       <td><?php print($row['funds_total']); ?></td>
       <td><?php print($row['funds_spent']); ?></td>
       <td><?php print($row['funds_available']); ?></td>
       </tr>
       <?php
   }
  }
  else
  {
   ?>
      <tr>
      <td><?php print("nothing here...");  ?></td>
      </tr>
      <?php
  }
  ?>
  </table>
</div>

                
                
               
			
			
				
 </div>
</div>    
    		
    
<div class="bs-example">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#sectionA">Create New Bill</a></li>
        <li><a data-toggle="tab" href="#sectionB">View Bills</a></li>
        
    </ul>
    <div class="tab-content">
        <div id="sectionA" class="tab-pane fade in active">
           
            <form method="post">          
			<table border="1" width="40%" cellpadding="15" class="table table-bordered">
			<thead>
			<tr>
			<td><input type="text" name="bill_desc" placeholder="Bill Description" required></td>
			</tr>
			<tr>
			<td><input type="number" step="0.01" name="bill_total" placeholder="Total Amount" required></td>
			</tr>
			<tr>
			<td><input type="date" name="bill_date"   placeholder="Bill Date" required></td>
			</tr>
			<td><button type="submit" name="save" class="btn btn-success">save</button></td>
			</thead>
			</table>
            </form>
			
            
            </div>
        <div id="sectionB" class="tab-pane fade">
            <?php
 
  $stmt = $dbh->prepare("call get_bills(:id,:cid)");
  $stmt->execute(array( ':id'=> $Account_id, ':cid'=> $Category_id ));
  ?>
  <table border="1" width="40%" class="table table-bordered">
    <thead>
		<th><a href="export_excel.php?table=bills&account_id=<?php echo $Account_id; ?>&category_id=<?php echo $Category_id; ?>">Export Excel</a></th>
		<tr class="success">
		<td>Bill Id</td>
        <td>Bill Description</td>
        <td>Total Amount</td>
        <td>Bill Date</td>
        <td>Updated By</td>
        <td>Delete</td>
      </tr>
    </thead>
    <?php
		if($stmt->rowCount() > 0)
		{
		while($row=$stmt->FETCH(PDO::FETCH_ASSOC))
		{ ?>
	   <tr class="active">
       <td><?php print($row['bill_id']); ?></td>
       <td><?php print($row['bill_description']); ?></td>
       <td><?php print($row['bill_total_amount']); ?></td>
       <td><?php print($row['bill_date_time']); ?></td>
       <td><?php print($row['user_who_updated']); ?></td>
       <td><a onclick="return confirm('Sure to Delete ? ')" href="bills.php?delete_id=<?php print($row['bill_id']);?>&account_id=<?php print($Account_id);?>&category_id=<?php print($Category_id);?>&bill_total=<?php print($row['bill_total_amount']);?>">DELETE</a></td>
		
       </tr>
       <?php
   }
  }
  else
  {
   ?>
      <tr>
      <td><?php print("nothing here...");  ?></td>
      </tr>
      <?php
  }
  ?>
  </table>
            
            
            
    </div>
</div>
			
			

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    </body>
</html>
