<?php 
require_once '../core/init.php'; 
require_once '../functions/helper.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$allCandidatesData = Load::allCandidates();

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
		<?php  Data::checkData($allCandidatesData); ?> 
		<div class="container">
			<div class="card">    
				<ol class="breadcrumb">                  
					<li class="breadcrumb-item">Canidates </li>  
					<li class="breadcrumb-item "><a href="./new-candidate.php" class="btn-link">+Add new Candidate</a></li> 
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
						</tr>
					</thead>
					<tbody>
						<?php foreach ($allCandidatesData as $key => $canidate) { ?>
						<tr>
							<td><?php echo $canidate['candidateFullName']; ?></td>
							<td><?php echo $canidate['candidateEmail']; ?> </td>
							<td><?php echo $canidate['candidateMobileNo']; ?> </td>
							<td><?php echo $canidate['candidateOrganisation']; ?> </td>
							<td><?php echo $canidate['candidateDesignation']; ?> </td>
							<td><?php echo $canidate['functionalareaName']; ?> </td>
							<td><?php echo $canidate['candidateWorkExp']; ?> </td>
							<td><?php echo $canidate['candidateSalary']; ?> </td>	
							<td><?php echo $canidate['candidateNoticePeriod']; ?> </td>	
							<td><a class="btn-link" href="./view-candidate-description.php?candidateId=<?php echo $canidate['candidateId']; ?>">View full Profile</a></td>	
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