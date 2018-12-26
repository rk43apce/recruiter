<?php require_once '../core/init.php';
require_once '../functions/sanitize.php';

Login::isUservalid('admin');  

if (!Input::exists('post')) {

	Redirect::to('./companies.php');
}

if (!Token::check2('newJobRole', Input::get('token'))) {

	Redirect::to('./new-job-role.php?companyId='.'$companyId');	 	
} 

$jobRoleTitle =  Input::get('jobRoleTitle');
$companyId =  Input::get('companyId');		
$minWorkExperience =  Input::get('minWorkExperience');
$maxWorkExperience =  Input::get('maxWorkExperience');
$expInYearOrMonth =  Input::get('expInYearOrMonth');
$minFixedSalary =  Input::get('minFixedSalary');
$maxFixedSalary =  Input::get('maxFixedSalary');
$variableSalary =  Input::get('variableSalary');
$currencyId =  Input::get('currencyId');
$functionalAreaId =  Input::get('functionalAreaId');
$locationId =  Input::get('locationId');
$clientBriefNote =  Input::get('clientBriefNote');	
$jobRoleSkills =  Input::get('jobRoleSkills');	
$createdOn = date("Y/m/d"); 

$jobRoleData = array("jobRoleTitle"=>$jobRoleTitle, "companyId"=>$companyId, "jobRoleId"=>$jobRoleId, "minWorkExperience"=>$minWorkExperience, "maxWorkExperience"=>$maxWorkExperience, "minFixedSalary"=>$minFixedSalary, "maxFixedSalary"=>$maxFixedSalary, "variableSalary"=>$variableSalary, "currencyId"=>$currencyId, "functionalAreaId"=>$functionalAreaId, "clientBriefNote"=>$clientBriefNote);


$jobrole = new Jobrole();

$jobrole->jobRoleData = $jobRoleData;
$jobrole->jobRoleSkills = $jobRoleSkills;
$jobrole->jobRoleId = $jobRoleId;

if (!$jobrole->createNewJobRole()) {

	Session::put('errorMsg', 'Sorry! fail to create new assingment');
	Redirect::to('./new-job-role.php?companyId='.$companyId);

}


 Redirect::to('./upload-jd.php?jobRoleId='.$jobRoleId);
