<?php require_once '../core/init.php';
require_once '../functions/sanitize.php';

Login::isUservalid('admin');  

(!Input::exists('post')) ?  Redirect::to('./companies.php') : "";

if (Input:: get('employeeId') ) {

	$employeeId = Input:: get('employeeId');

  	$jobrole = new Jobrole();
	$employeeData =  $jobrole->getRecruiter($employeeId);

	foreach ($employeeData as $key => $employee) { ?>

		<option value="<?php echo $employee['employeeId']; ?>" ><?php echo $employee['employeeName']; ?></option>

	<?php }  

}

?>
