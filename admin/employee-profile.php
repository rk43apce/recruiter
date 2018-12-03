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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

        <!-- Page Content Holder -->
        <div id="content">
        <!-- Sidebar Holder -->
        <?php require_once  '../include/navbar-top.php'; ?>           

            <div class="container">
                <div class="card">  
                    <p class="text-success">  <?php echo (Session::exists('employeeUpdateMsg'))?  Session::flash('employeeUpdateMsg') : ""  ?></p>
                  
                    <h3><?php echo $employeeName; ?></h3> 
                    <p>
                        <?php echo $employeeRoleName; ?> 
                        <span class="pull-right">
                            <a class="btn-link" href='update-employee-profile.php?employeeId=<?php echo $employeeId; ?>' title='Edit  profile' data-toggle='tooltip'>
                                <span><i class="fa fa-edit"></i></span>
                            </a>
                        </span>
                    </p>  

                    <div class="line"></div>    
                    <ul class="list-inline">
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