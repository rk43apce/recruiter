<?php require_once '../core/init.php';

Login::isUservalid('admin');  

$assingment =  new Assingment();
$employee = new Employee();
$recruiters = $employee->getRecruiterFromEmployee();
$teamLeaders = $employee->getLeaderFromEmployee();

if (Input::exists('get')) {	

	$assingmentId = Input::get('assingmentId');

	if ($assingmentData = $assingment->getOnGoingAssingmentById($assingmentId)) {

		$companyId =  $assingmentData['companyId'];
		$assingmentId =  $assingmentData['assingmentId'];
		$jobRoleTitle =  $assingmentData['jobRoleTitle'];
		$companyName =  $assingmentData['companyName'];
		$spocId =  $assingmentData['spocId'];
		$cityName =  $assingmentData['cityName'];
		$noOfPosition =  $assingmentData['noOfPosition'];
		$clientBrief =  $assingmentData['clientBrief'];

		$recruiterData = $assingment->getAssingmentRecruiterByAssingmentId($assingmentId);	

		$arrayrRcruiter = array();

		if ($recruiterData) {

			foreach ($recruiterData as $key => $recruiter) {	 	

			array_push($arrayrRcruiter,$recruiter['recruiterId']);

			}
		}
	} else {

		Session::put('errorMsg', 'Invalid request or No record found! ');
	} 
}    
	
?>

<!DOCTYPE html>
<html>
<head>

	<?php require_once  '../include/css.php'; ?>  

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

				<?php if (empty($assingmentData)) { ?>		

				<div class="alert alert-dismissible alert-danger">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong><?php echo Session::flash('errorMsg'); ?></strong>
				</div>

				<?php 

				die();

				} ?>

				<div class="card">                   	
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a class="btn-link" href="./company-jobroles.php?companyId=<?php echo $companyId; ?>">
								<?php echo $companyName; ?>								
							</a>
						</li>
						<li class="breadcrumb-item"><?php echo $jobRoleTitle; ?></li>
						<li class="breadcrumb-item active"><?php echo $cityName; ?></li>
						<li class="breadcrumb-item"> <?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>  </li>
					</ol>					
					<div class="line"></div>
					<div class="card-body">
						<form method="post" action="./update-assingment.php">
							<fieldset>

								<div class="form-group row">
									<label for="" class="col-sm-3 col-form-label">Client brief note</label>
									<div class="col-sm-8">
										<textarea class="form-control" rows="3" id="clientBrief" name="clientBrief" required="">
											<?php echo $clientBrief; ?>
										</textarea>
									</div>
								</div>

								<div class="form-group row">
									<label for="" class="col-sm-3 col-form-label">Number of position</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" name="noOfPosition" value="<?php echo $noOfPosition; ?>" required="" >
									</div>
								</div>

								<div class="form-group row">
									<label for="companyId" class="col-sm-3 col-form-label">Assigned SPOC</label>
									<div class="col-sm-8">
										<select class="ui fluid search dropdown"  required="" id="spocId" name="spocId">
											<option value="" > Choose SPOC </option>
											<?php foreach ($teamLeaders as $key => $leader) { ?>

												<option value="<?php echo	$leader['employeeId']; ?>"  <?php echo ($spocId == $leader['employeeId'])? "selected" : "" ?> >

													<?php echo	$leader['employeeName']; ?>

												</option>

											<?php } ?>
										</select>
									</div>
								</div>

								<div class="form-group row">

									<label for="companyId" class="col-sm-3 col-form-label">Recruiters</label>

									<div class="col-sm-8">
										<select class="ui fluid search dropdown" multiple=""  id="recruiters" name="recruiters[]">

											<option value=""> Choose Employee(multiple) </option>

											<?php  foreach ($recruiters as $key => $recruiter) { ?>

												<option value="<?php echo	$recruiter['employeeId']; ?>" 

													<?php echo Assingment::selected($recruiter['employeeId'], $arrayrRcruiter)? "selected" : "" ?>>

													<?php echo	$recruiter['employeeName']; ?>

												</option>

											<?php } ?>

										</select>
									</div>
								</div> 

								<div class="form-group row">
									<label for="companyId" class="col-sm-3 col-form-label"></label>
									<div class="col-sm-8">
										<input type="hidden" name="assingmentId" value="<?php echo $assingmentId; ?>">	
										<input type="hidden" name="token" value="<?php echo Token::generate2('updateAssingment'); ?>">  
										<button type="submit" onclick=" return confirmFormSubmit()" class="btn btn-primary">Update Assignment</button>
										<a href="./ongoing-assignment.php" class="btn btn-link">Cancel</a>
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