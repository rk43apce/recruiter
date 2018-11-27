<?php require_once '../core/init.php';
require_once '../functions/sanitize.php';


Login::isUservalid('admin');  

$functionalArea = new FunctionalArea();

$jobfunctionalAreas = $functionalArea->getFunctionalAreas();


$city = new City();

$cities = $city->getCities();


$skill = new Skill();

$skills = $skill->getSkills();



	
if (Input::exists('post')) {



		echo "<pre>";
		var_dump($_POST);
		echo "<pre>";



}elseif (Input::exists('get')) {	

	if (Input:: get('companyId') ) {
		# code...
		$company = new Company();  

	    if (!$result = $company->getCompanyById( escape(Input::get('companyId')))) {

	        Session::put("errorMsg", 'Sorry, No record found!');
	    }

	}

} else {

	Redirect::to('./companies.php');
}    
    
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.css"/>
	<?php require_once  '../include/css.php'; ?>   
	 <script>
        window.onload = function () {
            var jobRoleId = new Date().getTime(); // generating student registation by using tim in milliseconds

            document.getElementById( "jobRoleId" ).value = jobRoleId;
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

                    <h2>Add new Job Role</h2>    
                    <span><a href="./companies.php" class="btn-link">Back to Company Dashboard</a></span>
                    <span> 
                    <p class="text-success">
                      <?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>  
                     </p>
                  	</span>                   

                    <div class="line"></div>

                    <form method="post" action="">
					  <fieldset>

					  	<div class="row">
							<div class="col-md-6">

								<div class="form-group">
								  <label class="col-form-label" for="inputDefault">Company Name</label>
								  <input type="text" class="form-control" value="<?php echo $result['companyName'];?>" disabled="">
								</div>
							</div>
							<div class="col-md-6">

								<div class="form-group">
								  <label class="col-form-label" for="inputDefault">City</label>
								  <input type="text" class="form-control" value="<?php echo $result['companyCity'];?>" disabled="">
								</div>
							</div>
						</div>

	                    <input type="hidden" name="jobRoleId" id="jobRoleId" value="">
	            
							    						    
					    <div class="row">
							<div class="col-md-6">

								<div class="form-group">
								  <label class="col-form-label" for="inputDefault">Role  Title</label>
								  <input type="text" class="form-control" placeholder="Role title" id="" name="jobRoleTitle">
								</div>
							</div>
							<div class="col-md-6">

								<div class="form-group">
								  <label class="col-form-label" for="inputDefault">Variable Salary</label>
								  <input type="text" class="form-control" placeholder="Variable salary element" id="" name="">
								</div>
							</div>
						</div>

						 <div class="row">
					    		<div class="col-md-6">
								<div class="form-group">
								  <label class="col-form-label" for="inputDefault">Work Experience</label>
								  <div class="row">
								  <div class="col-md-5">
								  	<input type="number" class="form-control" placeholder="Min" id="minWorkExperience" name="minWorkExperience">
								  </div>
									<div class="col-md-2">
								  	<span class="to">To</span> 
									</div>
								  <div class="col-md-5">
								  	 <input type="number" class="form-control" placeholder="Max" id="maxWorkExperience" name="maxWorkExperience">
								  </div>
									</div>
								</div>
								</div>
								<div class="col-md-6">
								<div class="form-group">
								  <label class="col-form-label" for="inputDefault">Fixed Salary</label>
								  <div class="row">
								  <div class="col-md-5">
								  	<input type="number" class="form-control" placeholder="Min" id="minFixedSalary" name="minFixedSalary">
								  </div>
								<div class="col-md-2">
								  	<span>To</span> 
									</div>
								  <div class="col-md-5">
								  	 <input type="number" class="form-control" placeholder="Max" id="maxFixedSalary" name="maxFixedSalary">
								  </div>
									</div>
								</div>
								</div>
					    </div>


					    <div class="row">
					    		<div class="col-md-6">
								<div class="form-group">
							<label for="spocId">Functional Area</label>
							<select class="ui fluid search dropdown"  required="" id="functionalAreaId" name="functionalAreaId">
								<option value=""> Choose functional area</option>

								<?php

								foreach ($jobfunctionalAreas as $key => $area) { ?>

									<option value="<?php echo $area['functionalareaId']; ?>">

									<?php echo	$area['functionalareaName']; ?>

									</option>

								<?php }

								?>
						
							</select>
					    </div>	
								</div>
									<div class="col-md-6">
								<div class="form-group">
							<label for="spocId">Location</label>
							<select class="ui fluid search dropdown"  required="" id="locationId" name="locationId">
								<option value=""> Choose Location </option>
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
					    </div>
					 
					

					    <div class="form-group">
					      <label for="clientBrief">Client brief note</label>
					      <textarea class="form-control" rows="3" placeholder="Write here..." id="clientBriefNote" name="clientBriefNote"></textarea>
					    </div>

		
 	 
					  <button type="submit" class="btn btn-primary">Launch Assingment</button>
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
 
  </body>

</html>