<?php 
require_once '../core/init.php'; 
require_once '../functions/helper.php';
?>

<!DOCTYPE html>
<html>
<head>
    <?php require_once  '../include/css.php'; ?>    
    <style>
	.card	.custom-file-label{
			text-align: left;
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
					<li class="breadcrumb-item"><a href="./candidates.php" class="btn-link">Candidates</a> </li> 
					<li class="breadcrumb-item text-success">
						<?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>
					</li>                 
				</ol>
				<div class="line"></div>	
				<div class="card-body">
					<div class="row">
						<div class="col-md-8">
							<form id="upload_form" action="./add-upload.php" enctype="multipart/form-data" method="post">
								<div class="custom-file mb-3">
									<input type="file" class="custom-file-input" id="customFile" name="fileToUpload">
									<label class="custom-file-label" for="customFile">Choose file</label>
								</div>
								<div class="mt-3">
									<button type="submit" class="btn btn-primary">Upload</button>
								</div>										
							</form>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</div>
</div>
<?php require_once  '../include/footer.php'; ?>

</body>
</html>