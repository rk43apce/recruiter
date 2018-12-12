<?php 
require_once '../core/init.php';
require_once '../functions/helper.php';

$candidate =  new Candidate();

if ($candidateData =  $candidate->getCandidatebyID('18')) {
	
	$candidateId = $candidateData['candidateId'];
	$assingmentId = $candidateData['assingmentId'];
	$candidateFullName = $candidateData['candidateFullName'];
	$candidateDOB = $candidateData['candidateDOB'];
	$candidateEmail = $candidateData['candidateEmail'];
	$candidateMobileNo = $candidateData['candidateMobileNo'];
	$candidateCity = $candidateData['candidateCity'];
	$candidateOrganisation = $candidateData['candidateOrganisation'];
	$candidateDesignation = $candidateData['candidateDesignation'];
	$functionalareaName = $candidateData['functionalareaName'];
	$candidateWorkExp = $candidateData['candidateWorkExp'];
	$candidateSalary = $candidateData['candidateSalary'];
	$candidateNoticePeriod = $candidateData['candidateNoticePeriod'];
	$candidateCreatedOn = $candidateData['candidateCreatedOn'];
	$candidateAddedOn = $candidateData['candidateAddedOn'];	
	
} else {

	Session::put('errorMsg', 'Invalid request or No record found! ');
} 
?>
<!DOCTYPE html>
<html>
<head>
    <?php require_once  '../include/css.php'; ?>
    	<style type="text/css">
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
			<?php require_once  '../include/navbar-top-employee.php'; ?> 
			<div class="container">
				<div class="card">    
					<ol class="breadcrumb">                  
						<li class="breadcrumb-item">Assignment</li>   
						<li class="breadcrumb-item text-success">
						<?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>
						</li>                   
					</ol>
					<div class="line"></div>
					<div class="card-body">			
						
					<table id="example" class="table table-bordered dt-responsive nowrap"  style="max-width:100%">
						
						<tbody>
							<tr>
								<td align="right">Name</td>
								<td> <?php echo $candidateFullName; ?></td>
							</tr>
							<tr>
								<td align="right">DOB</td>
								<td> <?php echo $candidateDOB; ?></td>
							</tr>
							<tr>
								<td align="right">Email</td>
								<td> <?php echo $candidateEmail; ?></td>
							</tr>
							<tr>
								<td align="right">Mobile No</td>
								<td> <?php echo $candidateMobileNo; ?></td>
							</tr>
							<tr>
								<td align="right">Current City</td>
								<td> <?php echo $candidateCity; ?></td>
							</tr>
							<tr>
								<td align="right">Organisation</td>
								<td> <?php echo $candidateOrganisation; ?></td>
							</tr>
							<tr>
								<td align="right">Designation</td>
								<td> <?php echo $candidateDesignation; ?></td>
							</tr>
							<tr>
								<td align="right">Functional Area</td>
								<td> <?php echo $functionalareaName; ?></td>
							</tr>
							<tr>
								<td align="right">Work Experience</td>
								<td> <?php echo $candidateWorkExp; ?></td>
							</tr>
							<tr>
								<td align="right">Salary</td>
								<td> <?php echo $candidateSalary; ?></td>
							</tr>
							<tr>
								<td align="right">Notice Period</td>
								<td> <?php echo $candidateSalary; ?></td>
							</tr>
						</tbody>
					</table>	
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php require_once  '../include/footer.php'; ?>
</body>
</html>