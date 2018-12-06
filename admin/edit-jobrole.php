<?php require_once '../core/init.php';
require_once '../functions/sanitize.php';

Login::isUservalid('admin'); 

if (!Input::exists('get')) {

        Redirect::to('dashboard.php');
        die();
    }

    $jobrole = new Jobrole();   

if ($jobroleDaTa = $jobrole->getJobRoleByJobRoleId(escape(Input::get('jobRoleId')))) {

    $jobRoleId =  $jobroleDaTa['jobRoleId']; 
    $companyId =  $jobroleDaTa['companyId'];
    $jobRoleTitle =  $jobroleDaTa['jobRoleTitle'];
    $minWorkExperience =  $jobroleDaTa['minWorkExperience'];
    $maxWorkExperience =  $jobroleDaTa['maxWorkExperience'];
    $minFixedSalary =  $jobroleDaTa['minFixedSalary'];
    $maxFixedSalary =  $jobroleDaTa['maxFixedSalary'];
    $variableSalary =  $jobroleDaTa['variableSalary'];
    $functionalAreaId =  $jobroleDaTa['functionalAreaId'];
    $clientBriefNote =  $jobroleDaTa['clientBriefNote'];
    $functionalareaId =  $jobroleDaTa['functionalareaId'];
    $functionalareaName =  $jobroleDaTa['functionalareaName'];
    $companyCity =  $jobroleDaTa['companyCity'];
    $companyIndustryTypeId =  $jobroleDaTa['companyIndustryTypeId'];
    $cityName =  $jobroleDaTa['cityName'];
    $companyName =  $jobroleDaTa['companyName']; 
    $cityId =  $jobroleDaTa['cityId'];


    $jobfunctionalAreas = $jobrole->getFunctionalAreas();

    $cities = $jobrole->getCities();

    $skills = $jobrole->getSkills();  

    $currentJobroleSkills = $jobrole->getAssingmentSkillsByAssingmentId($jobRoleId);

    $arrayCurrentJobroleSkills = array();

       
    if ($currentJobroleSkills) {

        foreach ($currentJobroleSkills as $key => $jobroleSkills) {  

        array_push($arrayCurrentJobroleSkills, $jobroleSkills['skillId']);

        }
    }    

} else {
    Session::put("errorMsg", 'Sorry, No record found!');
} 

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.css"/>
<?php require_once  '../include/css.php'; ?>   
<style>
    
    .card label {
        text-align: right;
    }
