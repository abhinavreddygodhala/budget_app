<?php 
    session_start();
    $username = $_SESSION['sess_username'];
    $role=$_SESSION['sess_userrole'];
    
    if(!isset($_SESSION['sess_username'])){
      header('Location: index.php?err=2');
    }
    if($role=='event_handler'){
?>
<?php
require_once 'events_crud.php';
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
						<li><a href="events.php">Home</a></li>
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
	<?php
	if(isset($_GET['action'])){
	if($_GET['action']=='create'){
  ?>
  <form method="post">   
  <table border="1" width="40%" cellpadding="15" class="table table-bordered">
  <tr>
  <td><input type="text" name="event_name" placeholder="Event Name" value="<?php if(isset($_GET['edit_id'])){ print($editRow['event_name']); } ?>" required></td>
  </tr>
  <tr>
  <td><input type="text" name="event_type" placeholder="Event Type"  value="<?php if(isset($_GET['edit_id'])){print($editRow['event_type']); } ?>" ></td>
  </tr>
  <tr>
  <td><input type="date" name="event_date" placeholder="Event Date" required="" value="<?php if(isset($_GET['edit_id'])){ print($editRow['event_date']); } ?>" ></td>
  </tr>
  <tr>
  <td>Event Start Time<input type="time"  pattern="[0-2]{1}[0-9]{1}:[0-5]{1}[0-9]{1}" name="event_start_time" placeholder="Event Start Time" required="" value="<?php if(isset($_GET['edit_id'])){ print($editRow['event_start_time']); } ?>" ></td>
  </tr>
  <tr>
  <td>Event End Time<input type="time" name="event_end_time"  pattern="[0-2]{1}[0-9]{1}:[0-5]{1}[0-9]{1}" placeholder="" required="" value="<?php if(isset($_GET['edit_id'])){ print($editRow['event_end_time']); } ?>" ></td>
  </tr>
  <tr>
  <td><input type="text" name="event_location" placeholder="event location" required="" value="<?php if(isset($_GET['edit_id'])){ print($editRow['event_location']); } ?>" ></td>
  </tr>
  <tr>
  <td><input type="number" name="event_entry_fee" placeholder="entry fee" required="" value="<?php if(isset($_GET['edit_id'])){ print($editRow['event_entry_fee']); } ?>" ></td>
  </tr>
  <tr>
  <td><input type="number" name="event_CEUs" placeholder="CEUs" required="" value="<?php if(isset($_GET['edit_id'])){ print($editRow['event_CEUs']); } ?>" ></td>
  </tr>
  <?php
  if(isset($_GET['edit_id'])){
	?>
  <td><button type="submit" name="update" class="btn btn-warning">update</button></td>
   <?php
  }else{?>
  <td><button type="submit" name="save" class="btn btn-success">save</button></td>
  <?php
  }  
  }
  }
  ?>  
 
  </tr>
  </table>
  </form>
 
  <br />
 
  <?php
 
  $stmt = $dbh->prepare("SELECT * FROM `view_events` ");
  $stmt->execute();
  ?>
  <table border="1" width="40%" class="table table-bordered">
	  
    <thead>
		<h3>Event Details</h3>
		<th><a href="events.php?action=create">Create Event</a></th>
		<tr class="success">
		<td>Event ID</td>
        <td>Event Name</td>
        <td>Event Type</td>
        <td>Event Date</td>
        <td>Event Start Time</td>
        <td>Event End Time</td>
        <td>Event Location</td>
        <td>Event Entry Fee</td>
        <td>Event CEUs</td>
        </tr>
    </thead>
  <?php
  if($stmt->rowCount() > 0)
  {
   while($row=$stmt->FETCH(PDO::FETCH_ASSOC))
   {
    ?>
		
       <tr class="active">
       <td><?php print($row['event_id']); ?></td>
       <td><a href="event_details.php?event_id=<?php print($row['event_id']); ?>"><?php print($row['event_name']); ?></a></td>
       <td><?php print($row['event_type']); ?></td>   
       <td><?php print($row['event_date']); ?></td>   
       <td><?php print($row['event_start_time']); ?></td>   
       <td><?php print($row['event_end_time']); ?></td>   
       <td><?php print($row['event_location']); ?></td>   
       <td><?php print($row['event_entry_fee']); ?></td>   
       <td><?php print($row['event_CEUs']); ?></td>   
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
