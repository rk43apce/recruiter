<?php 
require_once '../core/init.php'; 
require_once '../functions/helper.php';

Login::auth('employeeId');


$employee = new Employee();



if (!$assingmentData = $employee->getEmployeeLeaderAssingment(Session::get('employeeId'), Session::get('employeeTypeId'))) {

	Session::put("noAssignment", 'Sorry! No ongoing assignment assign to you!');			
}


?>

<!DOCTYPE html>
<html>
<head>
    <?php require_once  '../include/css.php'; ?>    
    
</head>

<body>

<div class="wrapper">
	<!-- Sidebar Holder -->
	<?php require_once  '../include/sidebar.php'; ?>         
	<!-- Page Content Holder -->
	<div id="content">
		<!-- Sidebar Holder -->
		<?php require_once  '../include/navbar-top-employee.php'; ?> 
		
		<div class="container">
				
              <div class="card">
                <div class="card-body">
                
                    <table width='100%'>
                        <tr><td align="center">Rajesh Kumar</td><td align="center">App Develoe</td></tr>


                    </table>

                     <table width='100%'>
                        <tr>
                            <td >Date of Birth</td><td > (Date)</td>
                            <td >Current Annual CTC</td><td >(Value / currency)</td>
                        </tr>
                        <tr>
                            <td >Fixed: (free text)</td><td > Variable</td>
                            <td >a</td><td > B</td>                            
                        </tr>
                        <tr>
                            <td >a</td><td > B</td>
                            <td >a</td><td > B</td>                            
                        </tr>
                        <tr>
                            <td >a</td><td > B</td>
                            <td >a</td><td > B</td>                            
                        </tr>
                        <tr>
                            <td >a</td><td > B</td>
                            <td >a</td><td > B</td>                            
                        </tr>
                        <tr>
                            <td >a</td><td > B</td>
                            <td >a</td><td > B</td>                            
                        </tr>
                        
                    </table>
                
                </div>
              </div>  

        </div>
	</div>
</div>




<?php require_once  '../include/footer.php'; ?>


</body>

</html>