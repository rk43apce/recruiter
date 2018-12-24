<?php 
require_once '../core/init.php';
require_once '../functions/helper.php';
require_once '../functions/sanitize.php';

if (!Input::exists('get')) {

	Redirect::to('dashboard.php');
	exit();
}

if (empty(Input::get('jobRoleId'))) {

	Redirect::to('dashboard.php');
	exit();
}

$jobRoleId = Input::get('jobRoleId');


?>
<!DOCTYPE html>
<html>
<head>
<?php require_once  '../include/css.php'; ?>  
<style>
	.card{
		max-width: 686px;
		margin-right:auto;
		margin-left: auto; 
	}
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
											 
						<li class="breadcrumb-item active">Update JD</li>    
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
										<input type="text" name="jobRoleId" id="jobRoleId"  value="<?php echo $jobRoleId;?>">	
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