<?php 
require_once '../core/init.php';
require_once '../functions/helper.php';



if (!Input::exists('get')) {	
	
	Redirect::to('dashboard.php');
	die();
} 
if (empty(Input::get('assingmentId')) ) {	
	
	Redirect::to('dashboard.php');
	die();
} 


$assingmentId = Input::get('assingmentId');	
$assingment =  new Assingment();

if ($assingmentData = $assingment->getOnGoingAssingmentById($assingmentId)) {

	$companyId =  $assingmentData['companyId'];
	$assingmentId =  $assingmentData['assingmentId'];
	$jobRoleTitle =  $assingmentData['jobRoleTitle'];
	$companyName =  $assingmentData['companyName'];
	$spocId =  $assingmentData['spocId'];
	$spocName =  $assingmentData['employeeName'];
	$cityName =  $assingmentData['cityName'];
	$minWorkExperience =  $assingmentData['minWorkExperience'];
	$maxWorkExperience =  $assingmentData['maxWorkExperience'];
	$createdOn =  $assingmentData['createdOn'];		

	$candidate =  new Candidate();

	$functionalareasData = $candidate->getFunctionalAreas();
	
	$graduationDegreeData = $candidate->getDegrees('Graduate');	
	
	$masterDegreeData = $candidate->getDegrees('Master');

} else {

	Session::put('errorMsg', 'Invalid request or No record found! ');
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
	<script>
		window.onload = function () {
			var candidateId = new Date().getTime(); // generating student registation by using tim in milliseconds
			document.getElementById( "candidateId" ).value = candidateId;
		};
	</script> 
</head>

<body>
	<div class="wrapper">
		<!-- Sidebar Holder -->
		<?php require_once  '../include/sidebar.php'; ?> 
		<!-- Page Content Holder -->
		<div id="content">
			<!-- Sidebar Holder -->
			<?php require_once  '../include/navbar-top-employee.php'; ?>
			
			<!-- kill page if no record found -->
			<?php Data::checkData($assingmentData); ?>	 		
			 	      
			 
			 <div class="container">
				<div class="card">   
					<ol class="breadcrumb">    
						<li class="breadcrumb-item " ><?php echo $companyName ?></li> 
						<li class="breadcrumb-item " ><?php echo $jobRoleTitle ?></li>   
						<li class="breadcrumb-item active">Add Candidates</li>                                          
					</ol>	
					<div class="line"></div>
					<div class="card-body">					
	                    <form method="post" action="./add-candidate.php">
						  <fieldset>	
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label"></label>
								<div class="col-sm-6">
								<p>Personal Details</p>
								</div>
							</div>			
							<div class="form-group row">
								<!-- Compusory field -->
								<input type="hidden" name="candidateId" id="candidateId" value="">	
								<!--  -->

								<label for="" class="col-sm-3 col-form-label">Full Name</label>
								<div class="col-sm-6">
								  <input type="text" class="form-control" placeholder="Full Name"  name="candidateFullName" required="" autofocus>
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">DOB</label>
								<div class="col-sm-3">
								<input type="date" class="form-control" placeholder="DOB" name="candidateDOB" required="">
								</div>
							</div>								
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Email</label>
								<div class="col-sm-6">
									<input type="email" class="form-control" placeholder="Email"  name="candidateEmail" required="">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Mobile No</label>
								<div class="col-sm-3">
								  <input type="number" class="form-control" placeholder="Mobile No"  name="candidateMobileNo" required="">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Current City</label>
								<div class="col-sm-3">								  
									<input type="text" class="form-control" placeholder="City"  name="candidateCity" required="">
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
								  <input type="text" class="form-control" placeholder="Organisation" name="candidateOrganisation" required="">
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Designation</label>
							
								<div class="col-sm-3">
							     <input type="text" class="form-control" placeholder="Designation" name="candidateDesignation" required="">
								</div>
																
							</div>
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Functional Area</label>
								<div class="col-sm-3">
								  
									<select class="ui fluid search dropdown"  name="candidateFunctionalAreaId" required >
									<option  value="">Choose</option>
										<?php foreach ($functionalareasData as $key => $functionalarea) { ?>
											<option value="">Choose functional area</option>
											<option value="<?php echo $functionalarea['functionalareaId']; ?>">
												<?php echo	$functionalarea['functionalareaName']; ?>
											</option>
										<?php } ?>										
									</select>
								</div>
							</div>							
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Work Experience</label>
								<div class="col-sm-2">
								  <input type="number" class="form-control" name="candidateWorkExp" value="1" required="">
								</div>

							</div>
							<div class="form-group row">

								<label for="" class="col-sm-3 col-form-label">Salary </label>
								<div class="col-sm-2">
								  <input type="number" class="form-control" value="1"  name="candidateSalary" required="">
								</div>
								<label for="" class="col-form-label">Notice Period</label>
								<div class="col-sm-2">
								  <input type="number" class="form-control"  name="candidateNoticePeriod" value="1" required="">
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
								  <select class="ui fluid search dropdown" name="candiateDegrees[]" required>
										<option  value="">Choose Graduation</option>
										<?php foreach ($graduationDegreeData as $key => $degree) { ?>
											<option value="">Choose functional area</option>
											<option value="<?php echo $degree['degreeId']; ?>">
												<?php echo	$degree['degreeName']; ?>
											</option>
										<?php } ?>	
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Master</label>
								<div class="col-sm-6">
								  <select class="ui fluid search dropdown" name="candiateDegrees[]" required>
										<option  value="">Choose Graduation</option>
										<?php foreach ($masterDegreeData as $key => $degree) { ?>
											<option value="">Choose functional area</option>
											<option value="<?php echo $degree['degreeId']; ?>">
												<?php echo	$degree['degreeName']; ?>
											</option>
										<?php } ?>	
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Qualification 1</label>
								<div class="col-sm-6">
									<select class="ui fluid search dropdown" name="candiateDegrees[]" >
										<option value="1">Qualification 1</option>
										<option value="2">Qualification 2</option>
										<option value="3">Qualification 3</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label"></label>
								<div class="col-sm-9">
									<input type="hidden" name="assingmentId" value="<?php echo $assingmentId;?>">
									<input type="hidden" name="token" value="<?php echo Token::generate2('addNewCandidate'); ?>">  
									<button type="submit" onclick=" return confirmFormSubmit()" class="btn btn-primary">
										Add Candidate 
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