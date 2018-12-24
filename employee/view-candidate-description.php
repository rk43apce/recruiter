<?php 
require_once '../core/init.php';
require_once '../functions/helper.php';
require_once '../functions/sanitize.php';

if (!Input::exists('get')) {

	Redirect::to('dashboard.php');
	exit();
}

if (empty(Input::get('candidateId')) ) {

	Redirect::to('dashboard.php');
	exit();
}

$candidate = new Candidate;

if ($candidateData = $candidate->getCandidatebyId(escape(Input::get('candidateId')))) {
		
	$candidateId = $candidateData['candidateId'];		
	$candidateFullName = $candidateData['candidateFullName'];
	$candidateDOB = $candidateData['candidateDOB'];
	$candidateEmail = $candidateData['candidateEmail'];
	$candidateMobileNo = $candidateData['candidateMobileNo'];
	$candidateCity = $candidateData['candidateCity'];
	
	// getting candidate education data
	$candidateEducationData = $candidate->getEducation($candidateId);
	// getting candidate workExperiece data
	$candidateWorkExpData = $candidate->getWorkExperience($candidateId);
	
	$candidateOrganisation = $candidateWorkExpData['candidateOrganisation'];
	$candidateDesignation = $candidateWorkExpData['candidateDesignation'];
	$functionalareaName = $candidateWorkExpData['functionalareaName'];
	$candidateSalary = $candidateWorkExpData['candidateSalary'];
	$candidateNoticePeriod = $candidateWorkExpData['candidateNoticePeriod'];
	$candidateWorkExp = $candidateWorkExpData['candidateWorkExp'];
	
	$resumeData = $candidate->getResume($candidateId);
	
	$resumeId = $resumeData['resumeId'];
	

} else {
	// setting error
	Session::put('errorMsg', 'Sorry no record found!');
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
		<?php require_once  '../include/navbar-top-employee.php'; ?> 
		<?php Data::checkData($candidateData); ?>
		<div class="container">
			<div class="card">
				<div class="row">
					<div class="col-md-12">
						<div class="profile-head">
							<div class="row">
								<div class="col-md-9">
								<h5><?php echo $candidateFullName; ?></h5>
								</div>
								<div class="col-md-3">
									<a class="btn-link" href="edit-candidate.php?candidateId=<?php echo $candidateId;?>">
										Edit profile
									</a>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
								<br>
								<h6><?php echo $candidateOrganisation; ?>, <?php echo $candidateDesignation; ?></h6>
								<br>
								</div>
							</div>
							
							<ul class="nav nav-tabs" id="myTab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
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
										<label>Name</label>
									</div>
									<div class="col-md-6">
										<p><?php echo $candidateFullName; ?></p>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<label>Email</label>
									</div>
									<div class="col-md-6">
									   <p><?php echo $candidateEmail; ?></p>
									</div>
								</div>
								<div class="row">
									 <div class="col-md-3">
										<label>Phone</label>
									</div>
									<div class="col-md-6">
									   <p><?php echo $candidateMobileNo; ?></p>   
									</div>
								</div>
								<div class="row">
									 <div class="col-md-3">
										<label>Designation</label>
									</div>
									<div class="col-md-6">
										<p><?php echo $candidateDesignation; ?></p> 
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
								<div class="row">
									<div class="col-md-12">
										<h6>Qualification Details</h6>
										<br>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<label>Organisation</label>
									</div>
									<div class="col-md-6">
										<p><?php echo $candidateOrganisation; ?></p> 
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<label>Designation</label>
									</div>
									<div class="col-md-6">
										<p><?php echo $candidateDesignation; ?></p> 
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<label>Functional Area</label>
									</div>
									<div class="col-md-6">
										<p><?php echo $functionalareaName; ?></p> 
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<label>Experience</label>
									</div>
									<div class="col-md-6">
										<p><?php echo $candidateWorkExp; ?> yrs</p> 
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<label>Salary</label>
									</div>
									<div class="col-md-6">
										<p><?php echo $candidateSalary; ?> LPS</p> 
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<label>Notice Period</label>
									</div>
									<div class="col-md-6">
										<p><?php echo $candidateNoticePeriod; ?> Days</p> 
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<br>
										<h6>Qualification Details</h6>
										<br>
									</div>
								</div>
								<?php foreach ($candidateEducationData as $key => $qulication) { ?>
								<div class=" row">
									<div class="col-md-3">
										<label><?php echo	$qulication['degreeLevel']; ?></label>
									</div>
									<div class="col-md-6">
										<?php echo $qulication['degreeName']; ?>
									</div>
								</div>	
								<?php } ?>
							</div>
						</div>
					</div>
				</div>                   
			</div>
			<div class="card">
					<div class="card-body">
						<?php						
						if($resumeId) {
							?>							
							<object style="width: 100%; min-height: 886px;" data="../upload/<?php echo $resumeId;?>.pdf"></object>
							<?php
						} else {
							?>
							
							<a href="upload-resume.php?candidateId=<?php echo $candidateId; ?>" class="btn btn-link">Upload resume</a>
							
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