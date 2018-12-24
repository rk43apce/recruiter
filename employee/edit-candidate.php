<?php 
require_once '../core/init.php';
require_once '../functions/helper.php';
require_once '../functions/sanitize.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!Input::exists('get')) {

	Redirect::to('dashboard.php');
	exit();
}

if (empty(Input::get('candidateId')) ) {

	Redirect::to('dashboard.php');
	exit();
}


$candidate = new Candidate();

	
if ($candidateData = $candidate->getCandidatebyId(escape(Input::get('candidateId')))) {

	// candidate profile data
	$candidateId = $candidateData['candidateId'];
	$candidateFullName = $candidateData['candidateFullName'];
	$candidateDOB = $candidateData['candidateDOB'];
	$candidateEmail = $candidateData['candidateEmail'];
	$candidateMobileNo = $candidateData['candidateMobileNo'];
	$candidateCity = $candidateData['candidateCity'];
	
	// getting candidate workExperiece data
	$candidateWorkExpData = $candidate->getWorkExperience($candidateId);
	$candidateOrganisation = $candidateWorkExpData['candidateOrganisation'];
	$candidateDesignation = $candidateWorkExpData['candidateDesignation'];
	$functionalareaName = $candidateWorkExpData['functionalareaName'];
	$candidateSalary = $candidateWorkExpData['candidateSalary'];
	$candidateNoticePeriod = $candidateWorkExpData['candidateNoticePeriod'];
	$candidateWorkExp = $candidateWorkExpData['candidateWorkExp'];
	$candidateFunctionalAreaId = $candidateWorkExpData['candidateFunctionalAreaId'];

	// getting student education data and creating array of education qualification	

	$candidateEducationData =  ArrayPush::makeArray($candidate->getEducation($candidateId));	
	
} else {

	Session::put('errorMsg', ' No record found Or Invalid request');
} 
?>

<!DOCTYPE html>
<html>
<head>
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
			<?php require_once  '../include/navbar-top-employee.php'; ?>
					<?php Data::checkData($candidateData); ?>						 
			 <div class="container">
				<div class="card">   
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a class="btn-link" href="candidates.php">Candidates</a></li>  
						<li class="breadcrumb-item ">
							<a class="btn-link" href="view-candidate-description.php?candidateId=<?php echo $candidateId; ?>">
							<?php echo $candidateFullName; ?>
							</a>						
						</li>                               
						<li class="breadcrumb-item active">Update Profile</li>  
					   
					</ol>	
					<div class="line"></div>
					<div class="card-body">					
	                    <form method="post" action="./update-candidate-profile.php">
						  <fieldset>	
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label"></label>
								<div class="col-sm-6">
								<p>Personal Details</p>
								</div>
							</div>			
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Full Name</label>
								<div class="col-sm-6">
								  <input type="text" class="form-control"  name="candidateFullName" value="<?php echo $candidateFullName; ?>" required="" autofocus>
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">DOB</label>
								<div class="col-sm-3">
								<input type="date" class="form-control" name="candidateDOB" value="<?php echo $candidateDOB; ?>" required="">
								</div>
							</div>								
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Email</label>
								<div class="col-sm-6">
									<input type="email" class="form-control"  name="candidateEmail" value="<?php echo $candidateEmail; ?>" required="">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Mobile No</label>
								<div class="col-sm-3">
								  <input type="number" class="form-control"  name="candidateMobileNo" value="<?php echo $candidateMobileNo; ?>" required="">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Current City</label>
								<div class="col-sm-3">								  
									<input type="text" class="form-control"  name="candidateCity" value="<?php echo $candidateCity; ?>" required="">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label"></label>
								<div class="col-sm-6">
								<p>Work History</p>
								</div>
							</div>	
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Current Organisation</label>
								<div class="col-sm-6">
								  <input type="text" class="form-control" name="candidateOrganisation" value="<?php echo $candidateOrganisation; ?>" required="">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Designation</label>
							
								<div class="col-sm-3">
							     <input type="text" class="form-control" name="candidateDesignation" value="<?php echo $candidateDesignation; ?>" required="">
								</div>
																
							</div>
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Functional Area</label>
								<div class="col-sm-3">
								  
									<select class="ui fluid search dropdown"  name="candidateFunctionalAreaId" required >	
									<?php foreach ($candidate->getFunctionalAreas() as $key => $functionalarea) { ?>
										<option value="">Choose functional area</option>
										<option value="<?php echo $functionalarea['functionalareaId']; ?>"

										<?php echo ($functionalarea['functionalareaId'] == $candidateFunctionalAreaId)? "selected" :"";?>

											>

											<?php echo	$functionalarea['functionalareaName']; ?>

										</option>

									<?php } ?>										
									</select>
								</div>
							</div>							
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Work Experience(In yrs)</label>
								<div class="col-sm-2">
								  <input type="number" class="form-control" name="candidateWorkExp" value="<?php echo $candidateWorkExp; ?>" required="">
								</div>

							</div>
							<div class="form-group row">

								<label for="" class="col-sm-3 col-form-label">Salary </label>
								<div class="col-sm-2">
								  <input type="number" class="form-control" name="candidateSalary" value="<?php echo $candidateSalary; ?>" required="">
								</div>
								<label for="" class="col-form-label">Notice Period</label>
								<div class="col-sm-2">
								  <input type="number" class="form-control"  name="candidateNoticePeriod" value="<?php echo $candidateNoticePeriod; ?>" required="">
								</div>
							</div>								
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label"></label>
								<div class="col-sm-6">
									<p>Education Details</p>
								</div>
							</div>	
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Graduation</label>
								<div class="col-sm-6">
								  <select class="ui fluid search dropdown" name="candiateDegrees[]">
									<option  value="">Choose Graduation</option>
									<?php foreach ($candidate->getDegrees('Graduate') as $key => $degree) { ?>
									<option value="">Choose functional area</option>
									<option value="<?php echo $degree['degreeId']; ?>"
									<?php echo Select::selected($degree['degreeId'], $candidateEducationData); ?>
									>
									<?php echo	$degree['degreeName']; ?>
									</option>
									<?php } ?>	
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Master</label>
								<div class="col-sm-6">
								  <select class="ui fluid search dropdown" name="candiateDegrees[]">
									<option  value="">Choose Graduation</option>
									<?php foreach ($candidate->getDegrees('Master') as $key => $degree) { ?>
									<option value="">Choose functional area</option>
									<option value="<?php echo $degree['degreeId']; ?>"
									<?php echo Select::selected($degree['degreeId'], $candidateEducationData); ?>
									>
									<?php echo	$degree['degreeName']; ?>
									</option>
									<?php } ?>	
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Other</label>
								<div class="col-sm-6">
									<select class="ui fluid search dropdown" name="">
									<option  value="">Choose Graduation</option>
									<?php foreach ($candidate->getDegrees('Master') as $key => $degree) { ?>
									<option value="">Choose functional area</option>
									<option value="<?php echo $degree['degreeId']; ?>"
									<?php echo Select::selected($degree['degreeId'], $candidateEducationData); ?>
									>
									<?php echo	$degree['degreeName']; ?>
									</option>
									<?php } ?>	
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label"></label>
								<div class="col-sm-9">
									<input type="hidden" name="candidateId" value="<?php echo $candidateId;?>">			
									<input type="hidden" name="token" value="<?php echo Token::generate2('updateCandidateRecord'); ?>"> 
									<button type="submit" onclick=" return confirmFormSubmit()" class="btn btn-primary">
										Update Candidate Profile 
									</button>									
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