<?php require_once '../core/init.php';
require_once '../functions/sanitize.php';

Login::isUservalid('admin');  

(!Input::exists('post')) ?  Redirect::to('./companies.php') : "";

if (Input:: get('id') ) {

	$companyId = Input:: get('id');

  	$jobrole = new Jobrole();
	$jobrolesData =  $jobrole->getJobRoleByCompanyId($companyId);

	foreach ($jobrolesData as $key => $Jobrole) { ?>

		<option value="<?php echo $Jobrole['jobRoleId']; ?>" ><?php echo $Jobrole['jobRoleTitle']; ?></option>

	<?php }  

}

?>
