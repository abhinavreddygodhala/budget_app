<?php 
    session_start();
    $username = $_SESSION['sess_username'];
    $role=$_SESSION['sess_userrole'];
    $event_id= $_GET['event_id'];
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
select {
   
    width: 100%;
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
			<ul class="nav navbar-nav navbar-left">
				<li><a href="events.php">Back</a></li>
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
 
  $stmt = $dbh->prepare("SELECT * FROM `view_events` where event_id=:ei ");
  $stmt->execute(array(':ei'=> $_GET['event_id']));
  ?>
  <table border="1" width="40%" class="table table-bordered">
	  
    <thead>
		<h3>Event Details</h3>
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
       <td><?php print($row['event_name']); ?></td>
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
<div class="bs-example">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#sectionA">Overview</a></li>
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">Visitors<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a data-toggle="tab" href="#dropdown1">Add Visitors</a></li>
                <li><a data-toggle="tab" href="#dropdown2">View Visitors</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">Presenters<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a data-toggle="tab" href="#dropdown3">Add Presenter</a></li>
                <li><a data-toggle="tab" href="#dropdown4">View Presenters</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">Food<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a data-toggle="tab" href="#dropdown5">Add Food</a></li>
                <li><a data-toggle="tab" href="#dropdown6">View Orders</a></li>
            </ul>
        </li>
    </ul>
    <div class="tab-content">
        <div id="sectionA" class="tab-pane fade in active">
			<?php
		
		$stmt = $dbh->prepare("call event_overview(:ei)");
		$stmt->execute(array(':ei'=> $event_id));
		if($stmt->rowCount() > 0)
		{
		while($row=$stmt->FETCH(PDO::FETCH_ASSOC))
		{
		$final=$row['food_total']+$row['presenter_total']-$row['visitor_total'];
		if($final<0){
			$final=(-$final);
		}
		?>
		<table border="1" width="30%" class="table table-bordered">
		<tr>
		<th>Food Total Expense</th>
		
		<td align="center"><?php echo "$ ".$row['food_total']; ?></td>
		</tr>
		<tr>
		<th>Presenter Fee</th>
		<td align="center"><?php echo "$ ".$row['presenter_total']; ?></td>
		</tr>
		<tr>
		<th>Visitor Income</th>
		<td align="center"><?php echo "$ ".$row['visitor_total']; ?></td>
		</tr>
		<tr>
		<th>Final Bill</th>
		<td align="center"><?php echo "$ ".$final; ?></td>
		</tr>
		</table>
		<?php
		}
		}
		?>	
		
        </div>
        <div id="dropdown1" class="tab-pane fade">
            <h3>Add Visitor</h3>
            <form method="post">          
			<table border="1" width="40%" cellpadding="15" class="table table-bordered">
			<thead>
			<tr>
			<td><input type="text" name="visitor_name" placeholder="visitor name" required></td>
			</tr>
			<tr>
			<td><select name="visitor_type">
				<option value="full price">full price</option>
				<option value="alumni">alumni</option>
				<option value="5-workshop discount">5-workshop discount</option>
				<option value="free">free</option>
				</select></td>
			</tr>
			<tr>
			<td><input type="number" step="0.01" name="amount_paid"   placeholder="Amount Paid" required></td>
			</tr>
			<td><button type="submit" name="visitor" href="event_details.php?event_id=<?php echo $event_id;?>&form=visitor" class="btn btn-success">Save</button></td>
			</thead>
			</table>
            </form>
        </div>
        
        <div id="dropdown2" class="tab-pane fade">
		<?php
 
		$stmt = $dbh->prepare("call get_visitor(:ei)");
		$stmt->execute(array(':ei'=> $_GET['event_id']));
		
		?>
		<table border="1" width="40%" class="table table-bordered">
	  
		<thead>
			<h3>Visitors</h3>
			<tr class="success">
			<td>Visitor ID</td>
			<td>Visitor Name</td>
			<td>Visitor Type</td>
			<td>Amount Paid</td>
			</tr>
		</thead>
	<?php
	if($stmt->rowCount() > 0)
	{
	while($row=$stmt->FETCH(PDO::FETCH_ASSOC))
	{
	?>
		
       <tr class="active">
       <td><?php print($row['visitor_id']); ?></td>
       <td><?php print($row['visitor_name']); ?></td>
       <td><?php print($row['visitor_type']); ?></td>
       <td><?php print($row['amount_paid']); ?></td>
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
          <div id="dropdown3" class="tab-pane fade">
            <h3>Add Visitor</h3>
            <form method="post">          
			<table border="1" width="40%" cellpadding="15" class="table table-bordered">
			<thead>
			<tr>
			<td><input type="text" name="presenter_name" placeholder="presenter name" required></td>
			</tr>
			<tr>
			<td><input type="text"  name="presenter_degree"   placeholder="presenter degree" required></td>
			</tr>
			<tr>
			<td><input type="number" step="0.01" name="presenter_fee"   placeholder="presenter fee" required></td>
			</tr>
			<td><button type="submit" name="presenter" href="event_details.php?event_id=<?php echo $event_id;?>&form=presenter" class="btn btn-success">Save</td>
			</thead>
			</table>
            </form>
        </div>
        
        <div id="dropdown4" class="tab-pane fade">
		<?php
 
		$stmt = $dbh->prepare("call get_presenters(:ei)");
		$stmt->execute(array(':ei'=> $_GET['event_id']));
		?>
		<table border="1" width="40%" class="table table-bordered">
	  
		<thead>
			<h3>Presenter</h3>
			<tr class="success">
			<td>Presenter ID</td>
			<td>Presenter Name</td>
			<td>Presenter degrees</td>
			<td>Presenter Fee</td>
			</tr>
		</thead>
	<?php
	if($stmt->rowCount() > 0)
	{
	while($row=$stmt->FETCH(PDO::FETCH_ASSOC))
	{
	?>
		
       <tr class="active">
       <td><?php print($row['presenter_id']); ?></td>
       <td><?php print($row['presenter_name']); ?></td>
       <td><?php print($row['presenter_degrees']); ?></td>
       <td><?php print($row['presenter_fee']); ?></td>
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
    <div id="dropdown5" class="tab-pane fade">
	<?php
 
		$stmt = $dbh->prepare("SELECT * FROM `view_food` ");
		$stmt->execute();
		?>
		<form method="post">
		<table border="1" width="40%" class="table table-bordered">
	  
		<thead>
			<h3>Food Menu</h3>
			<tr class="success">
			<td>Food ID</td>
			<td>Food Name</td>
			<td>Food Discription</td>
			<td>Food Amount Per Quantity</td>
			<td>Food Max Serving</td>
			<td>Food Quantity</td>
			
			</tr>
		</thead>
	<?php
	if($stmt->rowCount() > 0)
	{
	while($row=$stmt->FETCH(PDO::FETCH_ASSOC))
	{
	?>
		
       <tr class="active">
       <td><?php print($row['food_id']); ?><input type="hidden" name="food_id[]" value="<?php print($row['food_id']); ?>"></td>
       <td><?php print($row['food_name']); ?></td>
       <td><?php print($row['food_description']); ?></td>
       <td><?php print($row['food_amount_per_quantity']); ?><input type="hidden" name="food_amount[]" value="<?php print($row['food_amount_per_quantity']); ?>"></td>
       <td><?php print($row['food_max_serving']); ?></td>
       <td><input type="number" name="quantity[]" > </td>
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
	<td><button type="submit" name="food" href="event_details.php?event_id=<?php echo $event_id;?>&form=presenter" class="btn btn-success">save</button></td>
  
	</form>
	</div>
        
        <div id="dropdown6" class="tab-pane fade">
		<?php
 
		$stmt = $dbh->prepare("SELECT * FROM food_ordered fo where fo.events_event_id= :ei ");
		$stmt->execute(array(':ei'=> $_GET['event_id']));
		?>
		<table border="1" width="40%" class="table table-bordered">
	  
		<thead>
			<h3>Food Ordered</h3>
			<tr class="success">
			<td>Food ID</td>
			<td>Food Name</td>
			<td>Food Description</td>
			<td>Quantity</td>
			<td>Total Amount</td>
			</tr>
		</thead>
	<?php
	if($stmt->rowCount() > 0)
	{
	while($row=$stmt->FETCH(PDO::FETCH_ASSOC))
	{
	?>
		
       <tr class="active">
       <td><?php print($row['food_id']); ?></td>
       <td><?php print($row['food_name']); ?></td>
       <td><?php print($row['food_description']); ?></td>
       <td><?php print($row['quantity']); ?></td>
       <td><?php print($row['total_amount']); ?></td>
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
</div>
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
