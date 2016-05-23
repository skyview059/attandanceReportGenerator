<?php 
require_once ( 'class.crud.php' );
$db = new CRUD();
$db->query( 'SELECT id,user_id,date,login,logout FROM `users_attendance` WHERE `date` BETWEEN "2016-05-16" AND "2016-05-22"');
$results = $db->resultList();

echo "<p><b>Found Rows: ".count($results) . "</b></p>";
//$days = array(1=>'Mon',2=>'Tue',3=>'Wed',4=>'Thu',5=>'Fri',6=>'Sat',7=>'Sun');

$days = array('Mon'=>'Mon','Tue'=>'Tue','Wed'=>'Wed','Thu'=>'Thu','Fri'=>'Fri','Sat'=>'Sat','Sun'=>'Sun');
$keys = array_fill_keys( array('Mon','Tue','Wed','Thu','Fri','Sat','Sun'), 'OFF') ;

$defined_array = [];
foreach($results as $row ){
	
											$day 	= date('D', strtotime( $row->date ));
	
	$defined_array[ $row->user_id ]['userID'] 		= $row->user_id;
	$defined_array[ $row->user_id ]['Date'] 		= $row->date;
	$defined_array[ $row->user_id ][$days[$day]] 	= $row->login;
	$defined_array[ $row->user_id ]['login'] 		= array_replace($keys, array_intersect_key($defined_array[$row->user_id], $keys));
	//$defined_array[ $row->user_id ]['kumro'] 		= 'Test';	
}

ksort( $defined_array  );
echo '<pre>';
print_r( $defined_array );
echo '</pre>';


?>

<table border="1" width="100%">
  <tr>
    <th>Team Member</th>
	<?php foreach($days as $day ){
		echo '<th width="120">'. $day .'</th>';
	}?>
  </tr>
 <?php foreach($defined_array  as $user){ ?>	
  <tr>
    <td><?php echo $user['userID']; ?></td>
    <?php foreach($days as $day ){ echo '<td>'. $user['login'][$day] .'</td>'; }?>
  </tr>
  <?php } ?> 
  
  
</table>




















