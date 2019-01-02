<?php require_once '../core/init.php';
require_once '../functions/sanitize.php';

Login::isUservalid('admin');  

if (!Input::exists('get')) {

	Redirect::to('./companies.php');
	die();
}   
# code...

$companyId = escape(Input::get('companyId')); //

$company = new Company();  

if (!$result = $company->getCompanyById($companyId)) {

	Redirect::to('./companies.php');  
	
	die();      
}

$jobrole = new Jobrole();

$jobfunctionalAreas = $jobrole->getFunctionalAreas();
$skills = $jobrole->getSkills();
$cities = $jobrole->getCities();
$currencyCodes = $jobrole->getCurrency();


?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.css"/>
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
        <?php require_once  '../include/navbar-top.php'; ?>           

            <div class="container">

                <div class="card">  


                    <ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="company-jobroles.php?companyId=<?php echo escape(Input::get('companyId')); ?>" class="btn-link"><?php echo $result['companyName'];?></a></li>
						<li class="breadcrumb-item"><?php echo $result['cityName'];?></li>
						<li class="breadcrumb-item active">Add new Job Role</li>
					</ol>

                    <span>                  
                      <?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>                   
                  	</span>                   

                    <div class="line"></div>

                    <form method="post" action="./add-JobRole.php">
					  <fieldset>
					  	<!-- Compulsory field setting unique id for every new jobRole -->
					  	<input type="hidden" name="jobRoleId" id="jobRoleId" value="<?php echo time();?>">
					  	<!--  -->

						<div class="form-group row">
							<label for="jobRoleId" class="col-sm-3 col-form-label">Role  Title</label>
							<div class="col-sm-6">
							 <input type="text" class="form-control" placeholder="Role title" id="" name="jobRoleTitle" required="">
							</div>
						</div>

						

						<div class="form-group row">
							<label for="jobRoleId" class="col-sm-3 col-form-label">Work Experience</label>
							<div class="col-sm-2">
								<select class="ui fluid search dropdown" name="expInYearOrMonth" >									
									<option value="Year" selected="">Year</option>
									<option value="Month">Month</option>									
								</select>
							</div>

							<div class="col-sm-2">
							<input type="number" class="form-control" placeholder="Min" id="minWorkExperience" name="minWorkExperience" >
							</div>
							<label for="jobRoleId" class="col-form-label">To</label>
							<div class="col-sm-2">
							<input type="number" class="form-control" placeholder="Max" id="maxWorkExperience" name="maxWorkExperience">
							</div>
						</div>  


						<div class="form-group row">
							<label for="jobRoleId" class="col-sm-3 col-form-label">Fixed Salary</label>
							<div class="col-sm-2">
							<select class="ui fluid search dropdown" name="currencyId" >
							
							<?php foreach ($currencyCodes as $key => $code) { ?>

								<option value="<?php echo $code['currencyId']; ?>">

								<?php echo	$code['currencyCode']; ?>

								</option>

							<?php } ?>
						
							</select>
							</div>
							<div class="col-sm-2">
							<input type="number" class="form-control" placeholder="Min" id="minFixedSalary" name="minFixedSalary">
							</div>
							<label for="jobRoleId" class="col-form-label">To</label>
							<div class="col-sm-2">
								 <input type="number" class="form-control" placeholder="Max" id="maxFixedSalary" name="maxFixedSalary" >
							</div>
						</div> 
						<div class="form-group row">
							<label for="jobRoleId" class="col-sm-3 col-form-label">Variable Salary</label>
							<div class="col-sm-2">
							 <input type="text" class="form-control" placeholder="Variable" id="variableSalary" name="variableSalary" >
							</div>
						</div>     

						<div class="form-group row">
							<label for="jobRoleId" class="col-sm-3 col-form-label">Functional Area</label>
							<div class="col-sm-6">
							 <select class="ui fluid search dropdown"  required="" id="functionalAreaId" name="functionalAreaId" required="">
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

					

						<div class="form-group row">
							<label for="jobRoleId" class="col-sm-3 col-form-label">Key Skills (Multiple)</label>
							<div class="col-sm-6">
							 <select class="ui fluid search dropdown" multiple=""  id="jobRoleSkills" name="jobRoleSkills[]" required>
								<option value=""> Choose Skills(multiple) </option>
								<?php

								foreach ($skills as $key => $skill) { ?>

									<option value="<?php echo	$skill['skillId']; ?>">

									<?php echo	$skill['skillName']; ?>

									</option>

								<?php }

								?>
							</select>
							</div>
						</div>

						<div class="form-group row">
							<label for="jobRoleId" class="col-sm-3 col-form-label">Client brief note</label>
							<div class="col-sm-6">
							<textarea class="form-control" rows="3" placeholder="Write here..." id="clientBriefNote" name="clientBriefNote"></textarea>
							</div>
						</div>

						<div class="form-group row">
							<label for="jobRoleId" class="col-sm-3 col-form-label"></label>
							<div class="col-sm-6">
								<input type="hidden" name="companyId" value="<?php echo escape(Input::get('companyId')); ?>"> 
								<input type="hidden" name="token" value="<?php echo Token::generate2('newJobRole'); ?>">  
								<button type="submit" onclick=" return confirmFormSubmit()" class="btn btn-primary">Save Job Role</button>
								<a class="btn btn-link" href="company-jobroles.php?companyId=<?php echo escape(Input::get('companyId')); ?>">Cancel</a>
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
  </body>

</html>