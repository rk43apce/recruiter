<?php require_once '../core/init.php';

	Login::isUservalid('admin'); 

	$assingment = new Assingment();
	$companies = $assingment->getAllCompany();
	$cities = $assingment->getCities();
	$employee = new Employee();
	$recruiters = $employee->getRecruiterFromEmployee();
	$teamLeaders = $employee->getLeaderFromEmployee();
    	
?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once  '../include/css.php'; ?>   
<script>

	window.onload = function () {
	var assingmentId = new Date().getTime(); // generating student registation by using tim in milliseconds
	document.getElementById( "assingmentId" ).value = assingmentId;
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
			<?php require_once  '../include/navbar-top.php'; ?>           

			<div class="container">
				<div class="card"> 
					<ol class="breadcrumb">   
						<li class="breadcrumb-item"><a href="./companies.php" class="btn-link">Companies</a></li> 
						<li class="breadcrumb-item"><a href="./ongoing-assignment.php" class="btn-link">Assignments</a></li>           
						<li class="breadcrumb-item">Create New Assignment</li>
						<li class="breadcrumb-item text-success">
							<?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>
						</li>                   
					</ol>        

					<div class="line"></div>

					<form method="post" action="./add-assingment.php">
						<fieldset>
							<!-- Compusory field -->
							<input type="hidden" name="assingmentId" id="assingmentId" value="">	
							 <!--  -->

							<div class="form-group row">
								<label for="companyId" class="col-sm-3 col-form-label">Company</label>
								<div class="col-sm-8">
									<select class="ui fluid search dropdown"  id="companyName" name="companyId" required="" autofocus="">

										<option  value="">Choose</option>
										<?php foreach ($companies as $key => $company) { ?>

											<option value="<?php echo $company['companyId']; ?>" data-id="<?php echo $company['companyId']; ?>">

												<?php echo	$company['companyName']; ?>

											</option>

										<?php } ?>
									</select>
								</div>
							</div> 

							<div class="form-group row">
								<label for="jobRoleId" class="col-sm-3 col-form-label">Role</label>
								<div class="col-sm-8">
									<select class="ui fluid search dropdown"  id="jobRoleId" name="jobRoleId" required="">
										<option value="" selected="">Select Role</option>
									</select>
								</div>
							</div> 

							<div class="form-group row">
								<label for="jobRoleId" class="col-sm-3 col-form-label">Number of position</label>
								<div class="col-sm-2">
									<input type="number" class="form-control" name="noOfPosition" placeholder="Positions" required="">
								</div>

								<label for="companyId" class="col-form-label">City</label>
								<div class="col-sm-3">
									<select class="ui fluid search dropdown"  id="jobCity" name="jobCity" required="">
										<option  value="">Choose</option>
										<?php foreach ($cities as $key => $city) { ?>

											<option value="<?php echo	$city['cityId']; ?>">

												<?php echo	$city['cityName']; ?>

											</option>

										<?php } ?>
									</select>
								</div>
							</div>   						

							<div class="form-group row">
								<label for="companyId" class="col-sm-3 col-form-label">Assign SPOC</label>
								<div class="col-sm-5">
									<select class="ui fluid search dropdown"  required="" id="spocId" name="spocId">
										<option value="" > Choose SPOC </option>
										<?php foreach ($teamLeaders as $key => $leader) { ?>

											<option value="<?php echo	$leader['employeeId']; ?>">

												<?php echo	$leader['employeeName'];?>

											</option>

										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group row">
								<label for="companyId" class="col-sm-3 col-form-label">Recruiters (Optional)</label>
								<div class="col-sm-8">
									<select class="ui fluid search dropdown" multiple=""  id="recruiters" name="recruiters[]">
										<option value=""> Choose Employee(multiple) </option>

										<?php foreach ($recruiters as $key => $recruiter) { ?>

											<option value="<?php echo	$recruiter['employeeId']; ?>">

												<?php echo	$recruiter['employeeName']; ?>

											</option>

										<?php } ?>
									</select>
								</div>
							</div>     

							<div class="form-group row">						
								<label for="frontingEntitys" class="col-sm-3 col-form-label">Assign priority</label>
								<div class="col-sm-2">
									<select class="ui fluid search dropdown"  id="priority" name="priority" required="">
										<option value=""> Choose H/M/L</option>	
										<option value="Low">Low</option>
										<option value="Medium">Medium</option>
										<option value="High">High</option>									
									</select>	
								</div>	
								<label for="frontingEntitys" class="col-form-label">Fronting Entity</label>
								<div class="col-sm-3">
									<select class="ui fluid search dropdown"  required="" id="frontingEntity" name="frontingEntity">
										<option value=""> Choose BE/UN </option>
										<option value="Blueyed">Blueyed</option>
										<option value="Unison">Unison</option>
									</select>
								</div>
							</div>

							<div class="form-group row">
								<label for="frontingEntitys" class="col-sm-3 col-form-label">Client brief note</label>
								<div class="col-sm-8">
									<textarea class="form-control" rows="3" placeholder="Write here..." id="clientBrief" name="clientBrief" required=""></textarea>
								</div>	
							</div>	

							<div class="form-group row">
								<label for="frontingEntitys" class="col-sm-3 col-form-label"></label>
								<div class="col-sm-8">
									<input type="hidden" name="token" value="<?php echo Token::generate2('newAssingment'); ?>">  
									<button type="submit" onclick=" return confirmFormSubmit()" class="btn btn-primary">Launch Assignment</button>
									<a href="./ongoing-assignment.php" class="btn btn-link">Cancel</a>							  		
								</div>	
							</div>	

						</fieldset>
					</form>                 
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

	<script>
		$("#companyName").on("change", function() {
			var id = $(this).find(':selected').attr("data-id");
			$("#jobRoleId").find('option:not(:first)').remove();
			if(id != '') {
				$.post("getJobRoles.php", {id: id}).done(function(data) {
					$("#jobRoleId").append(data);
				});      
			} 
		});
	</script>
 </body>
</html>