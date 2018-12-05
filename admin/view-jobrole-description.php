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

    } else {

    	Session::put("errorMsg", 'Sorry, No record found!');
    }


    
?>

<!DOCTYPE html>
<html>
<head>
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
                             <a href="update-jobrole.php?jobRoleId=<?php echo $jobRoleId;?>" class="btn-link">
                                <?php echo $jobRoleTitle; ?> 
                             <i class="fa fa-edit"></i>
                        </a>
                        </li>
                        <li class="breadcrumb-item">
                             Job role Description   
                        </li>
                        
                    </ol>                                     
                        
                    <div class="line"></div>                  

                    <div class="form-group row">
                        <label for="jobRoleId" class="col-sm-3 col-form-label">Role  Title</label>                    
                        <div class="col-sm-6"><p><?php echo $jobRoleTitle;?></p> </div>
                    </div>
                     <div class="form-group row">                                
                        <label for="jobRoleId" class="col-sm-3 col-form-label">Variable Salary</label>                    
                        <div class="col-sm-6"><p><?php echo $jobRoleTitle;?></p> </div>
                    </div>
                     <div class="form-group row">                                
                        <label for="jobRoleId" class="col-sm-3 col-form-label">Work Experience</label>                    
                        <div class="col-sm-6"><p><?php echo $minWorkExperience;?> To <?php echo $maxWorkExperience;?> </p> </div>
                    </div>
                     <div class="form-group row">                                
                        <label for="jobRoleId" class="col-sm-3 col-form-label">Fixed Salary</label>                    
                      <div class="col-sm-6"><p><?php echo $minFixedSalary;?> To <?php echo $maxFixedSalary;?> </p> </div>
                    </div>
                     <div class="form-group row">                                
                        <label for="jobRoleId" class="col-sm-3 col-form-label">Functional Area</label>                    
                        <div class="col-sm-6"><p><?php echo $functionalareaName;?></p> </div>
                    </div>
                     <div class="form-group row">                                
                        <label for="jobRoleId" class="col-sm-3 col-form-label">Location</label>                    
                        <div class="col-sm-6"><p><?php echo $jobRoleTitle;?></p> </div>
                    </div>
                     <div class="form-group row">                                
                        <label for="jobRoleId" class="col-sm-3 col-form-label">Functional Area</label>                    
                        <div class="col-sm-6"><p><?php echo $cityName;?></p> </div>
                    </div>
                     <div class="form-group row">                                
                        <label for="jobRoleId" class="col-sm-3 col-form-label">Key Skills (Multiple)</label>                    
                        <div class="col-sm-6"><p><?php echo $jobRoleTitle;?></p> </div>
                    </div>
                     <div class="form-group row">                                
                        <label for="jobRoleId" class="col-sm-3 col-form-label">Client brief note</label>                    
                        <div class="col-sm-6"><p><?php echo $clientBriefNote;?></p> </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php require_once  '../include/footer.php'; ?>

</body>

</html>