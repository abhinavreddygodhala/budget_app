<?php 
	session_start();
    $username= $_SESSION['sess_username'];
    $role=$_SESSION['sess_userrole'];
    if(!isset($_SESSION['sess_username'])){
      header('Location: index.php?err=2');
    }
    if(isset($_GET['account_id'])){
		$Account_id=$_GET['account_id'];
		
	}
	if($role=='dean'){
	?>	
   

<?php
require_once 'categories_crud.php';
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
            <ul class="nav navbar-nav navbar-left">
			<li><a href="dean.php">Back</a></li>
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
	   if($_GET['action']=='update')
	   {
	   ?><div class="alert alert-warning fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Updated!!</strong> 
    successfully.
    </div>
<?php
}
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
  if(isset($_GET['save']))
  {
	 
  ?>
  <form method="post">   
  <table border="1" width="40%" cellpadding="15" class="table table-bordered">
  <tr>
  <td><input type="number" name="acc_id" placeholder="Category ID" value="<?php print($Account_id); ?>" required></td>
  </tr>
  <tr>
  <td><input type="number" name="cat_id" placeholder="Category ID"  required></td>
  </tr>
  <tr>
  <td><input type="text" name="cat_name" placeholder="Account Name" required></td>
  </tr>
  <tr>
  <td><input type="number"  step="0.01" name="cat_funds_total" placeholder="Account Funds Budgeted" required></td>
  </tr>
   <td><button type="submit" name="save" class="btn btn-success">save</button></td>
  
  <?php
	}
	if(isset($_GET['edit_id'])){
  ?>
  <form method="post">   
  <table border="1" width="40%" cellpadding="15" class="table table-bordered">
  <tr>
  <td><?php print "Account ID: $Account_id"; ?><input type="hidden" name="acc_id" placeholder="account id" value="<?php print($Account_id); ?>" required></td>
  </tr>
  <tr>
  <td><?php if(isset($_GET['edit_id'])){ print($editRow['Categories_id']); } ?><input type="hidden" name="cat_id" placeholder="Category ID" required="" value="<?php if(isset($_GET['edit_id'])){ print($editRow['Categories_id']); } ?>" ></td>
  </tr>
  <tr>
  <td><?php if(isset($_GET['edit_id'])){ print($editRow['Categorie_name']); } ?><input type="hidden" name="cat_name" placeholder="category Name" required="" value="<?php if(isset($_GET['edit_id'])){ print($editRow['Categorie_name']); } ?>" ></td>
  </tr>
  <tr>
  <td><input type="number" step="0.01" name="cat_funds_total" placeholder="Funds Budgeted" required="" value="<?php if(isset($_GET['edit_id'])){ print($editRow['funds_total']); } ?>" /></td>
  </tr>
   <td><button type="submit" name="update" class="btn btn-warning">update</button></td>
  
      <?php
  }
  

  
	  
  
  
  
  ?>
  </td>
  </tr>
  </table>
  </form>
 
  <br />
  
 
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
		<h3><?php echo $row['Account_id'].'-'.$row['Account_name'].'-'.$row['semester_year']; ?></h3>
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
 
  $stmt = $dbh->prepare("SELECT * FROM `accounts_categories` where Account_id= :id ");
  $stmt->execute(array( ':id'=> $Account_id ));
  ?>
  <table border="1" width="40%" class="table table-bordered">
    <thead>
		
		<h4>Categories</h4>
		<th><a href="categories.php?save=create&account_id=<?php echo $Account_id ?>">Create Category</a></th>
		<th><a href="export_excel.php?table=categories&account_id=<?php echo $Account_id ?>">Export Excel</a></th>
		<tr class="success">
		<td>ID</td>
        <td>Category Name</td>
        <td>Funds Budgeted</td>
        <td>Funds Spent</td>
        <td>Available Funds</td>
        <td>Update</td>
        <td>Delete</td>
      </tr>
    </thead>
    <?php
		if($stmt->rowCount() > 0)
		{
		while($row=$stmt->FETCH(PDO::FETCH_ASSOC))
		{ ?>
	   <tr class="active">
       <td><?php print($row['Account_Fund_Type'].'-'.$row['Account_id'].'-'.$row['Categories_id']); ?></td>
       <td><a  href="bills.php?save=create&category_id=<?php print($row['Categories_id']); ?>&account_id=<?php print($row['Account_id']); ?>"><?php print($row['Categorie_name']); ?></a></td>
       <td><?php print($row['funds_total']); ?></td>
       <td><?php print($row['funds_spent']); ?></td>
       <td><?php print($row['funds_available']); ?></td>
       
       <td><a onclick="return confirm('Sure to Edit ? ')" href="categories.php?account_id=<?php print($row['Account_id']);  ?>&edit_id=<?php print($row['Account_id']);  ?>&cat_id=<?php print($row['Categories_id']);?>">EDIT</a></td>
       <td><a onclick="return confirm('Sure to Delete ? ')" href="categories.php?delete_id=<?php print($row['Account_id']);?>&category_id=<?php print($row['Categories_id']);?>">DELETE</a></td>
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
    			
			

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    </body>
</html>
<?php
}
else{
	header('Location: index.php?err=2');
}
?>
