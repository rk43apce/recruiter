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
$jobRoleId =  Input::get('jobRoleId');		
$minWorkExperience =  Input::get('minWorkExperience');
$maxWorkExperience =  Input::get('maxWorkExperience');
$minFixedSalary =  Input::get('minFixedSalary');
$maxFixedSalary =  Input::get('maxFixedSalary');
$variableSalary =  Input::get('variableSalary');
$functionalAreaId =  Input::get('functionalAreaId');
$locationId =  Input::get('locationId');
$clientBriefNote =  Input::get('clientBriefNote');	
$jobRoleSkills =  Input::get('jobRoleSkills');	
$createdOn = date("Y/m/d"); 

$jobRoleData = array("jobRoleTitle"=>$jobRoleTitle, "companyId"=>$companyId, "jobRoleId"=>$jobRoleId, "minWorkExperience"=>$minWorkExperience, "maxWorkExperience"=>$maxWorkExperience, "minFixedSalary"=>$minFixedSalary, "maxFixedSalary"=>$maxFixedSalary, "variableSalary"=>$variableSalary, "functionalAreaId"=>$functionalAreaId, "locationId"=>$locationId, "clientBriefNote"=>$clientBriefNote, "createdOn"=>$createdOn);


$jobrole = new Jobrole();

$jobrole->jobRoleData = $jobRoleData;
$jobrole->jobRoleSkills = $jobRoleSkills;
$jobrole->jobRoleId = $jobRoleId;

if (!$jobrole->createNewJobRole()) {

	Session::put('errorMsg', 'Sorry! fail to create new assingment');
	Redirect::to('./new-job-role.php?companyId='.$companyId);

}

Redirect::to('./company-jobroles.php?companyId='.$companyId);
