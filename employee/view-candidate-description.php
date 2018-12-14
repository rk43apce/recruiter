<?php 
require_once '../core/init.php';
require_once '../functions/helper.php';

if (Input::exists('get')) {	

	$candidateId = Input::get('candidateId');

	$candidate =  new Candidate();

	if ($candidateData =  $candidate->getCandidatebyID($candidateId)) {

	$candidateId = $candidateData['candidateId'];
	$assingmentId = $candidateData['assingmentId'];
	$candidateFullName = $candidateData['candidateFullName'];
	$candidateDOB = $candidateData['candidateDOB'];
	$candidateEmail = $candidateData['candidateEmail'];
	$candidateMobileNo = $candidateData['candidateMobileNo'];
	$candidateCity = $candidateData['candidateCity'];
	$candidateOrganisation = $candidateData['candidateOrganisation'];
	$candidateDesignation = $candidateData['candidateDesignation'];
	$functionalareaName = $candidateData['functionalareaName'];
	$candidateWorkExp = $candidateData['candidateWorkExp'];
	$candidateSalary = $candidateData['candidateSalary'];
	$candidateNoticePeriod = $candidateData['candidateNoticePeriod'];
	$candidateCreatedOn = $candidateData['candidateCreatedOn'];
	$candidateAddedOn = $candidateData['candidateAddedOn'];	

	} else {

		Session::put('errorMsg', 'Invalid request or No record found! ');
	} 
	
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
			<div class="container">
				<div class="card">    
					<ol class="breadcrumb">                  
						<li class="breadcrumb-item">Assignment</li>   
						<li class="breadcrumb-item active">
							Candidate profile
						</li>                   
					</ol>
					<div class="line"></div>
					<div class="card-body">					

								
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
							<label for="" class="col-sm-3">Full Name</label>
							<div class="col-sm-6">
								<?php echo $candidateDOB; ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="" class="col-sm-3">Email</label>
							<div class="col-sm-6">
							<?php echo $candidateDOB; ?>
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
							<?php echo $candidateSalary; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php require_once  '../include/footer.php'; ?>
</body>
</html>