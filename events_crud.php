
<?php
 
require_once 'database-config.php';
 
if(isset($_POST['save']))
{
 
 $event_name = $_POST['event_name'];
 $event_type = $_POST['event_type'];
 $event_date= $_POST['event_date'];
 $event_start_time= $_POST['event_start_time'];
 $event_end_time= $_POST['event_end_time'];
 $event_location= $_POST['event_location'];
 $event_entry_fee= $_POST['event_entry_fee']; 
 $event_CEUs= $_POST['event_CEUs'];
 $school_id='SW';
	

 $stmt = $dbh->prepare("call create_event(:en,:et,:ed,:est,:eet,:el,:eef,:ec,:sc)");
 $stmt->execute(array(':en'=> $event_name, ':et'=> $event_type,':ed'=> $event_date,':est'=> $event_start_time,':eet'=> $event_end_time, ':el'=> $event_location, 'eef'=> $event_entry_fee, 'ec'=> $event_CEUs , 'sc'=> $school_id ));
 
 header("Location: events.php");
 
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
 

 

if(isset($_POST['visitor'])){
	
	
	$event_id=$_GET['event_id'];
	$visitor_name=$_POST['visitor_name'];
	$visitor_type=$_POST['visitor_type'];
	$amount_paid=$_POST['amount_paid'];
	
	
	$stmt = $dbh->prepare("call create_visitor(:vn,:vt,:ap,:ei)");
	$stmt->execute(array(':vn'=>$visitor_name,':vt'=>$visitor_type,':ap'=>$amount_paid,':ei' => $event_id));
	
	header("Location: event_details.php?event_id=".$event_id);
}
if(isset($_POST['presenter'])){
	
	
	$event_id=$_GET['event_id'];
	$presenter_name=$_POST['presenter_name'];
	$presenter_degree=$_POST['presenter_degree'];
	$presenter_fee=$_POST['presenter_fee'];
	
	
	$stmt = $dbh->prepare("call create_presenter(:vn,:vt,:ap,:ei)");
	$stmt->execute(array(':vn'=>$presenter_name,':vt'=>$presenter_degree,':ap'=>$presenter_fee,':ei' => $event_id));
	
	header("Location: event_details.php?event_id=".$event_id);
}
if(isset($_POST['food'])){
	$event_id=$_GET['event_id'];
	$food_id=$_POST['food_id'];
	$food_amount=$_POST['food_amount'];
	$food_quantity=$_POST['quantity'];
	for($i=0; $i<count($food_id);$i++){
		
	if($food_id[$i]!="" && $food_amount[$i]!="" && $food_quantity!=""){
	$amount=$food_amount[$i]*$food_quantity[$i];
	$stmt = $dbh->prepare("call insert_food(:ei,:fi,:fq,:ta)");
	$stmt->execute(array(':ei'=>$event_id,':fi'=> $food_id[$i] ,':fq'=>$food_quantity[$i],':ta' =>$amount));
	}
	}
	header("Location: event_details.php?event_id=".$event_id);
}
?>
