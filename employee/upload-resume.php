<?php 
require_once '../core/init.php';
require_once '../functions/helper.php';
require_once '../functions/sanitize.php';

if (!Input::exists('get')) {

	Redirect::to('dashboard.php');
	exit();
}

if (empty(Input::get('candidateId')) ) {

	Redirect::to('dashboard.php');
	exit();
}

$candidate = new Candidate;

if ($candidateData = $candidate->getCandidatebyId(escape(Input::get('candidateId')))) {
		
	$candidateId = $candidateData['candidateId'];		
	$candidateFullName = $candidateData['candidateFullName'];
	$candidateDOB = $candidateData['candidateDOB'];
	$candidateEmail = $candidateData['candidateEmail'];
	$candidateMobileNo = $candidateData['candidateMobileNo'];
	$candidateCity = $candidateData['candidateCity'];

} else {
	// setting error
	Session::put('errorMsg', 'Sorry no record found!');
}

?>
<!DOCTYPE html>
<html>
<head>
<?php require_once  '../include/css.php'; ?>  
<style>
	.card .custom-file-label{
		text-align: left;
	}
</style>
</head>
<body>
	<div class="loader"></div>
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
						<li class="breadcrumb-item"><a href="./candidates.php" class="btn-link">Candidates</a> </li>   
						
						<li class="breadcrumb-item">
						<a href="view-candidate-description.php?candidateId=<?php echo $candidateId;?>" class="btn-link">
						<?php echo $candidateFullName; ?></a></li>  						 
						<li class="breadcrumb-item active">Update Resume</li>    
						<li class="breadcrumb-item text-success">
						<?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>
						</li>                 
					</ol>	
					<div class="line"></div>
					<div class="card-body">					
						<form method="post"  enctype="multipart/form-data" action="./add-upload.php">
							<div class="form-group">
								<div class="row col-md-12">
								<div class="input-group mb-3">
									<div class="custom-file">
										<input type="hidden" name="candidateId" id="candidateId"  value="<?php echo $candidateId;?>">	
										<input type="file" name="fileToUpload" id="fileToUpload" class="custom-file-input" required/>
										<label class="custom-file-label " for="inputGroupFile02">Choose file</label>
									</div>
									<div class="input-group-append">
										<span class="input-group-text" id="uploadfile">Upload</span>
									</div>
								</div>
								<input type="submit" class="btn btn-primary" name="" >
								</div>
							</div>	
						</form>		 
					</div>			
				</div>
            </div>  
		</div>
	</div>	
	
	<?php require_once  '../include/footer.php'; ?>
	
</body>
</html>