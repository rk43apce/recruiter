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
				
					<table id="" class="table table-bordered dt-responsive nowrap"  style="max-width:100%">
						
						<tbody>
								<tr>
									<td>Compnay Name</td>
									
									<td><?php echo $companyName ?> </td>								                            
								</tr>
								<tr>
									<td>Role  Title</td>
									<td><?php echo $jobRoleTitle ?> </td>								                            
								</tr>
								<tr>
									<td>City Name</td>
									<td><?php echo $cityName ?> </td>								                            
								</tr>
								<tr>
									<td>SPOC</td>
									<td><?php echo $spocName ?> </td>								                            
								</tr>
								
								<tr>
									<td>Experience</td>
									<td><?php echo $minWorkExperience ?> to <?php echo $maxWorkExperience ?> </td>								                            
								</tr>
								<tr>
									<td>Open On</td>
									<td><?php echo $createdOn ?> </td>								                            
								</tr>
								
							
						</tbody>
					</table> 
				</div>
            </div>
            <br><br>
			 <div class="container">
			<div class="card">    
				 <ol class="breadcrumb">                  
                        <li class="breadcrumb-item active" >Shortlist Candidates</li>  
                        <li class="breadcrumb-item " >
                        	<a href="./new-candidate.php" class="btn-link">+Add new Candidate</a></li> 
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
							<th>Years</th>
							<th>CTC</th>
							<th>Candidate Status</th> 
							<th>Update Status</th>   							                        
						</tr>

					</thead>
					<tbody>
						

					</tbody>
				</table> 

				</div>
			</div>
		</div>
	</div>
	<?php require_once  '../include/footer.php'; ?>
</body>
</html>