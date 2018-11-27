<?php 
    session_start();
    $username = $_SESSION['sess_username'];
    $role=$_SESSION['sess_userrole'];
    
    if(!isset($_SESSION['sess_username'])){
      header('Location: index.php?err=2');
    }
    if($role=='secretary'){
?>
<?php
require_once 'accounts_crud.php';
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
            </div>
			<div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
				<a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo $username ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
						<li><a href="secretary.php">Home</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</li>
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
	
 
  <br />
 
  <?php
 
  $stmt = $dbh->prepare("SELECT * FROM `view_accounts` ");
  $stmt->execute();
  ?>
  <table border="1" width="40%" class="table table-bordered">
	  
    <thead>
		<h3>Account Details </h3>
		<th><a href="export_excel.php?table=accounts">Export Excel</a></th>
		<tr class="success">
		<td>Account ID</td>
        <td>Account Name</td>
        <td>Account Fund Type</td>
        <td>Account Funds Budgeted</td>
        <td>Account Funds Spent</td>
        <td>Account Available Funds</td>
        <td>Semester Year</td>
        </tr>
    </thead>
  <?php
  if($stmt->rowCount() > 0)
  {
   while($row=$stmt->FETCH(PDO::FETCH_ASSOC))
   {
    ?>
		
       <tr class="active">
       <td><?php print($row['Account_id']); ?></td>
       <td><a href="secretary_cat.php?account_id=<?php print($row['Account_id']); ?>&semester=<?php print($row['semester_year']); ?>"><?php print($row['Account_name']); ?></a></td>
       <td><?php print($row['Account_Fund_Type']); ?></td>
       <td><?php print($row['Account_funds_budgeted']); ?></td>
       <td><?php print($row['Account_funds_spent']); ?></td>
       <td><?php print($row['Account_available_funds']); ?></td>
       <td><?php print($row['semester_year']); ?></td>
       
          
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
