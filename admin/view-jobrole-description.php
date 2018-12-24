<?php require_once '../core/init.php';
require_once '../functions/sanitize.php';

Login::isUservalid('admin');  

(!Input::exists('get')) ?  Redirect::to('./companies.php') : "";

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

.profile-head .nav-tabs{
margin-bottom:3%;
}
.profile-head .nav-tabs .nav-link{
font-weight:600;
border: none;
}
.profile-head .nav-tabs .nav-link.active{
border: none;
border-bottom:2px solid #6d7fcc;
}


.profile-work ul{
list-style: none;
}
.profile-tab label{
font-weight: 600;
}
.profile-tab p{
font-weight: 300;
color: inherit;
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
				<div class="row">
					<div class="col-md-12">
						<div class="profile-head">
							<div class="row">
								<div class="col-md-9">
								<h5><?php echo $jobRoleTitle; ?></h5>
								</div>
								<div class="col-md-3">

									<a class="btn-link" href="edit-jobrole.php?jobRoleId=<?php echo $jobRoleId;?>" class="btn-link">
									<i class="fa fa-edit"></i>
									</a>
									
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
								<br>
								<h6><?php echo $companyName; ?></h6>
								<br>
								</div>
							</div>
							
							<ul class="nav nav-tabs" id="myTab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Job Role Summay</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Timeline</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8">
						<div class="tab-content profile-tab" id="myTabContent">
							<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
								<div class="row">
									<div class="col-md-3">
										<label>Role Title</label>
									</div>
									<div class="col-md-9">
										<p><?php echo $jobRoleTitle; ?></p>
									</div>									
								</div>
								<div class="row">
									<div class="col-md-3">
										<label>Functional Area</label>
									</div>
									<div class="col-md-9">
										<p><?php echo $functionalareaName; ?></p>
									</div>									
								</div>
								<div class="row">
									<div class="col-md-3">
										<label>Location</label>
									</div>
									<div class="col-md-9">
										<p><?php echo $cityName; ?></p>
									</div>									
								</div>
								<div class="row">
									<div class="col-md-3">
										<label>Work Experience</label>
									</div>
									<div class="col-md-9">
										<p><?php echo $minWorkExperience;?> To <?php echo $maxWorkExperience;?></p>
									</div>									
								</div>
								<div class="row">
									<div class="col-md-3">
										<label>Fixed Salary</label>
									</div>
									<div class="col-md-9">
										<p><?php echo $minFixedSalary;?> To <?php echo $maxFixedSalary;?> </p>
									</div>									
								</div>
								
								<div class=" row">
									<div class="col-md-3">
										<label>Job Role Skills</label>
									</div>
									<div class="col-md-6">
										<?php foreach ($jobRoleSkills as $key => $skill) { 

											echo $skill['skillName'];
											echo ", ";

										 } ?>
									</div>
								</div>	

								
								
							</div>

							<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
								<div class="row">
									<div class="col-md-3">
										<label>Client brief note</label>
									</div>
									<div class="col-md-6">
										<p><?php echo $clientBriefNote; ?></p>
									</div>
								</div>						
								
							</div>
							
						</div>
					</div>
				</div>                   
			</div>
			<div class="card">
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
<?php require_once  '../include/footer.php'; ?>
</body>
</html>