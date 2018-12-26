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
    .card {
        max-width: 786px;
        margin-right: auto;
        margin-left: auto;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
    });
</script>
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
                    <h5> <?php echo $employeeName; ?>                     
                        <a class="btn btn-link"  href='update-employee-profile.php?employeeId=<?php echo $employeeId; ?>' title='Edit  profile' data-toggle='tooltip'>
                            <i class="fa fa-edit"></i>
                        </a> 
                    </h5>  
                 
                    <span><?php echo (Session::exists('employeeUpdateMsg'))?  Session::flash('employeeUpdateMsg') : ""  ?></span>            
                    <div class="line"></div>    
                    <ul class="list-inline">
                         <li class="list-inline-item"><?php echo $employeeRoleName; ?></li>
                        <li class="list-inline-item"><?php echo $employeeEmailId; ?></li>
                        <li class="list-inline-item"><?php echo $employeeMobileNumber; ?></li>                        
                    </ul> 
                </div>
            </div>
        </div>
    </div>
    <?php require_once  '../include/footer.php'; ?>
</body>
</html>