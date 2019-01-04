<?php 
require_once '../core/init.php';
require_once '../functions/sanitize.php';

if (!Input::exists('post')) {
	
	exit();	
}

$comment = new Comment();

$action =  escape(Input::get('action'));

switch ($action) {
    case "addComment":	
		if($comments =  escape(Input::get('comment'))) {
		 	$candidateId =  Input::get('candidateId');
			 echo $comment->addComment(Session::get('employeeId'), $candidateId, $comments);
		}
        
        break;
    case "editComment":
        echo $comment->editComment();
        break;
    case "deleteComment":
        echo $comment->deleteComment();
        break;
    default:
		$candidateId =  Input::get('candidateId');
      $commentData =  $comment->getComment($candidateId);	
	
	
		if(!empty($commentData)) {
		
	foreach ($commentData as $key => $row) { ?>		
	
	<div class="row">
	
	<div class="col-md-1" style=" border-right:  1px solid #ddd; ">
		
		<h3 style="text-align: center; color: #7386D5;"><i class="fa fa-comments" aria-hidden="true"></i></h3>
		
	</div>		
	<div class="col-md-10">
		<span>		
			<img id="profilePicture" style="cursor: pointer; " class="rounded-circle" src="../upload/pic/<?php echo escape ($row['picture']); ?>" height="30" width="30"> &nbsp;
			<strong> <?php echo escape ($row['employeeName']); ?></strong> <span>&nbsp; added a comment.</span> <?php echo Timeago::time_elapsed_string($row['noteAt']); ?>
		</span>
		<div class="row col-md-12">
			<?php echo escape ($row['notes']); ?>
		</div>
	
	</div>
	<div class="line"></div>
	</div>
	
	<?php }}
		
}





