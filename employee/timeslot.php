<?php

$starttime = '9:00';  // your start time
$endtime = '21:00';  // End time
$duration = '30';  // split by 30 mins

$array_of_time = array ();
$start_time    = strtotime ($starttime); //change to strtotime
$end_time      = strtotime ($endtime); //change to strtotime

$add_mins  = $duration * 60;

while ($start_time <= $end_time) // loop between time
{
   $array_of_time[] = date ("h:iA ", $start_time);
   $start_time += $add_mins; // to check endtie=me
}


?>

<select>
<?php

foreach ($array_of_time as $k => $v) {
if ($k % 2 == 0) {
	
	?>
	
	<option value=""><?php echo $v; ?></option>
	<?php
}
else {
	$end[] = $v;
}
}?>

</select>

<select>
<?php

foreach ($array_of_time as $k => $v) {
if ($k % 2 == 1) {
	
	?>
	
	<option value=""><?php echo $v; ?></option>
	<?php
}
else {
	$end[] = $v;
}
}?>

</select>





	
