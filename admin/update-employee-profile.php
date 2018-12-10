<?php require_once '../core/init.php';
require_once '../functions/sanitize.php';

Login::isUservalid('admin');  


$employee =  new Employee();

if (Input::exists('post')) {


	if (Token::check2('updateEmployee', Input::get('token'))) {

	
		$employeeName =  Input::get('employeeName');
		$employeeMobileNumber =  Input::get('employeeMobileNumber');
		$employeeEmailId =  Input::get('employeeEmailId');
		$employeeId =  Input::get('employeeId');

		$employeeDataToUpdate = array("employeeName"=>$employeeName, "employeeMobileNumber"=>$employeeMobileNumber, "employeeEmailId"=>$employeeEmailId);

		if ($employee->updateEmployeeProfile($employeeDataToUpdate, $employeeId)) {		

			Session::put('employeeUpdateMsg', 'Employee data successfully updated!');

			Redirect::to('employee-profile.php?employeeId='. $employeeId); 

			exit();		

		} else {

			Session::put('employeeUpdateMsg', 'Sorry, fail to update record, try again!');
		}

			

	}


}elseif (Input::exists('get')) {	


	$employeeId =  escape(Input::get('employeeId'));

	
	$employeeData =  $employee->getEmployeeById($employeeId);

	$employeeId =  $employeeData['employeeId']; 

 	$employeeName =  $employeeData['employeeName']; 
 	$employeeMobileNumber =  $employeeData['employeeMobileNumber'];
 	$employeeEmailId =  $employeeData['employeeEmailId'];
 	$employeeRoleId =  $employeeData['employeeRoleId'];
 	$employeeRoleName =  $employeeData['employeeRoleName'];
	
}else {

	Redirect::to('./dashboard.php');
}    
    
?>
<!DOCTYPE html>
<html>
<head>
	<?php require_once  '../include/css.php'; ?> 

	<style type="">
	.card {
		max-width: 786px;
		margin-right: auto;
		margin-left: auto;
	}
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
                	
                    <h5><?php echo $employeeName; ?></h5>  
                    
                    <span> 

                    	<p class="text-success">

                      <?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>  
                      </p>
                  	</span>                   

                    <div class="line"></div>

                     <form method="post" action="">
					  <fieldset>
				  		<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Name</label>
								<div class="col-sm-6">
								  <input type="text" class="form-control" id="employeeName" name="employeeName" value="<?php echo $employeeName; ?>" required="" autofocus="">
								</div>
							</div>
						

							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Mobile No</label>
								<div class="col-sm-6">
								  <input type="text" class="form-control" value="<?php echo $employeeMobileNumber; ?>" id="employeeMobileNumber" name="employeeMobileNumber" required="">
								</div>
							</div>

							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label">Email</label>
								<div class="col-sm-6">
								    <input type="email" class="form-control" value="<?php echo $employeeEmailId; ?>" id="employeeEmailId" name="employeeEmailId" required="">
								</div>
							</div>
						

							<div class="form-group row">
								<label for="" class="col-sm-3 col-form-label"></label>
								<div class="col-sm-9">
									<input type="hidden" name="employeeId" value="<?php echo $employeeId; ?>"> 
									<input type="hidden" name="token" value="<?php echo Token::generate2('updateEmployee'); ?>">  
									<button type="submit" onclick=" return confirmFormSubmit()" class="btn btn-primary">Update Details</button>
									<a class="btn btn-link" href="./employee-profile.php?employeeId=<?php echo $employeeId; ?>">Cancel</a> 
								</div>
							</div>					  				   						 
					 
					  </fieldset>
					</form>                   
                </div>
            </div>
        </div>
    </div>

    <?php require_once  '../include/footer.php'; ?>

	  <script type="text/javascript">
	    function confirmFormSubmit() {
	    	return confirm('Are you sure you want to save this thing into the database?');
	    }
	   </script> 
  </body>

</html>