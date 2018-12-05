<?php require_once '../core/init.php';
require_once '../functions/sanitize.php';

Login::isUservalid('admin');  

(!Input::exists('get')) ?  Redirect::to('./companies.php') : "";

	# code...
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

    } else {

    	Session::put("errorMsg", 'Sorry, No record found!');
    }


    $jobfunctionalAreas = $jobrole->getFunctionalAreas();
    $skills = $jobrole->getSkills();
    $cities = $jobrole->getCities();


    
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.css"/>
<?php require_once  '../include/css.php'; ?>   
<style>
        .card {
            max-width: 786px;
            margin-left: auto;
            margin-right: auto;
        }
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
                            <?php echo $companyName; ?></a>
                        </li>
                        <li class="breadcrumb-item">
                             <a href="update-employee-profile.php?employeeId=9" class="btn-link">
                                <?php echo $jobRoleTitle; ?> 
                             <i class="fa fa-edit"></i>
                        </a>
                        </li>
                        <li class="breadcrumb-item">
                             Job role Description   
                        </li>
                        
                    </ol>                                     
                        
                    <div class="line"></div>                  

                     <form method="post" action="./add-JobRole.php">
                      <fieldset>
                        <!-- Compulsory field setting unique id for every new jobRole -->
                        <input type="hidden" name="jobRoleId" id="jobRoleId" value="">
                        <!--  -->
                        <div class="form-group row">
                            <label for="jobRoleId" class="col-sm-3 col-form-label">Role  Title</label>
                            <div class="col-sm-6">
                             <input type="text" class="form-control"  name="jobRoleTitle" value="<?php echo $jobRoleTitle ?>" required="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jobRoleId" class="col-sm-3 col-form-label">Variable Salary</label>
                            <div class="col-sm-6">
                             <input type="text" class="form-control" id="variableSalary" name="variableSalary" value="<?php echo $variableSalary ?>" required="">
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
                            <label for="jobRoleId" class="col-sm-3 col-form-label">Functional Area</label>

                    
                            <div class="col-sm-6">
                             <select class="ui fluid search dropdown"  required="" id="functionalAreaId" name="functionalAreaId" >
                                <option value=""> Choose functional area</option>

                                <?php

                                foreach ($jobfunctionalAreas as $key => $area) { ?>

                                    <option value="<?php echo $area['functionalareaId']; ?>"

                                    <?php  echo ($functionalareaId == $area['functionalareaId'] ) ? "selected" : "";  ?>  
                                    >

                                    <?php echo  $area['functionalareaName']; ?>

                                    </option>

                                <?php }

                                ?>
                        
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jobRoleId" class="col-sm-3 col-form-label">Location</label>
                            <div class="col-sm-6">
                             <select class="ui fluid search dropdown"  required="" id="locationId" name="locationId">
                                <option value=""> Choose Location </option>
                                <?php

                                foreach ($cities as $key => $city) { ?>

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
                            <div class="col-sm-6">
                             <select class="ui fluid search dropdown" multiple=""  id="jobRoleSkills" name="jobRoleSkills[]">
                                <option value=""> Choose Employee(multiple) </option>
                                <?php

                                foreach ($skills as $key => $skill) { ?>

                                    <option value="<?php echo   $skill['skillId']; ?>" >

                                    <?php echo  $skill['skillName']; ?>

                                    </option>

                                <?php }

                                ?>
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jobRoleId" class="col-sm-3 col-form-label">Client brief note</label>
                            <div class="col-sm-6">
                            <textarea class="form-control" rows="3"  id="clientBriefNote" name="clientBriefNote">
                                <?php echo $clientBriefNote ?>
                            </textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jobRoleId" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-6">
                                <input type="hidden" name="companyId" value="<?php echo escape(Input::get('companyId')); ?>"> 
                                <input type="hidden" name="token" value="<?php echo Token::generate2('newJobRole'); ?>">  
                                <button type="submit" onclick=" return confirmFormSubmit()" class="btn btn-primary">Save JobRole</button>
                                <a class="btn btn-link" href="company-jobroles.php?companyId=<?php echo escape(Input::get('companyId')); ?>">Cancel</a>
                            </div>
                        </div>
                            
                            
                      
                      </fieldset>
                    </form>                  

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