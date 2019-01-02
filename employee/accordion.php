<?php require_once '../core/init.php';
require_once '../functions/sanitize.php';

(!Input::exists('get')) ?  Redirect::to('./dashboard.php') : "";

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
       $companyName =  $jobroleDaTa['companyName'];   


    $jdData = $jobrole->getJD($jobRoleId);

    $jdTrackerId = $jdData['jdTrackerId'];

    $jobRoleSkills = $jobrole->getJobRoleSkills($jobRoleId);

    } else {

      Session::put("errorMsg", 'Sorry, No record found!');
    }    
?>


<!DOCTYPE html>
<html>
<head>
    <?php require_once  '../include/css.php'; ?>    

    <style type="text/css">
      .mb-0 > a {
  display: block;
  position: relative;
}
.mb-0 > a:after {
  content: "\f078"; /* fa-chevron-down */
  font-family: 'FontAwesome';
  position: absolute;
  right: 0;
}
.mb-0 > a[aria-expanded="true"]:after {
  content: "\f077"; /* fa-chevron-up */
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
    <?php require_once  '../include/navbar-top-employee.php'; ?> 
    
    <div class="container">
    <div id="accordion">
  <div class="card">
    <div class="card-header" id="heading-1">
      <h5 class="mb-0">
        <a role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
          Item 1
        </a>
      </h5>
    </div>
    <div id="collapse-1" class="collapse show" data-parent="#accordion" aria-labelledby="heading-1">
      <div class="card-body">

        <div id="accordion-1">
          <div class="card">
            <div class="card-header" id="heading-1-1">
              <h5 class="mb-0">
                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-1-1" aria-expanded="false" aria-controls="collapse-1-1">
                  Item 1 > 1
                </a>
              </h5>
            </div>
           
          </div>
          <div class="card">
            <div class="card-header" id="heading-1-2">
              <h5 class="mb-0">
                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-1-2" aria-expanded="false" aria-controls="collapse-1-2">
                  Item 1 > 2
                </a>
              </h5>
            </div>
            <div id="collapse-1-2" class="collapse" data-parent="#accordion-1" aria-labelledby="heading-1-2">
              <div class="card-body">
                <?php           
            if($jdTrackerId) {
              ?>              
              <object style="width: 100%; min-height: 886px;" data="../upload/jd/<?php echo $jdTrackerId;?>.pdf"></object>
              <?php
            } else {
              ?>
              
              <a href="upload-jd.php?jobRoleId=<?php echo $jobRoleId; ?>" class="btn btn-link">Upload resume</a>
              
              <?php
            }           
            ?>
              </div>
            </div>
          </div>
        </div>      
      
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="heading-2">
      <h5 class="mb-0">
        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
          Item 2
        </a>
      </h5>
    </div>
    <div id="collapse-2" class="collapse" data-parent="#accordion" aria-labelledby="heading-2">
      <div class="card-body">
        Text 2
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="heading-3">
      <h5 class="mb-0">
        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
          Item 3
        </a>
      </h5>
    </div>
    <div id="collapse-3" class="collapse" data-parent="#accordion" aria-labelledby="heading-3">
      <div class="card-body">
        <h1>hhh</h1>
      </div>
    </div>
  </div>

    </div>
  </div>
</div>

<?php require_once  '../include/footer.php'; ?>


</body>

</html>