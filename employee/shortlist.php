<?php 
require_once '../core/init.php'; 
require_once '../functions/helper.php';

Login::auth('employeeId');

$assingment =  new Assingment();

if (Input::exists('get')) {	

	$assingmentId = Input::get('assingmentId');

	if ($assingmentData = $assingment->getOnGoingAssingmentById($assingmentId)) {
		
		$companyId =  $assingmentData['companyId'];
		$assingmentId =  $assingmentData['assingmentId'];
		$jobRoleTitle =  $assingmentData['jobRoleTitle'];
		$companyName =  $assingmentData['companyName'];
		$spocId =  $assingmentData['spocId'];
		$spocName =  $assingmentData['employeeName'];

		$minWorkExperience =  $assingmentData['minWorkExperience'];
		$maxWorkExperience =  $assingmentData['maxWorkExperience'];
		$createdOn =  $assingmentData['createdOn'];
		
		$candidate = new Candidate();		
		
		if(!$unShortlistCandidates = $candidate->getunShortlistCandidate($assingmentId)) {
			Session::put('errorMsg', 'No record found ! ');
		}

	} else {

		Session::put('errorMsg', 'Invalid request or No record found! ');
	} 
}   



?>

<!DOCTYPE html>
<html>
<head>
    <?php require_once '../include/css.php'; ?>  
</head>

<body>

<div class="wrapper">
	<!-- Sidebar Holder -->
	<?php require_once  '../include/sidebar.php'; ?>         
	<!-- Page Content Holder -->
	<div id="content">
		<!-- Sidebar Holder -->
		<?php require_once  '../include/navbar-top-employee.php'; ?> 
		<!-- check data empty or not if empty then load error box and stop further execution -->
		<?php  Data::checkData($unShortlistCandidates); ?> 
		<div class="container">
			<div class="card">    
				<ol class="breadcrumb">          
                        <li class="breadcrumb-item"><a class="btn-link" href="./dashboard.php">Assignment</a> </li> 
                        <li class="breadcrumb-item">
                        	<?php echo $companyName ?>
                        </li> 
                         <li class="breadcrumb-item">
                         	<a class="btn-link" href="view-assingment-description.php?assingmentId=<?php echo $assingmentId; ?>">
                         		<?php echo $jobRoleTitle ?>
                         	</a>                        	
                        </li>       
                     
                         <li class="breadcrumb-item active">Shortlist Candidate </li>                         
                        <li class="breadcrumb-item text-success">
                            <?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>
                        </li>                   
                    </ol>

				<div class="line"></div>
				<table id="Table" class="table table-bordered dt-responsive nowrap"  style="max-width:100%">
					<thead>
						<tr>
							<th>Name</th>						
							<th>Email</th>  
							<th>Phone No</th>
							<th>Organisation</th>
							<th>Designation</th>
							<th>Functional Area</th> 
							<th>Experience</th>   
							<th>Salary</th> 
							<th>Notice Period</th> 							
							<th>View Profile</th> 
							<th>Action</th> 
						</tr>
					</thead>
					<tbody>
						<?php foreach ($unShortlistCandidates as $key => $canidate) { ?>
						<tr>
							<td><?php echo $canidate['candidateFullName']; ?></td>
							<td><?php echo $canidate['candidateEmail']; ?> </td>
							<td><?php echo $canidate['candidateMobileNo']; ?> </td>
							<td><?php echo $canidate['candidateOrganisation']; ?> </td>
							<td><?php echo $canidate['candidateDesignation']; ?> </td>
							<td><?php echo $canidate['functionalareaName']; ?> </td>
							<td><?php echo $canidate['candidateWorkExp']; ?> yrs </td>
							<td><?php echo $canidate['candidateSalary']; ?> LPA </td>	
							<td><?php echo $canidate['candidateNoticePeriod']; ?> </td>	
							<td><a class="btn-link" href="./view-candidate-description.php?candidateId=<?php echo $canidate['candidateId']; ?>">View full Profile</a></td>	
							<td>
							  <form method="post" action="./add-shortlisted-candidate.php">
							  	<input type="hidden" name="candidateId" value="<?php echo $canidate['candidateId']; ?>">
							  	<input type="hidden" name="assingmentId" value="<?php echo $assingmentId; ?>">
								<button type="submit" class="btn btn-primary">Shortlist Candidate</button>
							  </form>	
							</td>								
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
		$('#Table').DataTable( {
			responsive: {
				details: {
					display: $.fn.dataTable.Responsive.display.modal( {
						header: function ( row ) {
							var data = row.data();
							// return 'Details for '+data[0]+' '+data[1];
							return 'Details for '+data[0];
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