</style> 
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar Holder -->
        <?php require_once  '../include/sidebar.php'; ?> 

        <!-- Page Content Holder -->
        <div id="content">
        <!-- Sidebar Holder -->
        <?php require_once  '../include/navbar-top.php'; ?>           

            <div class="container">
                
                <div class="card">    

                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="company-jobroles.php?companyId=<?php echo $companyId;?>" class="btn-link">
                            <?php echo $companyName; ?>                                
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                             <a href="view-jobrole-description.php?jobRoleId=<?php echo $jobRoleId; ?>" class="btn-link">
                                <?php echo $jobRoleTitle; ?>                           
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                              UpdateJob role Description   
                        </li>  
                        <li class="breadcrumb-item">
                              <?php echo (Session::exists('errorMsg'))? Session::flash('errorMsg') : ""; ?>
                        </li>                        
                    </ol>                                     
                        
                    <div class="line"></div>                  
                    <div class="card-body">
                     <form method="post" action="./update-jobrole.php">
                      <fieldset>         
                        <!--  -->
                        <div class="form-group row">
                            <label for="jobRoleId" class="col-sm-3 col-form-label">Role  Title</label>
                            <div class="col-sm-6">
                             <input type="text" class="form-control"  name="jobRoleTitle" value="<?php echo $jobRoleTitle ?>" required="">
                            </div>
                        </div>                        

                        <div class="form-group row">
                            <label for="jobRoleId" class="col-sm-3 col-form-label">Work Experience</label>
                            <div class="col-sm-2">
                            <input type="number" class="form-control"  name="minWorkExperience" value="<?php echo $minWorkExperience ?>" required="">
                            </div>
                            <label for="jobRoleId" class="col-form-label">To</label>
                            <div class="col-sm-2">
                            <input type="number" class="form-control"  id="maxWorkExperience" name="maxWorkExperience" value="<?php echo $maxWorkExperience ?>" required="">
                            </div>
                        </div>  

                        <div class="form-group row">
                            <label for="jobRoleId" class="col-sm-3 col-form-label">Fixed Salary</label>
                            <div class="col-sm-2">
                            <input type="number" class="form-control"  id="minFixedSalary" name="minFixedSalary" value="<?php echo $minFixedSalary ?>" required="">
                            </div>
                            <label for="jobRoleId" class="col-form-label">To</label>
                            <div class="col-sm-2">
                                 <input type="number" class="form-control"  id="maxFixedSalary" name="maxFixedSalary" value="<?php echo $maxFixedSalary ?>" required="">
                            </div>
                        </div>      
                        <div class="form-group row">
                            <label for="jobRoleId" class="col-sm-3 col-form-label">Variable Salary</label>
                            <div class="col-sm-2">
                             <input type="text" class="form-control" id="variableSalary" name="variableSalary" value="<?php echo $variableSalary ?>" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jobRoleId" class="col-sm-3 col-form-label">Functional Area</label>                    
                            <div class="col-sm-6">
                             <select class="ui fluid search dropdown"  required="" id="functionalAreaId" name="functionalAreaId" >
                                <option value=""> Choose functional area</option>

                                <?php foreach ($jobfunctionalAreas as $key => $area) { ?>

                                    <option value="<?php echo $area['functionalareaId']; ?>"

                                    <?php  echo ($functionalareaId == $area['functionalareaId'] ) ? "selected" : "";  ?>  
                                    >

                                    <?php echo  $area['functionalareaName']; ?>

                                    </option>

                                <?php } ?>
                        
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jobRoleId" class="col-sm-3 col-form-label">Location</label>
                            <div class="col-sm-6">
                             <select class="ui fluid search dropdown"  required="" id="locationId" name="locationId">
                                <option value=""> Choose Location </option>
                                <?php foreach ($cities as $key => $city) { ?>

                                    <option value="<?php echo   $city['cityId']; ?>" 

                                            <?php  echo ($cityId == $city['cityId'] ) ? "selected" : "";  ?>

                                        >

                                    <?php echo  $city['cityName']; ?>

                                    </option>

                                <?php }

                                ?>
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jobRoleId" class="col-sm-3 col-form-label">Key Skills (Multiple)</label>
                            <div class="col-sm-9">
                             <select class="ui fluid search dropdown" multiple=""  id="jobRoleSkills" name="jobRoleSkills[]" required="">
                                <option value=""> Choose Employee(multiple) </option>
                                <?php

                                foreach ($skills as $key => $skill) { ?>

                                    <option value="<?php echo   $skill['skillId']; ?>"                                       
                                         <?php echo    Skill::selectSkills($skill['skillId'], $arrayCurrentJobroleSkills)? "selected" : "" ?> 
                                    >

                                    <?php echo  $skill['skillName']; ?>

                                    </option>

                                <?php }

                                ?>
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jobRoleId" class="col-sm-3 col-form-label">Client brief note</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" rows="4"  id="clientBriefNote" name="clientBriefNote">
                                    <?php echo $clientBriefNote ?>
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jobRoleId" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-6">   
                                <input type="hidden" name="jobRoleId" value="<?php echo $jobRoleId; ?>">                         
                                <input type="hidden" name="token" value="<?php echo Token::generate2('updateJobRole'); ?>">  
                                <button type="submit" onclick=" return confirmFormSubmit()" class="btn btn-primary">Update JobRole</button>
                               <a href="company-jobroles.php?companyId=<?php echo $companyId;?>" class="btn-link">Cancel</a>
                            </div>
                        </div>  
                      
                      </fieldset>
                    </form>                  
                </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once  '../include/footer.php'; ?>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.js"></script>
        <script>
        $('.ui.dropdown')
        .dropdown();
    </script>

    <script type="text/javascript">   
        function confirmFormSubmit() {
        return confirm('Are you sure you want to save this thing into the database?');
        }
    </script> 

</body>

</html>