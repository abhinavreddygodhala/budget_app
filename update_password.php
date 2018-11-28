
<?php 
    session_start();
    require 'database-config.php';
    $user_id=$_SESSION['sess_user_id'];
    $useremail = $_SESSION['sess_user_email'];
    $role=$_SESSION['sess_userrole'];
    if(!isset($_SESSION['sess_username'])){
      header('Location: index.php?err=2');
    }
    require_once 'updpsw_crud.php';
	
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
				<?php if($role=='dean'){
				   ?>
				<li><li><a href="dean.php">Back</a></li>
				<?php }?>
				<?php if($role=='secretary'){
				   ?>
				<li><li><a href="secretary.php">Back</a></li>
				<?php }?>
				<?php if($role=='event_handler'){
				   ?>
				<li><li><a href="events.php">Back</a></li>
				<?php }?>
			</ul>
     </div>
    </nav>
</div>

    <div class="container homepage">
      <div class="row">
			     
         
            
            
            
				
            <div id="bodyForm"><!-- Body Form Begin -->
			<div id="screenTitle"><h2>School Of Social Work</h2></div>
			<div id="screenTitle"><h3>Change Password</h3></div>
			<div id="screen"><!-- screen begin -->
			
			
			
			<div class="panel">
	 
  <head>
<title>Change Password</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<center>
<body>
<form name="frmChange" method="post" action="" onSubmit="return validatePassword()">
<div style="width:500px;">
<div class="message"><?php if(isset($message)) { echo $message; } ?></div>
<table table border="1" width="40%" class="table table-bordered">
<tr>
<td width="40%"><label>Current Password</label></td>
<td width="60%"><input type="password" name="currentPassword" class="txtField"/><span id="currentPassword"  class="required"></span></td>
</tr>
<tr>
<td><label>New Password</label></td>
<td><input type="password" name="newPassword" class="txtField"/><span id="newPassword" class="required"></span></td>
</tr>
<td><label>Confirm Password</label></td>
<td><input type="password" name="confirmPassword" class="txtField"/><span id="confirmPassword" class="required"></span></td>
</tr>
<tr>
<td colspan="2"><input type="submit" name="submit" value="Submit" class="btnSubmit"></td>
</tr>
</table>
</div>
</form>
</body></center>
 
</div>

                
                
               
			
			
				
            </div>
            
			
          
        
    </div>    
    			
			

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/password.js"></script>
    </body>
</html>
