<?php require_once '../core/init.php';
require_once '../functions/sanitize.php';

Login::isUservalid('admin');  

(!Input::exists('get')) ?  Redirect::to('./companies.php') : "";

if (Input:: get('employeeId') ) {
	# code...
	$employee = new Employee();  
	
    if ($employeeDaTa = $employee->getEmployeeById(escape(Input::get('employeeId')))) {
    	$employeeName =  $employeeDaTa['employeeName']; 
    	$employeeId =  $employeeDaTa['employeeId'];
        $employeeMobileNumber =  $employeeDaTa['employeeMobileNumber'];
        $employeeEmailId =  $employeeDaTa['employeeEmailId'];
        $employeeTypeId =  $employeeDaTa['employeeTypeId'];
        $employeeRoleName =  $employeeDaTa['employeeRoleName'];
        $isActive =  $employeeDaTa['isActive'];
        $createdAt =  $employeeDaTa['createdAt'];
    } else {
    	Session::put("errorMsg", 'Sorry, No record found!');
    }

}  
    
?>

<!DOCTYPE html>
<html>
<head>
<?php require_once  '../include/css.php'; ?> 
<style type="text/css">
   
	.profile-head .nav-tabs{
margin-bottom:3%;
}
.profile-head .nav-tabs .nav-link{
font-weight:600;
border: none;
}
.profile-head .nav-tabs .nav-link.active{
border: none;
border-bottom:2px solid #6d7fcc;
}


.profile-work ul{
list-style: none;
}
.profile-tab label{
font-weight: 600;
}
.profile-tab p{
font-weight: 300;
color: inherit;
}
</style>
 
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar Holder -->
        <?php require_once  '../include/sidebar.php'; ?> 
        <div id="content">
        <!-- Sidebar Holder -->
        <?php require_once  '../include/navbar-top.php'; ?>           

    
            <div class="container">
            <div class="card">
            	 <ol class="breadcrumb">                  
                  <li class="breadcrumb-item"><a href="./employees.php" class="btn-link">Employees</a> </li>
                  <li class="breadcrumb-item"><?php echo $employeeName; ?></li>
                  <li class="breadcrumb-item text-success">
                  <?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>
                  </li>                   
                </ol>       
            </div>
			<div class="card">
				<div class="row">
					<div class="col-md-12">
						<div class="profile-head">
							<div class="row">
								<div class="col-md-9">
								<h5><?php echo $employeeName; ?></h5>
								</div>
								<div class="col-md-3">						
									<a class="btn btn-link"  href='update-employee-profile.php?employeeId=<?php echo $employeeId; ?>' title='Edit  profile' data-toggle='tooltip'>
									<i class="fa fa-edit"></i>
									</a> 									
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
								<br>
								<h6><?php echo $employeeRoleName; ?></h6>
								<br>
								</div>
							</div>
							
							<ul class="nav nav-tabs" id="myTab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Tab 1</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Tab 2</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8">
						<div class="tab-content profile-tab" id="myTabContent">
							<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
								<div class="row">									
									<div class="col-md-21">
										<p>Content goes here</p>
									</div>									
								</div>								
							</div>

							<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
								<div class="row">
									<div class="col-md-21">
										<p>Content goes here</p>
									</div>
								</div>	
							</div>							
						</div>
					</div>
				</div>                   
			</div>
			
			</div>
        </div>
    </div>
    <?php require_once  '../include/footer.php'; ?>
</body>
</html>