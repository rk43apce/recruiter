<?php 
require_once '../core/init.php';
require_once '../functions/helper.php';
require_once '../functions/sanitize.php';
Login::auth('employeeId');
if (!Input::exists('get')) {

	Redirect::to('dashboard.php');
	exit();
}

if (empty(Input::get('candidateId')) ) {

	Redirect::to('dashboard.php');
	exit();
}

$candidate = new Candidate;

$assingmentData = null;

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
	
	
	/*
	  Get assignment details
	*/

	if (!empty(Input::get('assingmentId'))) {	

		$assingment =  new Assingment();
		
		$assingmentId = Input::get('assingmentId');
		
		if ($assingmentData = $assingment->getOnGoingAssingmentById($assingmentId)) {

			$companyId =  $assingmentData['companyId'];
			$assingmentId =  $assingmentData['assingmentId'];
			$jobRoleTitle =  $assingmentData['jobRoleTitle'];
			$companyName =  $assingmentData['companyName'];
			

		} 
	}    
	
	

} else {
	// setting error
	Session::put('errorMsg', 'Sorry no record found!');
}

?>
<!DOCTYPE html>
<html>
<head>
  <!-- Material Design Lite -->
  <script src="https://storage.googleapis.com/code.getmdl.io/1.0.0/material.min.js"></script>
  <link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.0/material.indigo-pink.min.css">

  <!-- Material Design icon font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
.actionButton {
	
	display: none;

}	
.interviewDescription{
	cursor: pointer
}	
.interviewDescription:hover .actionButton {
	
   display:inline-block;
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
				
				<?php if($assingmentData) { ?>


				<ol class="breadcrumb">          
					<li class="breadcrumb-item"><a class="btn-link" href="./dashboard.php">Assignment</a> </li> 
					<li class="breadcrumb-item">
					<?php echo $companyName ?>
					</li> 
					<li class="breadcrumb-item">
					<a class="btn-link" href="./view-assingment-description.php?assingmentId=<?php echo $assingmentId; ?>"><?php echo $jobRoleTitle ?></a>
					
					</li>      
				</ol>	


				<?php	} else { ?>

				<ol class="breadcrumb">
					<li class="breadcrumb-item "><a href="./candidates.php" class="btn-link">Canidates</a></li> 
					<li class="breadcrumb-item text-success">
					<?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>
					</li>                   
				</ol>

				<?php } ?>
				
			</div>
			<div class="card">
				
				<div class="row">
					<div class="col-md-12">
						<div class="profile-head">
							<div class="row">
								<div class="col-md-9">
								<h5><a class="btn-link" href="edit-candidate.php?candidateId=<?php echo $candidateId;?>">
										<?php echo $candidateFullName; ?>
									</a></h5>
								
								
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

								<li class="nav-item">
									<a class="nav-link" id="interview-tab" data-toggle="tab" href="#interview" role="tab" aria-controls="interview" aria-selected="false" onClick="loadInterview();"><i class="fa fa-calendar" aria-hidden="true"></i> &nbsp; Shedule an Interview </a> 
											
								</li>

								<li class="nav-item">
									<a class="nav-link" id="comments-tab" data-toggle="tab" href="#comments" role="tab" aria-controls="comments" aria-selected="false" onClick="loadComments();">
										<i class="fa fa-comments" aria-hidden="true"></i> &nbsp; Comments 
									</a>
								</li>
								
							</ul>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
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
								<br>
								<br>
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
							<div class="tab-pane fade" id="interview" role="tabpanel" aria-labelledby="interview-tab">
								<div class="row">
									<!-- Button trigger modal -->
									<div class="col-md-12">
									<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#sheduleInterviewModal" > <i class="fa fa-plus" aria-hidden="true"></i> &nbsp;
									Interview
									</button>
									</div>	
								</div>		
								<div class="line"></div>
								<div class="box-scheduled-interview">
									<div id="scheduleInterviews" class="">
										
									</div>	
								</div>
							</div>

							<div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments-tab">
								
								<div class="box-add-comment">								
									<div class="form-group">
									<label><i class="fa fa-comments" aria-hidden="true"></i> &nbsp; Add a comment</label>
									<textarea  id="comment" rows="3" class="form-control" placeholder="Write hee..." autofocus >
										
									</textarea>									
									</div>
									<div class="form-group">
									<input type="hidden" id="candidateId"  value="<?php echo $candidateId; ?>" >
									<button onClick="return addComment();" id="test" class="btn btn-primary">Submit Comment</button>
									</div>	
								</div>
								<div class="line"></div>
								<div class="box-view-comments">
									<div id="commentData"></div>
								</div>	
							</div>							
						</div>
					</div>
				</div>                   
			</div>
			
			</div>
	</div>
</div>
<?php require_once  '../include/footer.php'; ?>

<?php require_once  './interviewModal.php'; ?>

<script src="../js/comment.js"></script>
<script src="../js/interview.js"></script>

</body>
</html>