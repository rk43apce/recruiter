<?php
require_once '../core/init.php';
require_once '../functions/helper.php';
require_once '../functions/sanitize.php';
Login::auth( 'employeeId' );
$interview = new Interview();

$action = escape( Input::get( 'action' ) );

switch ( $action ) {

	case 'addInterview':
		$assingmentId = $_POST[ 'assingmentId' ];
		$candidateId = $_POST[ 'interviewSheduleCandidateId' ];
		$type = $_POST[ 'type' ];
		$date = $_POST[ 'date' ];
		$startAt = $_POST[ 'startAt' ];
		$endAt = $_POST[ 'endAt' ];
		$location = $_POST[ 'location' ];
		$title = $_POST[ 'title' ];
		$description = $_POST[ 'description' ];

		$interviewData = array(
			'employeeId' => Session::get( 'employeeId' ),
			'assingmentId' => $assingmentId,
			'candidateId' => $candidateId,
			'type' => $type,
			'date' => $date,
			'startAt' => $startAt,
			'endAt' => $endAt,
			'location' => $location,
			'title' => $title,
			'description' => $description
		);

		echo $interview->addInterview( $interviewData );	
		break;
		
		case 'viewInterview':
		$candidateScheduledInteview = $interview->viewInterview();		
		
		if(!empty($candidateScheduledInteview)) {

		foreach ($candidateScheduledInteview as $key => $row) { ?>		

		<div class="row interviewDescription">
			<div class="col-md-1" style=" border-right:  1px solid #ddd; ">
				<h3 style="text-align: center; color: #7386D5;"><i class="fa fa-calendar" aria-hidden="true"></i></h3>
			</div>		
			<div class="col-md-10">								
				<div class="row">
					<div class="col-md-2">
						<label for="">Title :</label>
					</div>
					<div class="col-md-10">		
	
					<?php echo escape ($row['title']); ?>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-2">
						<label for="">Type :</label>
					</div>
					<div class="col-md-10">		
					<?php echo escape ($row['type']); ?>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-2">
						<label for="">Date :</label>
					</div>
					<div class="col-md-10">	
					<?php echo date('d-m-Y', strtotime($row['date']));?>
					
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-2">
						<label for="">Schedule :</label>
					</div>
					<div class="col-md-10">	
					<?php echo $row['startAt']. ' To ' . $row['endAt'] ;?>
					
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-2">
						<label for="">Location :</label>
					</div>
					<div class="col-md-10">	
					<?php echo escape ($row['location']); ?>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-2">
						<label for="">Description :</label>
					</div>
					<div class="col-md-10">	
					<?php echo escape ($row['description']); ?>
					</div>
				</div>
						
			</div>
			<div class="col-md-1">
				
				<a href="javascript:void(0);" class="actionButton"  editInterviewId = "<?php echo escape ($row['interviewId']); ?>" onClick="editInterview(this);"><i class="fa fa-edit" aria-hidden="true"></i></a>
				&nbsp;
				<a href="javascript:void(0);" class="actionButton" deleteInterviewId = "<?php echo escape ($row['interviewId']); ?>" onClick="deleteInterview(this);"><i class="fa fa-trash" aria-hidden="true"></i></a>				
			</div>			
			<div class="line"></div>
		</div>

		<?php }} else {
			
			?>
			<div class="row interviewDescription">
				<div class="col-md-10">	
				<p>Interview is not schedule yet</p>
				</div>
			</div>
			<?php
		}
		
		break;
		
	case 'deleteInterview':
		$interviewId = $_POST[ 'interviewId' ];
		
		echo $interview->deleteInterview( $interviewId );
		
		break;
		

	default:
		echo 'Sorry!. Something went wrong.';
}


