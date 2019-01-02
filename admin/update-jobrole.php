<?php require_once '../core/init.php';
require_once '../functions/sanitize.php';

Login::isUservalid('admin');

if (Input::exists('post') != true) {

    Redirect::to('dashboard.php');
    die();  
} 

if (Token::check2('updateJobRole', Input::get('token')) != true)  {

    Redirect::to('edit-jobrole.php?jobRoleId='.Input::get('jobRoleId'));
    die();
} 

$jobRoleTitle =  escape(Input::get('jobRoleTitle')); 
$jobRoleId =  escape(Input::get('jobRoleId'));      
$minWorkExperience =  escape(Input::get('minWorkExperience'));
$maxWorkExperience =  escape(Input::get('maxWorkExperience'));
$minFixedSalary =  escape(Input::get('minFixedSalary'));
$maxFixedSalary =  escape(Input::get('maxFixedSalary'));
$variableSalary =  escape(Input::get('variableSalary'));
$functionalAreaId =  escape(Input::get('functionalAreaId'));

$clientBriefNote =  escape(Input::get('clientBriefNote'));  
$jobRoleSkills =  Input::get('jobRoleSkills');  // array of jobrole skills

$jobRoleDataToUpdate = array("jobRoleTitle"=>$jobRoleTitle, "minWorkExperience"=>$minWorkExperience, "maxWorkExperience"=>$maxWorkExperience, "minFixedSalary"=>$minFixedSalary, "maxFixedSalary"=>$maxFixedSalary, "variableSalary"=>$variableSalary, "functionalAreaId"=>$functionalAreaId, "clientBriefNote"=>$clientBriefNote);

$jobrole = new Jobrole();

if ($jobrole->updateJobRole($jobRoleId, $jobRoleDataToUpdate, $jobRoleSkills)) {
    
    Redirect::to('view-jobrole-description.php?jobRoleId='.$jobRoleId);
}else {

    Redirect::to('edit-jobrole.php?jobRoleId='.$jobRoleId);
}




