<?php 
require_once '../core/init.php'; 
require_once '../functions/helper.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$login  = new Login();

$login->isUservalid('employee');

$employee = new Employee();

$employeeData =  $employee->getEmployeeById(Session::get('userId'));

$employeeId =  $employeeData['employeeId'];

$employeeName =  $employeeData['employeeName'];

$assingment = new Assingment();  

if (!$assingmentData = $assingment->getEmployeeLeaderAssingment($employeeId)) {

    Session::put("errorMsg", 'Sorry! No ongoing assignment assign to you!');
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
		<?php Data::checkData($assingmentData); ?>
		<div class="container">
			<div class="card">    
				<ol class="breadcrumb">                  
					<li class="breadcrumb-item">Assignment</li>   
					<li class="breadcrumb-item text-success">
					<?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>
					</li>                   
				</ol>

				<div class="line"></div>
				<table id="example" class="table table-bordered dt-responsive nowrap"  style="max-width:100%">
					<thead>
						<tr>
							<th>Company Name</th>
							<th>Role</th>
							 <th>SPOC</th>  
							<th>City</th>
							<th>CTC</th>
							<th>Experience</th>
							<th>Open On</th> 
							<th>Days Old</th>   
							<th>Last work on</th>  
						</tr>
					</thead>
					<tbody>
						<?php foreach ($assingmentData as $key => $assingment) { ?>
						<tr>
							<td><?php echo $assingment['companyName']; ?> </td>
							<td>
								<a class="btn-link"
								href="./view-assingment-description.php?assingmentId=<?php echo $assingment['assingmentId']; ?>">
								<?php echo $assingment['jobRoleTitle'];?>
								</a>
							</td>	
							<td><?php echo $assingment['employeeName']; ?></td> 
							<td><?php echo $assingment['cityName']; ?></td>
							<td><?php echo $assingment['minFixedSalary']; ?> - <?php echo $assingment['maxFixedSalary']; ?></td>
							<td><?php echo $assingment['minWorkExperience']; ?> - <?php echo $assingment['maxWorkExperience'];?></td> 
							<td><?php echo date('d-m-Y', strtotime($assingment['createdOn']));?></td> 
							<td> <?php echo noOfDays($assingment['createdOn']);?> </td>
							<td><?php echo date('d-m-Y', strtotime($assingment['createdOn']));?></td> 
						</tr>
						<?php } ?> 
					</tbody>
				</table> 
			</div>
		</div>
	</div>
</div>

<?php require_once  '../include/footer.php'; ?>

<script type="text/javascript">
	$(document).ready(function() {
		$('#example').DataTable( {
			responsive: {
				details: {
					display: $.fn.dataTable.Responsive.display.modal( {
						header: function ( row ) {
							var data = row.data();
							return 'Details for '+data[0]+' '+data[1];
						}
					} ),
					renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
						tableClass: 'table'
					} )
				}
			}
		} );
	} );
</script>

</body>

</html>