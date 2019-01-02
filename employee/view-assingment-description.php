<?php require_once '../core/init.php';
require_once '../functions/helper.php';

Login::auth('employeeId');

$assingment =  new Assingment();

if (Input::exists('get')) {	

	$assingmentId = Input::get('assingmentId');

	if ($assingmentData = $assingment->getOnGoingAssingmentById($assingmentId)) {

		$companyId =  $assingmentData['companyId'];
		$assingmentId =  $assingmentData['assingmentId'];
		$jobRoleId =  $assingmentData['jobRoleId'];
		$jobRoleTitle =  $assingmentData['jobRoleTitle'];
		$companyName =  $assingmentData['companyName'];
		$spocId =  $assingmentData['spocId'];
		$spocName =  $assingmentData['employeeName'];
		$minWorkExperience =  $assingmentData['minWorkExperience'];
		$maxWorkExperience =  $assingmentData['maxWorkExperience'];
		$functionalareaName =  $assingmentData['functionalareaName'];
		$minFixedSalary =  $assingmentData['minFixedSalary'];
		$maxFixedSalary =  $assingmentData['maxFixedSalary'];
		
		$createdOn =  $assingmentData['createdOn'];	
		
		$candidate = new Candidate();		
		$candidateData =  $candidate->getShortlistCandidates($assingmentId);

		$totalShotlistCandidate = count($candidateData );

		$statusCategory =  $candidate->statusCategory();


		
	} else {

		Session::put('errorMsg', 'Invalid request or No record found! ');
	} 
}    

function test($spocId, $employeeId) {
	
	if(Session::get('employeeId') != $spocId ) {
		
		echo (Session::get('employeeId') != $employeeId ? "disabled" : "");
		
	}
}

	
?>



<!DOCTYPE html>
<html>
<head>
<?php require_once  '../include/css.php'; ?>
<style type="text/css">

.profile-head .nav-tabs{
margin-bottom:3%;
}
.profile-head .nav-tabs .nav-link{
font-weight:600;
border: none;
}
.profile-head .nav-tabs .nav-link.active{
border: none;
border-bottom:2px solid #6d7fcc;
}


