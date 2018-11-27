<?php require_once '../core/init.php';

Login::isUservalid('admin');  


$employee =  new Employee();

$roles =  $employee->getEmployeeRole();

$leaders =  $employee->getLeaderFromEmployee();




if (Input::exists('post')) {

	if (Token::check2('addNewEmployee', Input::get('token'))) {
		# code...
		$employeeName =  Input::get('employeeName');
		$employeeDOB =  Input::get('employeeDOB');
		$employeeMobileNumber =  Input::get('employeeMobileNumber');
		$employeeEmailId =  Input::get('employeeEmailId');
		$employeeTypeId =  Input::get('employeeTypeId');
		$employeeTeamLeaderId =  Input::get('employeeTeamLeaderId');

		$employeeData = array("employeeName"=>$employeeName, "employeeDOB"=>$employeeDOB, "employeeMobileNumber"=>$employeeMobileNumber, "employeeEmailId"=>$employeeEmailId, "employeeTypeId"=>$employeeTypeId, "employeeTeamLeaderId"=>$employeeTeamLeaderId);


		$employee = new Employee();

		if ($employee->addNewEmployee($employeeData)) {	

			Session::put('errorMsg', 'Success!, New employee added to database');			

			Redirect::to('./employees.php');

		} else {

				Session::put('errorMsg', 'Sorry!, fail to add new employee');
		}

		
	}

}    
    
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.css"/>
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

                <div class="card">    

                    <h2>Add new employee</h2>    

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
								  <label class="col-form-label" for="inputDefault">Name</label>
								  <input type="text" class="form-control" placeholder="Employee Name" id="employeeName" name="employeeName" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label class="col-form-label" for="inputDefault">Date of birth</label>
								  <input type="date" class="form-control" placeholder="Employee DOB" id="employeeDOB" name="employeeDOB" required="">
								</div>
								</div>
					    </div>
					    <div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  <label class="col-form-label" for="inputDefault">Mobile No</label>
								  <input type="text" class="form-control" placeholder="Employee Mobile No" id="employeeMobileNumber" name="employeeMobileNumber" required="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  <label class="col-form-label" for="inputDefault">Email</label>
								  <input type="email" class="form-control" placeholder="Employee Email ID" id="employeeEmailId" name="employeeEmailId" required="">
								</div>
							</div>
					    </div>


					      <div class="row">
							<div class="col-md-6">
								<div class="form-group">
								
							<label for="spocId">Employee Role</label>
							<select class="ui fluid search dropdown"  required="" id="employeeTypeId" name="employeeTypeId" >
								
								<option  value="">Choose Employee Role</option>
						

								<?php

								foreach ($roles as $key => $role) { ?>

									<option value="<?php echo	$employeeRole['employeeRoleId']; ?>">

									<?php echo	$role['employeeRoleName']; ?>

									</option>

								<?php }

								?>

							</select>
					    </div>	
							</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="spocId">Team Leader (If employee is recruiter)</label>
								<select class="ui fluid search dropdown"  id="employeeTeamLeaderId" name="employeeTeamLeaderId">
								<option value=""> Choose Team Leader </option>
								<?php 
								foreach ($leaders as $key => $leader) { ?>

								<option value="<?php echo	$leader['employeeId']; ?>">

								<?php echo	$leader['employeeName']; ?>

								</option>

								<?php } ?>
								</select>
							</div>
						</div>
					</div>					   						 
					  <input type="hidden" name="token" value="<?php echo Token::generate2('addNewEmployee'); ?>">  
					  <button type="submit" onclick=" return confirmFormSubmit()" class="btn btn-primary">Add Employee</button>
					  <a class="btn btn-link" href="./dashboard.php">Back to Dashboard</a>
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