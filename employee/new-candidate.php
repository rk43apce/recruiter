<?php 
require_once '../core/init.php';
require_once '../functions/helper.php';
Login::auth('employeeId');
$candidate =  new Candidate();
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once  '../include/css.php'; ?>  
</head>
<body>
	<div class="loader"></div>
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
						<li class="breadcrumb-item"><a class="btn-link" href="./candidates.php">Canidates</a>  </li>  
						<li class="breadcrumb-item active">+Add new candidate</li>
						<li class="breadcrumb-item text-danger">
					<?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>
					</li>                                     
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
								<input type="hidden" name="candidateId" id="candidateId" value="<?php echo time(); ?>">	
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
									<input type="email" id="email" class="form-control" placeholder="Email"  name="candidateEmail" required="" autocomplete="off">
									<div id="status" class=""></div>
								</div>
							</div>
							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Mobile No</label>
								<div class="col-sm-3">
								  <input type="text" class="form-control" placeholder="Mobile No"  name="candidateMobileNo" required="">
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
										<?php foreach ($candidate->getFunctionalAreas() as $key => $functionalarea) { ?>
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
										<?php foreach ($candidate->getDegrees('Graduate') as $key => $degree) { ?>
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
										<?php foreach ($candidate->getDegrees('Master') as $key => $degree) { ?>
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
								<div class="col-sm-9" style="padding-top: 15px;">								
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
	
	$( document ) . ready( function () {
		$( "#email" ) . change( function () {
			var usr = $( "#email" ) . val();			
			if (isEmail(usr)) {
				checkingAvailability( usr );
			} else {
				invalidEmail();
			}
		} );
	} );
		
		
	function confirmFormSubmit() {
		var usr = $( "#email" ).val();
			
		if(!isEmail(usr)) {
			invalidEmail();	
			return false;
		}			

		return confirm( 'Are you sure?' );
	}
		
	function isEmail(usr) {
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/; 
		return regex.test(usr);
	}	
		
	function errorMsgClass() {
		$( "#email" ) . removeClass( "is-valid" );
		$( "#status" ) . removeClass( "valid-feedback" );
		$( "#email" ) . addClass( "is-invalid" );
		$( "#status" ) . addClass( "invalid-feedback" );
		$( "#status" ) . html( "&nbsp; Sorry, that email's taken. Try another?" );	
		
	}
		
	function successMsgClass() {
		$( "#email" ) . removeClass( "is-invalid" );
		$( "#status" ) . removeClass( "invalid-feedback" );
		$( "#email" ) . addClass( "is-valid" );
		$( "#status" ) . addClass( "valid-feedback" );
		$( "#status" ) . html( "&nbsp; Success! available to use." );
	}
	
	function invalidEmail() {
		$( "#email" ) . removeClass( "is-valid" );
		$( "#status" ) . removeClass( "valid-feedback" );	
		$( "#email" ) . addClass( "is-invalid" );
		$( "#status" ) . addClass( "invalid-feedback" );
		$( "#status" ) . html( "&nbsp; Enter a valid email account!." );
	}
	function checkingAvailability( usr ) {
		$( "#status" ) . html( 'Checking availability...' );
			$ . ajax( {
				type: "POST",
				url: "verify-email.php",
				data: "email=" + usr,
				dataType: 'text',
			success: function ( msg ) {
				if ( msg == 'available' ) {	
					alert('Another user is using this email');
					$('#email').focus();
					errorMsgClass();
		
				} else {					
					successMsgClass();
				
				}
			}
		} );
		

	}	
	
	</script>

</body>
</html>