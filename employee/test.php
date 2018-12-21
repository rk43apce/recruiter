<?php 
require_once '../core/init.php';
require_once '../functions/helper.php';
$candidate =  new Candidate();
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
						<li class="breadcrumb-item"><a class="btn-link" href="./candidates.php">Canidates</a>  </li>  
						<li class="breadcrumb-item active">+Add new candidate</li>
						<li class="breadcrumb-item text-danger">
						<?php echo  (Session::exists('errorMsg')) ? Session::flash('errorMsg') : ""; ?>
					</li>                                     
					</ol>	
					<div class="line"></div>
					<div class="card-body">					
						<form method="post" id="candidate_update_form" enctype="multipart/form-data">
						<p id="ajaxuploadsuccess" style="display:none; font-weight: bold; color: rgba(0,143,25,1.00); ">Resume uploaded successfully!</p>	

						<div class="form-group">
						<div class="input-group mb-3">
						<div class="custom-file">
						<!-- Compusory field -->
						<input type="hidden" name="candidateId" id="candidateId"  value="<?php echo time(); ?>">	
						<!--  -->
						<input type="file" name="fileToUpload" id="fileToUpload" class="custom-file-input"/>
						<label class="custom-file-label " for="inputGroupFile02">Choose file</label>
						</div>
						<div class="input-group-append">
						<span class="input-group-text" id="uploadfile"  onclick="uploadFile()">Upload</span>
						</div>
						</div>
						</div>		
						<progress id="fileuploadbar" style="display: none; color:#b92128; " value="0" max="100"></progress>
						<h3 id="status"></h3>	
						</form>		 
					</div>			
				</div>
            </div>  
		</div>
	</div>	
	
	<?php require_once  '../include/footer.php'; ?>
	
</body>
</html>