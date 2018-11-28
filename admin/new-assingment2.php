<?php require_once '../core/init.php';

Login::isUservalid('admin');  


if (Input::exists('post')) {

	if (Token::check2('newAssingment', Input::get('token'))) {
		# code...
		$assingmentId =  Input::get('assingmentId');
		$companyId =  Input::get('companyId');
		$jobRoleId =  Input::get('jobRoleId');
		$jobCity =  Input::get('jobCity');
		$noOfPosition =  Input::get('noOfPosition');
		$clientBrief =  Input::get('clientBrief');
		$spocId =  Input::get('spocId');
		$recruiters =  Input::get('recruiters');
		$createdOn = date("Y/m/d"); 

		$assingmentData = array("assingmentId"=>$assingmentId, "companyId"=>$companyId, "jobRoleId"=>$jobRoleId, "jobCity"=>$jobCity, "noOfPosition"=>$noOfPosition, "clientBrief"=>$clientBrief, "spocId"=>$spocId, "createdOn"=>$createdOn);

		$assingment = new Assingment();

		if ($assingment->createNewAssingment($assingmentData)) {				

			if (count($recruiters)) {

				if ($assingment->assignAssingmnetToEmployee($assingmentId, $recruiters, $createdOn)) {

					Session::put('isAssingmentCreated', true);	
					Session::put('errorMsg', 'Assingment successfully created!');				
				} else {

					Session::put('errorMsg', 'Assingment created!, but fail to assingment to recruiter!');
				}
			}
			else {

				Session::put('assingmentCreated', 'Assingment successfully created!');
			}
	
		} else {

				Session::put('errorMsg', 'Sorry!, fail to create new assingment');
		}		
	}

}   
	
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.css"/>
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

                    <h5>Create New Assingment</h5>    

                    <span> 

                    	<!-- <p class="text-success"> -->

                      <?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>  
                      <!-- </p> -->
                  	</span>                   

                    <div class="line"></div>

                    <form method="post" action="">
					  <fieldset>
					  	<!-- Compusory field -->
	                    <input type="hidden" name="assingmentId" id="assingmentId" value="">	            
							    						    
					    <div class="row">
							<div class="col-md-6">
								<div class="form-group">
							      <label for="companyId">Company</label>
							      <select class="ui fluid search dropdown"  id="companyName" name="companyId" required="">

							      		<option  value="">Choose</option>
							    		<?php

										foreach ($companies as $key => $company) { ?>

										<option value="<?php echo $company['companyId']; ?>" data-id="<?php echo $company['companyId']; ?>">

										<?php echo	$company['companyName']; ?>

										</option>

										<?php }

										?>
							      </select>
							    </div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
							      <label for="jobRoleId">Role</label>
								      <select class="ui fluid search dropdown"  id="jobRoleId" name="jobRoleId" required="">
								      	<option value="" selected="">Select Role</option>
								      </select>
							    	</div>
								</div>
					    </div>
					      <div class="row">
							<div class="col-md-6">
								<div class="form-group">
							      <label for="jobCity">City</label>
							      <select class="ui fluid search dropdown"  id="jobCity" name="jobCity" required="">
							      	<option  value="">Choose</option>
							    		<?php

										foreach ($cities as $key => $city) { ?>

										<option value="<?php echo	$city['cityId']; ?>">

										<?php echo	$city['cityName']; ?>

										</option>

										<?php }

										?>
							      </select>
							    </div>
							</div>
							<div class="col-md-6">
								<label for="noOfPosition" >Number of position</label>
								<div class="form-group">
								    <select class="ui fluid search dropdown"  id="noOfPosition" name="noOfPosition" required="">
								      <option  value="">Choose position</option>
								      <option value="1">One</option>
								      <option value="2">Two</option>
								      <option value="3">Three</option>
								    </select>
								  </div>
							</div>
					    </div>

					    
				    <div class="row">
					    <div class="col-md-6">
							<div class="form-group">
							<label for="spocId">Assign SPOC</label>
								<select class="ui fluid search dropdown"  required="" id="spocId" name="spocId">
									<option value="" > Choose SPOC </option>
									<?php

										foreach ($teamLeaders as $key => $leader) { ?>

										<option value="<?php echo	$leader['employeeId']; ?>">

										<?php echo	$leader['employeeName'];?>

										</option>

										<?php }

										?>
								</select>
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group">
							<label for="recruiters">Assign additional recruiters (Optional)</label>
								<select class="ui fluid search dropdown" multiple=""  id="recruiters" name="recruiters[]">
								<option value=""> Choose Employee(multiple) </option>

										<?php

										foreach ($recruiters as $key => $recruiter) { ?>

										<option value="<?php echo	$recruiter['employeeId']; ?>">

										<?php echo	$recruiter['employeeName']; ?>

										</option>

										<?php }

										?>
								</select>			   
							</div>	
					 	</div>	
					 </div>
					 <div class="row">
					    <div class="col-md-6">
							<div class="form-group">
							<label for="frontingEntitys">Fronting entity</label>
								<select class="ui fluid search dropdown"  required="" id="frontingEntity" name="frontingEntity">
									<option value=""> Choose BE/UN </option>
									<option value="Blueyed">Blueyed</option>
									<option value="Unison">Unison</option>
								</select>
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group">
							<label for="priority">Assign priority</label>
								<select class="ui fluid search dropdown"  id="priority" name="priority" required="">
									<option value=""> Choose H/M/L</option>	
									<option value="Low">Low</option>
									<option value="Medium">Medium</option>
									<option value="High">High</option>									
								</select>			   
							</div>	
					 	</div>	
					 </div>
					 <div class="form-group">
					      <label for="clientBrief">Client brief note</label>
					      <textarea class="form-control" rows="3" placeholder="Write here..." id="clientBrief" name="clientBrief" required=""></textarea>
					    </div>
					  <input type="hidden" name="token" value="<?php echo Token::generate2('newAssingment'); ?>">  
					  <button type="submit" onclick=" return confirmFormSubmit()" class="btn btn-primary">Launch Assingment</button>
					  <a href="./dashboard.php" class="btn btn-link">Back to Dashboard</a>
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