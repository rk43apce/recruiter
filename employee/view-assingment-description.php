<?php require_once '../core/init.php';
require_once '../functions/helper.php';

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
		$cityName =  $assingmentData['cityName'];
		$minWorkExperience =  $assingmentData['minWorkExperience'];
		$maxWorkExperience =  $assingmentData['maxWorkExperience'];
		$createdOn =  $assingmentData['createdOn'];	
		
		$candidate = new Candidate();
		
		$candidateData =  $candidate->getShortlistCandidates($assingmentId);
		
	} else {

		Session::put('errorMsg', 'Invalid request or No record found! ');
	} 
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
                        <li class="breadcrumb-item"><a class="btn-link" href="./dashboard.php">Assignment</a> </li> 
                        <li class="breadcrumb-item">
                        	<?php echo $companyName ?>
                        </li> 
                         <li class="breadcrumb-item">
                        	<?php echo $jobRoleTitle ?>
                        </li>       
                        <li class="breadcrumb-item"><?php echo $cityName ?> </li> 
                        <li class="breadcrumb-item active">Shortlisted Candidates </li> 
                        <li class="breadcrumb-item " >
                        <a href="./shortlist.php?assingmentId=<?php echo $assingmentId; ?>" class="btn-link">+Add candidate to funnel</a>
                        </li> 
                        <li class="breadcrumb-item text-success">
                            <?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>
                        </li>                   
                    </ol>
				<div class="line"></div>
				<table id="example" class="table table-bordered dt-responsive nowrap"  style="max-width:100%">
				
					<thead>
						<tr>
							<th>Added by</th>
							<th>Candidate Name</th>
							<th>Organisation</th> 
							<th>Designation</th> 
							<th>Shortlist On</th>
							<th>Update</th> 												                        
						</tr>
					</thead>
					<tbody>
						<?php
						if($candidateData) {							
							foreach ($candidateData as $key => $candidate) { ?>
							<tr>
								<td><?php echo $candidate['employeeName']; ?></td>
								<td>
								<a class="btn-link" href="./view-candidate-description.php?candidateId=<?php echo $candidate['candidateId']; ?>">
									<?php echo $candidate['candidateFullName']; ?>
								</a>	
								
								</td> 							
								<td><?php echo $candidate['candidateOrganisation']; ?></td>
								<td><?php echo $candidate['candidateDesignation']; ?></td>	
								<td><?php echo date('d-m-Y', strtotime($candidate['shortlistOn']));?></td> 						
								<td>Update</td> 
							</tr>
						<?php } } else {
							?>
							
							<tr>
								<td colspan="6" align="center">No record found</td>
							</tr>
									
						<?php
						}?> 
					</tbody>
				</table> 
				</div>
			</div>
		</div>
	</div>
	<?php require_once  '../include/footer.php'; ?>
</body>
</html>