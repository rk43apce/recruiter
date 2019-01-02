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
				<ol class="breadcrumb">                  
					<li class="breadcrumb-item">Assignment </li>  
					<li class="breadcrumb-item text-success">
					<?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>
					</li>                   
				</ol>
				<a class="btn-link" href="./new-candidate.php">+Add new candidate</a>
				<div class="line"></div>
				<table id="assingmentTable" class="table table-bordered dt-responsive nowrap"  style="max-width:100%">
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

						<?php if($assingmentData) { ?>
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
							<td>
							<?php echo $assingment['minWorkExperience']; ?> - <?php echo $assingment['maxWorkExperience'];?> yrs</td> 
							<td><?php echo date('d-m-Y', strtotime($assingment['createdOn']));?></td> 
							<td> <?php echo noOfDays($assingment['createdOn']);?> </td>
							<td><?php echo date('d-m-Y', strtotime($assingment['createdOn']));?></td> 
						</tr>
						<?php }  ?> 
						<?php } else {?>
						
							<tr><td align="center" colspan="8"><?php echo Session::get('noAssignment');?></td></tr>
						<?php } ?>
					</tbody>
				</table> 
			</div>
	
		</div>
	</div>
</div>





<!-- Modal -->
<div class="modal fade" id="profilePictureModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Photo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<?php require_once  '../include/footer.php'; ?>

<script type="text/javascript">
	$(document).ready(function() {
		$('#assingmentTable').DataTable( {
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