.profile-work ul{
list-style: none;
}
.profile-tab label{
font-weight: 600;
}
.profile-tab p{
font-weight: 300;
color: inherit;
}
      .mb-0 > a {
  display: block;
  position: relative;
}
.mb-0 > a:after {
  content: "\f078"; /* fa-chevron-down */
  font-family: 'FontAwesome';
  position: absolute;
  right: 0;
}
.mb-0 > a[aria-expanded="true"]:after {
  content: "\f077"; /* fa-chevron-up */
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
					<li class="breadcrumb-item"><a class="btn-link" href="./dashboard.php">Assignment</a> </li> 
					<li class="breadcrumb-item">
						<?php echo $companyName ?>
					</li> 
						<li class="breadcrumb-item active">
						<?php echo $jobRoleTitle ?>  
					</li>          
					<li class="breadcrumb-item text-success">
						<?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>
					</li>    

				</ol>
				
			
		</div>
		<div class="card">
			<div class="row">
				<div class="col-md-12">
					<div class="profile-head">
						<div class="row">
							<div class="col-md-9">
							<h3><?php echo $jobRoleTitle; ?></h3>
							<span><?php echo $companyName ?></span>
							</div>
							<div class="col=md-3">
									<a class="btn btn-primary" href="./shortlist.php?assingmentId=<?php echo $assingmentId; ?>" class="btn-link"> <i class="fa fa-search" aria-hidden="true"></i> Find Candidates</a>
							</div>
							
						</div>
						<div class="line"></div>							
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"> Shortlist <span class="badge badge-secondary"><?php echo $totalShotlistCandidate; ?></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="share-tab" data-toggle="tab" href="#share" role="tab" aria-controls="share" aria-selected="false">Share</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="phoneScreen-tab" data-toggle="tab" href="#phoneScreen" role="tab" aria-controls="phoneScreen" aria-selected="false">Phone Screen</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="interview-tab" data-toggle="tab" href="#interview" role="tab" aria-controls="interview" aria-selected="false">Interview</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="offer-tab" data-toggle="tab" href="#offer" role="tab" aria-controls="offer" aria-selected="false">Offer</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="hired-tab" data-toggle="tab" href="#hired" role="tab" aria-controls="hired" aria-selected="false">Hired</a>
							</li>

														
							
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="tab-content profile-tab" id="myTabContent">
						<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
							<div class="row">
								<div class="col-md-12">
													<table id="example" class="table table-bordered dt-responsive nowrap"  style="max-width:100%">
			
				<thead>
					<tr>
						<th>Added by</th>
						<th>Candidate Name</th>
						<th>Organisation</th> 
						<th>Designation</th> 
						<th>Shortlist On</th>
						<th>Status</th>
																							
					</tr>
				</thead>
				<tbody>
					<?php
					if($candidateData) {							
						foreach ($candidateData as $key => $row) { ?>
						<tr>
							<td><?php echo $row['employeeName']; ?></td>
							<td>
								<a class="btn-link" href="./view-candidate-description.php?candidateId=<?php echo $row['candidateId']; ?>&assingmentId=<?php echo $assingmentId; ?>">
									<?php echo $row['candidateFullName']; ?>
								</a>

							</td> 							
							<td><?php echo $row['candidateOrganisation']; ?></td>
							<td><?php echo $row['candidateDesignation']; ?></td>	
							<td><?php echo date('d-m-Y', strtotime($row['shortlistOn']));?>
								
							</td> 
							<td>						
							<a  class="btn-link <?php echo test($spocId, $row['employeeId']); ?>" 
							
							href="javascript:void(0);" onClick="updateStatus('<?php echo $row['candidateId'];?> ', <?php echo $assingmentId; ?> )">
							
							<?php echo $candidate->getCanidateStatus($assingmentId, $row['candidateId']);?>
															
							</a>								
							</td>						
							
						</tr>
					<?php } } else { ?>							
						<tr><td colspan="6" align="center">No record found</td></tr>									
					<?php } ?> 
				</tbody>
			</table> 
								</div>
							</div>
						
						</div>
						<div class="tab-pane fade" id="share" role="tabpanel" aria-labelledby="profile-tab">

						<h3>share</h3>	
						</div>
						<div class="tab-pane fade" id="phoneScreen" role="tabpanel" aria-labelledby="profile-tab">

						<h3>phoneScreen</h3>	
						</div>
						<div class="tab-pane fade" id="interview" role="tabpanel" aria-labelledby="profile-tab">

						<h3>interview</h3>	
						</div>

				</div>
			</div>                   
		</div>

		</div>
		<div class="card">
		<h5 class="mb-0">
		<a class="collapsed" role="button" data-toggle="collapse" href="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
		Job Role Description
		</a>
		</h5>
		<div id="collapse-3" class="collapse" data-parent="#accordion" aria-labelledby="heading-3">
		<div class="card-body">



		<?php

		$jobrole = new Jobrole();

		$jdData = $jobrole->getJD($jobRoleId);

		$jdTrackerId = $jdData['jdTrackerId'];

		if($jdTrackerId) { ?>							
		<object style="width: 100%; min-height: 886px;" data="../upload/jd/<?php echo $jdTrackerId;?>.pdf"></object>
		<?php } else { ?>

		<h5>Job description not found!</h5>

		<?php
		}						
		?>
		</div>
		</div>
		</div>
</div>
</div>

</div>

	<!-- The Modal -->
	<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Update Candidate status</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>        
        <!-- Modal body -->
        <div class="modal-body">
        	<form  action="add-candidateStatus.php" method="post">
				<div class="form-group">
					<select name="stageId" class="form form-control" required>
						<option value=""> Choose Stage </option>
						<?php foreach ($statusCategory as $key => $stage) { ?>	
						<option value="<?php echo $stage['categoryId']; ?>"><?php echo $stage['name']; ?></option>
						<?php } ?>					
					</select>
				</div>
				<div class="form-group">
					<textarea rows="3" name="note" class="form-control" placeholder="Write note here..." required></textarea>
				</div>
				<input id="candidateId" type="hidden" name="candidateId" value="" required>
				<input id="assingmentId" type="hidden" name="assingmentId" value="" required>  
				<input type="hidden" name="token" value="<?php echo Token::generate2('addCandidateStatus'); ?>">
				<input type="submit" class="btn btn-primary">
        	</form>
			       
        </div>        
        <!-- Modal footer -->
        <div class="modal-footer">         
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>        
      </div>
    </div>
  </div>


<?php require_once  '../include/footer.php'; ?>
<script type="text/javascript">
		function updateStatus(candidateId, assingmentId) {
			$("#candidateId").val(candidateId);
			$("#assingmentId").val(assingmentId);
			$('#myModal').modal('toggle');
		}
	</script>
	<script type="text/javascript">
	$(document).ready(function() {
		$('#example').DataTable( {
			responsive: {
				details: {
					display: $.fn.dataTable.Responsive.display.modal( {
						header: function ( row ) {
							var data = row.data();
							return 'Details for '+data[0] ;
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