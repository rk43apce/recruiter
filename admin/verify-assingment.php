<?php 
require_once '../core/init.php';
require_once '../functions/helper.php';
$assingment =  new Assingment();

if(isset($_POST)) {

$companyId = $_POST['companyId'];
$jobRoleId = $_POST['jobRoleId'];
$jobCity = $_POST['jobCity'];

if(!$assingment->checkAssingment($companyId,$jobRoleId,$jobCity)){
	echo 'exists';
}else {
	echo 'notexists';
}

}
?>