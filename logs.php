<?php 
    session_start();
    $role = $_SESSION['sess_username'];
    if(!isset($_SESSION['sess_username'])){
      header('Location: index.php?err=2');
    }
    
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
            <ul class="nav navbar-nav navbar-left">
				<li><li><a href="dean.php">Back</a></li>
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
 
  $stmt = $dbh->prepare("SELECT * FROM `view_logs` ");
  $stmt->execute();
  ?>
  <table border="1" width="40%" class="table table-bordered">
	  
    <thead>
		<h3>LOGS</h3>
		<tr class="success">
		<td>Log ID</td>
		<td>Bill ID</td>
        <td>Account Name</td>
        <td>Category Name</td>
        <td>Bill Description</td>
        <td>Bill Total</td>
        <td>Updated By</td>
        <td>Updated On</td>
        </tr>
    </thead>
  <?php
  if($stmt->rowCount() > 0)
  {
   while($row=$stmt->FETCH(PDO::FETCH_ASSOC))
   {
    ?>
		
       <tr class="active">
       <td><?php print($row['log_id']); ?></td>
       <td><?php print($row['bill_id']); ?></a></td>
       <td><?php print($row['account_name']); ?></td>
       <td><?php print($row['category_name']); ?></td>
       <td><?php print($row['bill_description']); ?></td>
       <td><?php print($row['bill_total_amount']); ?></td>
       <td><?php print($row['updated_by']); ?></td>
       <td><?php print($row['updated_on']); ?></td>
       
          
          
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
