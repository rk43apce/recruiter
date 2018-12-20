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
			<?php require_once  '../include/navbar-top-employee.php'; ?> 
			<?php Data::checkData($candidateData); ?>

			<div class="container">
				<div class="card">    
					<ol class="breadcrumb">                  
						<li class="breadcrumb-item"><a href="./candidates.php" class="btn-link">Candidates</a> </li>   
						<li class="breadcrumb-item active">
							Candidate profile
						</li>
						<li class="breadcrumb-item">
							<a href="edit-candidate.php?candidateId=<?php echo $candidateId; ?>" class="btn-link">Edit Profile</a>
						</li>  
							<li class="breadcrumb-item"><a href="upload-resume.php?candidateId=<?php echo $candidateId;?>" class="btn-link"> Update Resume</a></li>    
						<li class="breadcrumb-item text-success">
						<?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>
						</li>                 
					</ol>
					<div class="line"></div>
					<div class="card-body">					

						<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label"></label>
								<div class="col-sm-6">
									<p>Personal Details</p>
								</div>
							</div>		
						<div class="form-group row">
							<label for="" class="col-sm-3">Full Name</label>
							<div class="col-sm-6">
							  <?php echo $candidateFullName; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-3">DOB</label>
							<div class="col-sm-6">
							  <?php echo $candidateDOB; ?>
							</div>
						</div>						
						<div class="form-group row">
							<label for="" class="col-sm-3">Email</label>
							<div class="col-sm-6">
							<?php echo $candidateEmail; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-3">Mobile No</label>
							<div class="col-sm-6">
							<?php echo $candidateMobileNo; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-3">Current City</label>
							<div class="col-sm-6">
							<?php echo $candidateCity; ?>
							</div>
						</div>
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label"></label>
								<div class="col-sm-6">
								<p>Work  Experience</p>
								</div>
							</div>		
						<div class="form-group row">
							<label for="" class="col-sm-3">Current Organisation</label>
							<div class="col-sm-6">
							<?php echo $candidateOrganisation; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-3">Designation</label>
							<div class="col-sm-6">
							<?php echo $candidateDesignation; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-3">Functional Area</label>
							<div class="col-sm-6">
							<?php echo $functionalareaName; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-3">Work Experience</label>
							<div class="col-sm-6">
							<?php echo $candidateWorkExp; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-3">Salary</label>
							<div class="col-sm-6">
							<?php echo $candidateSalary; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-3">Notice Period</label>
							<div class="col-sm-6">
							<?php echo $candidateNoticePeriod; ?>
							</div>
						</div>

						<div class="form-group row">
							<label for="" class="col-sm-3 col-form-label"></label>
							<div class="col-sm-6">
								<p>Qualification Details</p>
							</div>
						</div>		

						<?php foreach ($candidateEducationData as $key => $qulication) { ?>

							<div class="form-group row">
								<label for="" class="col-sm-3"><?php echo	$qulication['degreeLevel']; ?></label>
								<div class="col-sm-6">
								<?php echo $qulication['degreeName']; ?>
								</div>
							</div>		

						<?php } ?>	
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<?php require_once  '../include/footer.php'; ?>
</body>
</html>